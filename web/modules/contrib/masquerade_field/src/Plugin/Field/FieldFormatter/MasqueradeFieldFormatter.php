<?php

declare(strict_types = 1);

namespace Drupal\masquerade_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\masquerade\Masquerade;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a formatter for masquerade field.
 *
 * @FieldFormatter(
 *   id = "masquerade_field_default",
 *   label = @Translation("Masquerade field"),
 *   description = @Translation("Displays a list of user links to masquerade as."),
 *   field_types = {
 *     "masquerade_field",
 *   },
 * )
 */
class MasqueradeFieldFormatter extends EntityReferenceLabelFormatter {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The masquerade service.
   *
   * @var \Drupal\masquerade\Masquerade
   */
  protected $masquerade;

  /**
   * Constructs a new plugin instance.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   The current user.
   * @param \Drupal\masquerade\Masquerade $masquerade
   *   The masquerade service.
   */
  public function __construct(string $plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, string $label, string $view_mode, array $third_party_settings, AccountProxyInterface $current_user, Masquerade $masquerade) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->currentUser = $current_user;
    $this->masquerade = $masquerade;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('current_user'),
      $container->get('masquerade')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    if (!$parent_elements = parent::viewElements($items, $langcode)) {
      return $parent_elements;
    }

    // Only the current user can masquerade unless they're not masquerading yet.
    $can_masquerade = ($items->getEntity()->id() == $this->currentUser->id()) && !$this->masquerade->isMasquerading();

    $elements = [];
    foreach ($parent_elements as $element) {
      if (isset($element['#options']['entity_type']) && $element['#options']['entity_type'] === 'user' && isset($element['#options']['entity'])) {
        /** @var \Drupal\user\UserInterface $target_account */
        $target_account = $element['#options']['entity'];
        // The parent method links to the user profile.
        if ($can_masquerade) {
          $element['#url'] = $target_account->toUrl('masquerade');
        }
        // The parent method is using the entity label. But the 'user' entity
        // type is smarter, we can display the real name.
        $element['#title'] = $target_account->getDisplayName();
        $elements[] = $element;
      }
    }

    return $elements;
  }

}
