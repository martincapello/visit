<?php declare(strict_types=1);

/*
 * Copyright (c) Igara Studio S.A.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

use PHPUnit\Framework\TestCase;

use IgaraStudio\Visit;
use function IgaraStudio\visit;

Visit::$shared_options = [ 'docroot' => __DIR__ . '/public',
                           'script' => __DIR__ . '/public/index.php',
                           'patchwork' => __DIR__ . '/../vendor/antecedent/patchwork/Patchwork.php'];

final class VisitTest extends TestCase
{
  public function testIndex(): void
  {
    visit('/')->assertSee('Hello World')
              ->assertDontSee('Final');
  }

  public function testRedirect(): void
  {
    visit('/redirect')->assertSee('Final');

    visit('/redirect', [ 'followRedirect' => false ])
      ->assertRedirect('/destination')
      ->followRedirect()
      ->assertSee('Final');
  }

  public function test404(): void
  {
    visit('/not-found')->assertStatusCode(404);
  }

  public function testMocking(): void
  {
    visit('/bye')
      ->assertSee('Bye World')
      ->mock('bye_world', 'function() { return "I\'m a mock!"; }')
      ->get('/bye')
      ->assertSee("I'm a mock!")
      ->unmock('bye_world')
      ->get('/bye')
      ->assertSee('Bye World');
  }
}
