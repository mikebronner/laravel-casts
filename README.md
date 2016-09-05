# Laravel Casts
## Installation
To install in Laravel 5.1 (lts) or Laravel 5.3 (current):
```sh
composer require genealabs/laravel-casts
```

## Work In Progress
This is an evolution of GeneaLabs/Bones-Macros, more details to come.

## Testing
- Add the following entry to your `phpunit.xml` config file:
  ```xml
<!--
  <testsuites>
      <testsuite name="Application Test Suite">
-->
          <directory suffix="Test.php">./vendor/genealabs/laravel-casts/tests</directory>
<!--
      </testsuite>
  </testsuites>
-->
  ```
  - Run `vendor/bin/phpunit` from the base directory of your project.
