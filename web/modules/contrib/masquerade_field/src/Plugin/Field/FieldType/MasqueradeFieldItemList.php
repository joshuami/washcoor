<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\Field\FieldType;

use Drupal\Core\Field\EntityReferenceFieldItemList;

/**
 * Provides a field item list class for 'masquerade_field' field item.
 */
class MasqueradeFieldItemList extends EntityReferenceFieldItemList {

  /**
   * {@inheritdoc}
   */
  public function preSave(): void {
    // Filter out duplicates.
    $target_ids = [];
    $this->filter(function (MasqueradeFieldItem $item) use (&$target_ids): bool {
      if (!isset($target_ids[$item->target_id])) {
        $target_ids[$item->target_id] = TRUE;
        return TRUE;
      }
      return FALSE;
    });
    parent::preSave();
  }

}
