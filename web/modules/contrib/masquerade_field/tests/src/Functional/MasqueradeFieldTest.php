<?php

declare(strict_types = 1);

namespace Drupal\Tests\masquerade_field\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\masquerade_field\Traits\MasqueradeFieldTrait;
use Drupal\user\Entity\User;

/**
 * Tests the masquerade field.
 *
 * @group masquerade_field
 */
class MasqueradeFieldTest extends BrowserTestBase {

  use MasqueradeFieldTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'masquerade_field',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Tests the access to the 'Masquerade as' field in the user edit form.
   */
  public function testFieldWidgetEdit(): void {
    $account = $this->createUser();
    $target_account = $this->createUser();

    // Login as a user not granted with 'edit masquerade field' permission.
    $this->drupalLogin($this->createUser(['administer users']));

    // Check that the 'Masquerade as' field is not accessible.
    $this->drupalGet($account->toUrl('edit-form'));
    $this->assertSession()->fieldNotExists('Masquerade as');

    // Login as a user granted with 'edit masquerade field' permission.
    $this->drupalLogin($this->createUser([
      'administer users',
      'edit masquerade field',
    ]));

    // Check that the 'Masquerade as' field is accessible.
    $this->drupalGet($account->toUrl('edit-form'));
    $this->assertSession()->fieldExists('Masquerade as');

    // Enter a duplicate target.
    $page = $this->getSession()->getPage();
    $page->fillField('masquerade_as[0][target_id]', "{$target_account->getAccountName()} ({$target_account->id()})");
    $page->pressButton('Save');
    $page->fillField('masquerade_as[1][target_id]', "{$target_account->getAccountName()} ({$target_account->id()})");
    $page->pressButton('Save');
    // Check that duplicates were filtered out.
    $checked_account = User::load($account->id());
    $this->assertCount(1, $checked_account->get('masquerade_as'));
    $this->assertSame($target_account->label(), $checked_account->get('masquerade_as')->entity->label());

    // Try to add $account as target user, i.e. user masquerading as itself.
    $page->fillField('masquerade_as[1][target_id]', "{$account->getAccountName()} ({$account->id()})");
    $page->pressButton('Save');
    // Check that a user cannot masquerade as itself
    $this->assertSession()->pageTextContains("User {$account->getDisplayName()} cannot masquerade as itself.");

    // Test a user editing its own account (no permission).
    $this->drupalLogin($account);

    // Check that the 'Masquerade as' field is not accessible.
    $this->drupalGet($account->toUrl('edit-form'));
    $this->assertSession()->fieldNotExists('Masquerade as');
  }

  /**
   * Tests the access to the 'Masquerade as' field in the user profile page.
   */
  public function testFieldView(): void {
    $this->doTest();

    // Check that a user granted with "view any masquerade field" is able to see
    // the field links but the links are pointing to target user profiles.
    $this->drupalLogin($this->createUser([
      'access user profiles',
      'view any masquerade field',
     ]));
    $this->drupalGet($this->account->toUrl());
    $this->assertSession()->pageTextContains('Masquerade as');
    $this->assertLinkHref($this->targetUser1->label(), "/user/{$this->targetUser1->id()}");
    $this->assertLinkHref($this->targetUser2->label(), "/user/{$this->targetUser2->id()}");
  }

}
