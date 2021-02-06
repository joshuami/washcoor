<?php

/**
 * @file
 * Views support for Masquerade Field module.
 */

declare(strict_types = 1);

/**
 * Implements hook_views_data_alter().
 */
function masquerade_field_views_data_alter(array &$data): void {
  $data['user__masquerade_as']['masquerade_as_target_id']['relationship'] = [
    'title' => t('Masquerade as'),
    'id' => 'standard',
    'base' => 'users_field_data',
    'base field' => 'uid',
    'label' => t('Masquerade as'),
  ];
  $data['users_field_data']['masquerade_link']['field'] = [
    'title' => t('Masquerade link'),
    'id' => 'masquerade_link',
  ];
}
