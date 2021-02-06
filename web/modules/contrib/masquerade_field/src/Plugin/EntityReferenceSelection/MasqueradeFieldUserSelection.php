<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\EntityReferenceSelection;

use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\user\Plugin\EntityReferenceSelection\UserSelection;

/**
 * Provides specific access control for the user entity type.
 *
 * @EntityReferenceSelection(
 *   id = "masquerade_field_user",
 *   label = @Translation("User selection excluding current user"),
 *   entity_types = {"user"},
 *   group = "masquerade_field_user",
 *   weight = 1,
 * )
 */
class MasqueradeFieldUserSelection extends UserSelection {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS'): QueryInterface {
    $query = parent::buildEntityQuery($match, $match_operator);
    // @todo In #3107746, add a new query condition that filters out the user
    //   being edited, as a user cannot masquerade as itself. Right now there's
    //   no way for an entity reference selection plugin to access the context
    //   where is used, e.g. the current widget instance, the field definition,
    //   the host entity. This is handled in #2826826.
    // @see https://www.drupal.org/project/drupal/issues/2826826
    // @see https://www.drupal.org/project/masquerade_field/issues/3107746
    return $query;
  }

}
