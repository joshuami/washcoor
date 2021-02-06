<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\Field\FieldType;

use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;

/**
 * Defines the 'masquerade_field' entity field type.
 *
 * @FieldType(
 *   id = "masquerade_field",
 *   label = @Translation("Masquerade field"),
 *   description = @Translation("An entity reference field refering accounts that a user can masquerade."),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_autocomplete",
 *   default_formatter = "masquerade_field_default",
 *   list_class = "\Drupal\masquerade_field\Plugin\Field\FieldType\MasqueradeFieldItemList",
 * )
 */
class MasqueradeFieldItem extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings(): array {
    return [
      'target_type' => 'user',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings(): array {
    return [
      'handler' => 'masquerade_field_user',
      'handler_settings' => [
        'include_anonymous' => FALSE,
      ],
    ] + parent::defaultFieldSettings();
  }

}
