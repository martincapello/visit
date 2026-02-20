# igarastudio/visit

With `visit` you can simulate your website navigation through
`php-cgi` without running a web server or a web browser. It supports
cookies so you can use your PHP session to simulate user logins, etc.

## Example

```php
use PHPUnit\Framework\TestCase;

use IgaraStudio\Visit;
use function IgaraStudio\visit;

// If this test is in /tests/ and your index.php file in /public/ dir
Visit::$shared_options = [ 'docroot' => __DIR__ . '/../public',
                           'script' => __DIR__ . '/../public/index.php' ];

class UserLoginTest extends TestCase
{
  // Simulates a GET request to /login to check if the 'Login' text appears
  // in the page.
  public function testVisibleLoginButton(): void
  {
    visit('/login')->assertSee('Login');
  }

  // Simulates a POST request to /login with a specific form data, checks
  public function testInvalidLogin(): void
  {
    visit()
      ->post('/login', ['username' => 'invalid',
                        'password' => 'invalid'])
      ->assertSee('Invalid user or password');
  }

  // This login works because we process Cookie and Set-Cookie to keep the PHP
  // session in the same visit().
  public function testValidLogin(): void
  {
    visit()
      ->post('/login', ['username' => 'valid-username',
                        'password' => 'valid-password'])
      ->assertSee('Dashboard');
  }
}
```

## Installation

You can add this library as a dependency to your project using
[Composer](https://getcomposer.org/), generally you only need this
library during development, for instance to run your project's test
suite:

```
composer require --dev igarastudio/visit
```
