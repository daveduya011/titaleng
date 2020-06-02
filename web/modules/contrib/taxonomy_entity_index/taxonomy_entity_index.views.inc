<?php

/**
 * @file
 * Views integration for taxonomy_entity_index.
 */

/**
 * Implements hook_views_data_alter().
 */
function taxonomy_entity_index_views_data_alter(&$data) {
  $entity_info = taxonomy_entity_index_entity_views_integrable();
  $data['taxonomy_entity_index']['table']['group'] = t('Taxonomy Entity Index');

  // Loop over compatible entity types.
  foreach ($entity_info as $type => $info) {

    if ($info->getKey('id')) {
      $base_table = $info->getBaseTable();
      $label = $info->getLabel();

      $entity_keys = $info->getKeys();

      // Is revision support enabled & does the current entity type support it?
      $revisions = taxonomy_entity_index_entity_views_revisionable($entity_keys);

      $data['taxonomy_entity_index']['table']['join'][$base_table] = [
        'left_field' => $revisions ? $entity_keys['revision'] : $entity_keys['id'],
        'field' => $revisions ? 'revision_id' : 'entity_id',
      ];

      $data[$base_table]['taxonomy_entity_index_tid_depth'] = [
        'help' => t('Display content if it has the selected taxonomy terms, or children of the selected terms. Due to additional complexity, this has fewer options than the versions without depth.'),
        'group' => t('Taxonomy Entity Index'),
        'real field' => $revisions ? $entity_keys['revision'] : $entity_keys['id'],
        'argument' => [
          'title' => t('Has taxonomy term ID on @entity_type (with depth and indexed in taxonomy_entity_index)', ['@entity_type' => $label]),
          'id' => 'taxonomy_entity_index_tid_depth',
          'accept depth modifier' => TRUE,
        ],
        'filter' => [
          'title' => t('Has taxonomy terms on @entity_type  (with depth and indexed in taxonomy_entity_index)', ['@entity_type' => $label]),
          'id' => 'taxonomy_entity_index_tid_depth',
        ],
      ];

      $data[$base_table]['taxonomy_entity_index_entity_tid'] = [
        'group' => t('Taxonomy Entity Index'),
        'title' => t('Taxonomy terms on @entity_type', ['@entity_type' => $label]),
        'help' => t('Relate @entity_type to taxonomy terms. This relationship will cause duplicated records if there are multiple terms.', ['@entity_type' => $label]),
        'relationship' => [
          'real field' => $revisions ? $entity_keys['revision'] : $entity_keys['id'],
          'label' => t('terms'),
          'base' => 'taxonomy_entity_index',
          'base field' => $revisions ? 'revision_id' : 'entity_id',
          'extra' => [
            [
              'field' => 'entity_type',
              'operator' => '=',
              'value' => $type,
            ],
          ],
        ],
        'field' => [
          'title' => t('All taxonomy terms on @entity_type', ['@entity_type' => $label]),
          'help' => t('Display all taxonomy terms associated with a @entity_type from specified vocabularies.', ['@entity_type' => $label]),
          'id' => 'taxonomy_entity_index_tid',
          'no group by' => TRUE,
          'click sortable' => FALSE,
        ],
      ];
    }
  }

  $data['taxonomy_term_data']['table']['join']['taxonomy_entity_index'] = [
    // Links directly to taxonomy_term_data via tid.
    'left_field' => 'tid',
    'field' => 'tid',
  ];

  $data['taxonomy_term__parent']['table']['join']['taxonomy_entity_index'] = [
    // Links directly to taxonomy_term__parent via tid.
    'left_field' => 'entity_id',
    'field' => 'tid',
  ];
}
