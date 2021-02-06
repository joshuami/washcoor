<?php

declare(strict_types = 1);

namespace Drupal\Tests\masquerade_field\Functional;

use Drupal\Core\Entity\Entity\EntityViewDisplay;
use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\masquerade_field\Traits\MasqueradeFieldTrait;

/**
 * Tests the masquerade field block.
 *
 * @group masquerade_field
 */
class MasqueradeFieldViewsBlockTest extends BrowserTestBase {

  use MasqueradeFieldTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'block',
    'masquerade_field',
    'views',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->placeBlock('views_block:masquerade_as-block');
    // Remove the field from view so that we check only the links from block.
    EntityViewDisplay::create([
      'targetEntityType' => 'user',
      'bundle' => 'user',
      'mode' => 'default',
      'status' => TRUE,
    ])->removeComponent('masquerade_as')
      ->save();
  }

  /**
   * Tests the Views block.
   */
  public function testFieldViewsBlock(): void {
    $this->doTest();
  }

}
