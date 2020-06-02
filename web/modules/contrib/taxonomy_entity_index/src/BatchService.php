<?php

namespace Drupal\taxonomy_entity_index;

/**
 * Class BatchService.
 */
class BatchService {

  /**
   * Batch process callback.
   *
   * @param int $id
   *   Id of the batch.
   * @param string $operation_details
   *   Details of the operation.
   * @param object $context
   *   Context for operations.
   */
  public function processEntityTypeReindex($batch_id, $entity_type, $entity_id, &$context) {
    $context['results'][] = $batch_id;
    $context['message'] = t('Running Batch @batch_id: type: @entity_type - id: @entity_id',
      [
        '@batch_id' => $batch_id,
        '@entity_type' => $entity_type,
        '@entity_id' => $entity_id,
      ]
    );
    $entity = \Drupal::entityTypeManager()->getStorage($entity_type)->load($entity_id);
    taxonomy_entity_index_entity_update($entity);
  }

  /**
   * Batch Finished callback.
   *
   * @param bool $success
   *   Success of the operation.
   * @param array $results
   *   Array of results for post processing.
   * @param array $operations
   *   Array of operations.
   */
  public function processEntityTypeReindexFinished($success, array $results, array $operations) {
    $messenger = \Drupal::messenger();
    if ($success) {
      // Here we could do something meaningful with the results.
      // We just display the number of nodes we processed...
      $messenger->addMessage(t('@count results processed.', ['@count' => count($results)]));
    }
    else {
      // An error occurred.
      // $operations contains the operations that remained unprocessed.
      $error_operation = reset($operations);
      $messenger->addMessage(
        t('An error occurred while processing @operation with arguments : @args',
          [
            '@operation' => $error_operation[0],
            '@args' => print_r($error_operation[0], TRUE),
          ]
        )
      );
    }
  }

}
