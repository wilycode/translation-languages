# Contributing to WilyCode Translation Languages

Thank you for improving WilyCode Translation Languages. Please open an issue before making changes to public interfaces or locale semantics.

## Requirements

- PHP 8.4 or newer
- Composer 2

## Development

```bash
composer validate --strict
composer install
composer test
```

Use `declare(strict_types=1);` in PHP files. Add PHPUnit tests for new languages, plural forms and regional formatting. Update English `README.md` and `CHANGELOG.md` when changing behavior.

## Adding a language

Prefer implementing `WilyCode\Translation\LanguageInterface` and providing a regional resource such as `src/resources/locales/es-es.php`. Document plural rules and dates with representative examples, including boundary cases. Keep contributed language implementations framework-independent.

By contributing, you agree that your contribution is licensed under the [MIT License](LICENSE).
