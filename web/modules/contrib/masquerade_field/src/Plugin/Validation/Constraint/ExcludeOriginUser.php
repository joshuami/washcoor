<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that a user cannot be set to masquerade as itself.
 *
 * @Constraint(
 *   id = "ExcludeOriginUser",
 *   label = @Translation("Exclude user that masquerades", context = "Validation"),
 * )
 */
class ExcludeOriginUser extends Constraint {

  /**
   * Violation message.
   *
   * @var string
   */
  public $message = "User %user cannot masquerade as itself.";

}
