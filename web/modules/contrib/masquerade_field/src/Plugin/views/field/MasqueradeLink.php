<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\views\field;

use Drupal\Core\Access\AccessManagerInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultInterface;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\masquerade\Masquerade;
use Drupal\views\Plugin\views\field\EntityLink;
use Drupal\views\ResultRow;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a views link field that allows a user to masquerade as other user.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("masquerade_link")
 */
class MasqueradeLink extends EntityLink {

  /**
   * The masquerade service.
   *
   * @var \Drupal\masquerade\Masquerade
   */
  protected $masquerade;

  /**
   * Constructs a new plugin instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Access\AccessManagerInterface $access_manager
   *   The access manager.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface|null $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityRepositoryInterface|null $entity_repository
   *   The entity repository.
   * @param \Drupal\Core\Language\LanguageManagerInterface|null $language_manager
   *   The language manager.
   * @param \Drupal\masquerade\Masquerade $masquerade
   *   The masquerade service.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, AccessManagerInterface $access_manager, EntityTypeManagerInterface $entity_type_manager, EntityRepositoryInterface $entity_repository, LanguageManagerInterface $language_manager, Masquerade $masquerade) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $access_manager, $entity_type_manager, $entity_repository, $language_manager);
    $this->masquerade = $masquerade;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('access_manager'),
      $container->get('entity_type.manager'),
      $container->get('entity.repository'),
      $container->get('language_manager'),
      $container->get('masquerade')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getUrlInfo(ResultRow $row) {
    // A user cannot masquerade twice, so link to the canonical user profile
    // page if the user is already masquerading.
    // @todo Move the logic in ::getEntityLinkTemplate() after #3110784 gets in.
    // @see https://www.drupal.org/project/drupal/issues/3110784
    $template = $this->masquerade->isMasquerading() ? 'canonical' : 'masquerade';
    $entity = $this->getEntity($row);
    if ($this->languageManager->isMultilingual()) {
      $entity = $this->getEntityTranslation($entity, $row);
    }
    return $entity->toUrl($template)->setAbsolute($this->options['absolute']);
  }

  /**
   * {@inheritdoc}
   */
  protected function renderLink(ResultRow $row): string {
    parent::renderLink($row);
    return $this->getEntity($row)->getDisplayName();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkUrlAccess(ResultRow $row): AccessResultInterface {
    // A user that can access the view, is able to access all the masquerade
    // links for the users they can masquerade as.
    return AccessResult::allowed();
  }

}
