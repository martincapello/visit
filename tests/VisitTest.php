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
                           'script' => __DIR__ . '/public/index.php' ];

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
}
