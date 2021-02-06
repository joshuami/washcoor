<?php

declare(strict_types = 1);

namespace Drupal\Tests\masquerade_field\Traits;

use Drupal\user\Entity\Role;

/**
 * Provides test reusable code.
 */
trait MasqueradeFieldTrait {

  /**
   * Testing user.
   *
   * @var \Drupal\user\UserInterface;
   */
  protected $account;

  /**
   * Testing user.
   *
   * @var \Drupal\user\UserInterface;
   */
  protected $targetUser1;

  /**
   * Testing user.
   *
   * @var \Drupal\user\UserInterface;
   */
  protected $targetUser2;

  /**
   * Asserts that a link with a given label links to a given URL.
   *
   * @param string $label
   *   The link label.
   * @param string $expected_href
   *   The expected value of the 'href' attribute.
   *
   * @throws \Exception
   *   If the link has no 'href' attribute.
   */
  protected function assertLinkHref(string $label, string $expected_href): void {
    $links = $this->getSession()->getPage()->findAll('named', ['link', $label]);
    $this->assertNotEmpty($links);
    $link = reset($links);

    if (!$link->hasAttribute('href')) {
      throw new \Exception("Link '$label' is missing the 'href' attribute.");
    }

    // Remove the base path and the query string.
    $actual_href = substr(parse_url($link->getAttribute('href'), PHP_URL_PATH), strlen(base_path()) - 1);

    $this->assertSame($expected_href, $actual_href);
  }

  /**
   * Provides reusable testing code for functional tests.
   *
   * @see \Drupal\Tests\masquerade_field\Functional\MasqueradeFieldTest::testFieldView()
   * @see \Drupal\Tests\masquerade_field\Functional\MasqueradeFieldViewsBlockTest::testFieldViewsBlock()
   */
  protected function doTest(): void {
    $session = $this->getSession();
    $assert = $this->assertSession();

    $this->targetUser1 = $this->createUser();
    $this->targetUser2 = $this->createUser([
      'access user profiles',
      'view own masquerade field',
    ], NULL, FALSE, [
      // This user is able to masquerade as target user 1.
      'masquerade_as' => [$this->targetUser1],
    ]);

    $role_name = $this->createRole([], 'test_role');
    $this->account = $this->createUser([], NULL, FALSE, [
      'roles' => [$role_name],
      'masquerade_as' => [$this->targetUser1, $this->targetUser2],
    ]);

    $this->drupalLogin($this->account);

    $this->drupalGet($this->account->toUrl());
    $assert->pageTextNotContains('Masquerade as');
    $assert->linkNotExists($this->targetUser1->label());
    $assert->linkNotExists($this->targetUser2->label());

    /** @var \Drupal\user\RoleInterface $role */
    $role = Role::load($role_name);
    // Add the permission that allows a user to see their 'masquerade as' list.
    $role->grantPermission('view own masquerade field')->save();

    $session->reload();

    $assert->pageTextContains('Masquerade as');
    $this->assertLinkHref($this->targetUser1->label(), "/user/{$this->targetUser1->id()}/masquerade");
    $this->assertLinkHref($this->targetUser2->label(), "/user/{$this->targetUser2->id()}/masquerade");

    // Masquerade as target user 2.
    $this->clickLink($this->targetUser2->label());
    $assert->pageTextContains("You are now masquerading as {$this->targetUser2->label()}.");

    // As target user 2 is able masquerade as target user 1 they should see the
    // 'Masquerade as' field but, as they're already masquerading, the links
    // should point to the user profiles rather than masquerade route.
    $assert->pageTextContains('Masquerade as');
    $this->assertLinkHref($this->targetUser1->label(), "/user/{$this->targetUser1->id()}");
    $assert->linkNotExists($this->targetUser2->label());

    // Check that others cannot see the links even they have higher permissions.
    $this->drupalLogin($this->createUser(['administer users']));
    $this->drupalGet($this->account->toUrl());
    $assert->pageTextNotContains('Masquerade as');
    $assert->linkNotExists($this->targetUser1->label());
    $assert->linkNotExists($this->targetUser2->label());
  }

}
