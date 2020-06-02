<?php

namespace Drupal\taxonomy_entity_index\Commands;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 */
class TaxonomyEntityIndexCommands extends DrushCommands {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * A logger instance.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $logger;

  /**
   * Constructs a drush command object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory
   *   The logger factory service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, ConfigFactoryInterface $config_factory, LoggerChannelFactoryInterface $logger_factory) {
    $this->entityTypeManager = $entity_type_manager;
    $this->configFactory = $config_factory;
    $this->logger = $logger_factory->get('taxonomy_entity_index');
  }

  /**
   * Rebuild taxonomy entity index.
   *
   * @param string $entity_types
   *   A comma separated list of entity types to
   *   reindex.
   *
   * @command taxonomy_entity_index:rebuild
   * @aliases tei:rebuild, taxonomy-entity-index-rebuild, tei-rebuild
   * @usage drush taxonomy-entity-index-rebuild
   *   Reindex all configured entity types.
   * @usage drush taxonomy-entity-index-rebuild node,media
   *   Reindex only node and media entities.
   */
  public function Rebuild($entity_types = '') {

    if (empty($entity_types)) {
      $config = $this->configFactory->get('taxonomy_entity_index.settings');
      $entity_types = $config->get('types');
    }
    else {
      $entity_types = explode(',', $entity_types);
    }

    $this->logger->info('Starting reindex for entity types: @types', [
      '@types' => implode(',', $entity_types),
    ]);

    $operations = [];
    $numOperations = 0;
    $batchId = 1;

    foreach ($entity_types as $type) {
      try {
        $storage = $this->entityTypeManager->getStorage($type);
        $query = $storage->getQuery();
        $ids = $query->execute();
      }
      catch (\Exception $e) {
        $this->output()->writeln($e);
        $this->logger->warning('Error found @e', ['@e' => $e]);
      }
      if (!empty($ids)) {
        foreach ($ids as $id) {
          $this->output()->writeln('Preparing batch: ' . $batchId);
          $operations[] = [
            '\Drupal\taxonomy_entity_index\BatchService::processEntityTypeReindex',
            [
              $batchId,
              $type,
              $id,
            ],
          ];
          $batchId++;
          $numOperations++;
        }
      }
      else {
        $this->logger->warning('No entities of this type @type', ['@type' => $type]);
      }
    }

    $batch = [
      'title' => t('Updating @num item(s)', ['@num' => $numOperations]),
      'operations' => $operations,
      'finished' => '\Drupal\taxonomy_entity_index\BatchService::processEntityTypeReindexFinished',
    ];

    batch_set($batch);
    drush_backend_batch_process();
    $this->logger->notice("Batch operations end.");
    $this->logger->info('Update batch operations end.');
  }

}
