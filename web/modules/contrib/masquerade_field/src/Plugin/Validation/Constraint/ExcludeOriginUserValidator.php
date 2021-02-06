<?php

declare(strict_types=1);

namespace Drupal\masquerade_field\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the 'ExcludeOriginalUser' constraint.
 */
class ExcludeOriginUserValidator extends ConstraintValidator {

  /**
   * @inheritDoc
   */
  public function validate($field_item_list, Constraint $constraint): void {
    /** @var \Drupal\masquerade_field\Plugin\Field\FieldType\MasqueradeFieldItemList $field_item_list */
    if ($field_item_list->isEmpty()) {
      return;
    }

    /** @var \Drupal\user\UserInterface $account */
    if (($account = $field_item_list->getEntity())->isNew()) {
      return;
    }

    /** @var \Drupal\masquerade_field\Plugin\Field\FieldType\MasqueradeFieldItem $field_item */
    foreach ($field_item_list as $field_item) {
      if ($field_item->target_id === $account->id()) {
        $this->context->addViolation($constraint->message, [
          '%user' => $account->getDisplayName(),
        ]);
        return;
      }
    }
  }

}
