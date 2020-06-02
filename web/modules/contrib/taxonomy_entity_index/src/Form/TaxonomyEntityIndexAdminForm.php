<?php

namespace Drupal\taxonomy_entity_index\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the primary settings form.
 */
class TaxonomyEntityIndexAdminForm extends ConfigFormBase {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Creates a TaxonomyEntityIndexAdminForm form.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity manager service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, ConfigFactoryInterface $config_factory) {
    $this->entityTypeManager = $entity_type_manager;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'taxonomy_entity_index_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['taxonomy_entity_index.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('taxonomy_entity_index.settings');

    $entity_types = $this->entityTypeManager->getDefinitions();
    $options = [];

    foreach ($entity_types as $entity_type_id => $entity_type) {
      if (!is_null($entity_type->getBaseTable()) && $entity_type->isSubclassOf('\Drupal\Core\Entity\ContentEntityInterface')) {
        $options[$entity_type_id] = $entity_type->getLabel() . " <em>($entity_type_id)</em>";
      }
    }
    asort($options);

    $form['description'] = [
      '#markup' => $this->t('<p>Use this form to select which entity types to index.</p>'),
    ];

    $form['index_revisions'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Maintain indexes for historical revisions'),
      '#description' => $this->t('Warning: This setting can impact performance.'),
      '#default_value' => $config->get('index_revisions'),
    ];

    $form['index_per_field'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Maintain separate indexes for each field'),
      '#description' => $this->t('Warning: This setting can impact performance.'),
      '#default_value' => $config->get('index_per_field'),
    ];

    $form['types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Entity types'),
      '#options' => $options,
      '#default_value' => $config->get('types'),
      '#description' => $this->t('Select which entity types to index.'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $settings = [
      'types' => array_filter($form_state->getValue(['types'])),
      'index_revisions' => $form_state->getValue(['index_revisions']),
      'index_per_field' => $form_state->getValue(['index_per_field']),
    ];

    $config = $this->config('taxonomy_entity_index.settings');
    foreach ($settings as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();

    $this->messenger()->addMessage($this->t('The settings have been saved.'));
  }

}
