# WilyCode Translation Languages

[![PHP 8.4+](https://img.shields.io/badge/PHP-8.4%2B-777BB4)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Tests](https://github.com/wilycode/translation-languages/actions/workflows/tests.yml/badge.svg)](https://github.com/wilycode/translation-languages/actions/workflows/tests.yml)
[![Packagist](https://img.shields.io/packagist/v/wilycode/translation-languages)](https://packagist.org/packages/wilycode/translation-languages)

**Language-specific pluralization rules and locale configuration files for PHP 8.4+.** Includes **25 languages**, a Brazilian Portuguese pluralization variant, and **27 regional configurations** for dates, numbers, and currencies.

Use the complete Composer package, **or download only the languages your application needs**. You do not have to install the entire language collection.

> ### WilyCode PHP Ecosystem
>
> Part of the **[WilyCode PHP Ecosystem](https://github.com/wilycode/wilycode)** — independent, reusable PHP components, each with its own repository, versions, and Composer package.
>
> **[Explore all WilyCode packages →](https://github.com/wilycode/wilycode)**

## Contents

- [Overview](#overview)
- [Installation](#installation)
- [Quick start (Composer)](#quick-start-composer)
- [Install only selected languages](#install-only-selected-languages)
- [Supported languages and locales](#supported-languages-and-locales)
- [Pluralization](#pluralization)
- [Locale formatting](#locale-formatting)
- [Custom locale configuration](#custom-locale-configuration)
- [Add a new language](#add-a-new-language)
- [API reference](#api-reference)
- [Upgrading from v0.1.0](#upgrading-from-v010)
- [Limitations and security](#limitations-and-security)
- [Development](#development)
- [Related packages](#related-packages)
- [License](#license)

## Overview

This package supplies **language data and rules**, not the locale formatting engine or a message translator.

| Provided here | Provided by [`wilycode/translation`](https://github.com/wilycode/translation) |
| --- | --- |
| `Language\Pl`, `Language\En`, and other language classes | `LanguageInterface`, `TranslatorInterface`, `DateStyle` |
| `Language\PtBr` for Brazilian Portuguese | `LocaleFormatter` and `LocaleFormatterFactory` |
| `src/resources/locales/*.php` regional configuration files | `LocaleFormatterInterface`, `MessageFormatter` |

The distinction matters: **`LocaleFormatter` and `LocaleFormatterFactory` belong to the core `wilycode/translation` package since v0.1.1**. They are no longer part of this repository.

Pluralization rules return **form indexes**, not translated text. Translation message lookup is the responsibility of a separate translator implementation.

## Installation

**Requirements:** PHP 8.4 or newer and `wilycode/translation:^0.1.1`.

There are two supported approaches:

| Approach | Files added to your project | Updates |
| --- | --- | --- |
| **[Composer](#quick-start-composer)** | All 25 languages and 27 regional configurations, plus the core package | Composer-managed |
| **[Selected files](#install-only-selected-languages)** | Only copied language classes and locale files; install just the core package with Composer | You maintain copied files |

### Complete library via Composer

```bash
composer require wilycode/translation-languages:^0.2
```

Composer also installs the required core library. Choose this if your project needs many languages or you want automatic package updates.

### Minimal application via selected files

```bash
composer require wilycode/translation:^0.1.1
```

Then download only the relevant `Language/*.php` classes and/or `resources/locales/*.php` data files from this repository. **Do not install `wilycode/translation-languages`** for this option.

## Quick start (Composer)

The examples below assume that you installed the **complete** `wilycode/translation-languages` package.

### Pluralization

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use WilyCode\Translation\Language\Pl;

$polish = new Pl();

echo $polish->getCode();                // pl
echo $polish->getNumberOfPluralForms(); // 3
echo $polish->getPluralForm(1);        // 0
echo $polish->getPluralForm(2);        // 1
echo $polish->getPluralForm(5);        // 2
```

### Dates, numbers, and currencies

The formatter itself comes from `wilycode/translation`. The region files come from this package:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$factory = new LocaleFormatterFactory(
    __DIR__ . '/vendor/wilycode/translation-languages/src/resources/locales',
    'en-US',
);

$formatter = $factory->forCode('pl-PL');
$date = new DateTimeImmutable('2026-07-08');

echo $formatter->formatDate($date);                  // 08.07.2026
echo $formatter->formatDate($date, DateStyle::Long); // 8 lipca 2026 r.
echo $formatter->formatNumber(1234.5);              // 1 234,50
echo $formatter->formatMoney(1234.5);               // PLN 1 234,50
```

Paths above assume the example script is in your project root. In other layouts, pass the actual absolute location of your installed package's `src/resources/locales` directory.

## Install only selected languages

You can use this repository **as a source of individual files**, without downloading or keeping the whole collection in your application.

For a **Polish-only** application:

### Step 1 — Install the common functionality

```bash
composer require wilycode/translation:^0.1.1
```

This provides `LanguageInterface`, `LocaleFormatter`, and `LocaleFormatterFactory`, but none of the 25 language definitions or regional data files.

### Step 2 — Download two files

| Download from this repository | Copy to your application | Use |
| --- | --- | --- |
| [`src/Language/Pl.php`](src/Language/Pl.php) | `app/Translation/Language/Pl.php` | Polish plural forms |
| [`src/resources/locales/pl-pl.php`](src/resources/locales/pl-pl.php) | `resources/locales/pl-pl.php` | Polish regional formatting |

```text
app/
└── Translation/
    └── Language/
        └── Pl.php
resources/
└── locales/
    └── pl-pl.php
```

For **pluralization only**, copy `Pl.php`; for **regional formatting only**, copy `pl-pl.php`. Both features are independent. You **do not** need to copy `LocaleFormatter.php`, its factory, or other languages.

To download a file, open its link above on GitHub and choose **Download raw file**. Prefer an explicit release/tag when you want reproducible copies.

### Step 3 — Adapt the namespace of the copied class

In `app/Translation/Language/Pl.php`, replace the original namespace declaration with:

```php
namespace App\Translation\Language;
```

Keep `use WilyCode\Translation\LanguageInterface;` as it is. Ensure your application has an `App\` PSR-4 mapping to `app/` (common in frameworks such as Laravel):

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

**Merge** this mapping with your existing `composer.json`; do not replace the full file. If you change the mapping, run `composer dump-autoload`. The `pl-pl.php` locale configuration is a PHP array and needs no namespace change.

### Step 4 — Use only your selected files

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Translation\Language\Pl;
use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$language = new Pl();
$factory = new LocaleFormatterFactory(__DIR__ . '/resources/locales', 'pl-PL');
$formatter = $factory->forCode('pl-PL');

echo $language->getPluralForm(2); // 1
echo $formatter->formatDate(
    new DateTimeImmutable('2026-07-08'),
    DateStyle::Long,
); // 8 lipca 2026 r.
```

**Need English later?** Copy [`En.php`](src/Language/En.php) to `app/Translation/Language/En.php` and [`en-us.php`](src/resources/locales/en-us.php) to `resources/locales/en-us.php`. Update the namespace of `En.php`. No other language files are required.

**Important:** the factory looks for an exact locale file, then a base-language alias, then the configured default. If your application passes `pl` instead of `pl-PL`, also copy [`pl.php`](src/resources/locales/pl.php) **and** its referenced `pl-pl.php` into the same directory. Source-copied files are maintained by your application: they will **not** receive automatic Composer updates.

## Supported languages and locales

There are **25 languages**, plus `PtBr` as a separate pluralization variant for Brazilian Portuguese (**26 classes**). Locale data supplies **27 region-specific files**; base-language alias files are provided in addition to those regional resources.

| Language | Class | Region file |
| --- | --- | --- |
| Arabic | `Ar` | `ar-sa.php` |
| Chinese (Simplified) | `Zh` | `zh-cn.php` |
| Czech | `Cs` | `cs-cz.php` |
| Danish | `Da` | `da-dk.php` |
| Dutch | `Nl` | `nl-nl.php` |
| English (US / UK) | `En` | `en-us.php`, `en-gb.php` |
| Finnish | `Fi` | `fi-fi.php` |
| French | `Fr` | `fr-fr.php` |
| German | `De` | `de-de.php` |
| Greek | `El` | `el-gr.php` |
| Hindi | `Hi` | `hi-in.php` |
| Hungarian | `Hu` | `hu-hu.php` |
| Italian | `It` | `it-it.php` |
| Japanese | `Ja` | `ja-jp.php` |
| Korean | `Ko` | `ko-kr.php` |
| Norwegian Bokmål | `Nb` | `nb-no.php` |
| Polish | `Pl` | `pl-pl.php` |
| Portuguese (Portugal / Brazil) | `Pt`, `PtBr` | `pt-pt.php`, `pt-br.php` |
| Romanian | `Ro` | `ro-ro.php` |
| Russian | `Ru` | `ru-ru.php` |
| Slovak | `Sk` | `sk-sk.php` |
| Spanish | `Es` | `es-es.php` |
| Swedish | `Sv` | `sv-se.php` |
| Turkish | `Tr` | `tr-tr.php` |
| Ukrainian | `Uk` | `uk-ua.php` |

Language classes use the namespace `WilyCode\Translation\Language` when installed through Composer. Their plural-form indexes and count are available through `getNumberOfPluralForms()` and `getPluralForm(int $count)`.

A **language rule** controls plural forms, whereas a **regional resource** controls dates, number separators, and default currency. They are selected separately. `PtBr` reports the language code `pt`, so explicitly choose that class for Brazilian Portuguese pluralization.

## Pluralization

`getPluralForm()` returns a **zero-based integer index**, not a word. It should be used with translation message forms in the exact order expected by that language class.

| Count | `En` | `Pl` | `De` |
| ---: | ---: | ---: | ---: |
| 0 | 1 | 2 | 1 |
| 1 | 0 | 0 | 0 |
| 2 | 1 | 1 | 1 |
| 5 | 1 | 2 | 1 |
| 22 | 1 | 1 | 1 |

Some languages are considerably more complex. For example:

```php
use WilyCode\Translation\Language\Ar;
use WilyCode\Translation\Language\Ja;
use WilyCode\Translation\Language\Pt;
use WilyCode\Translation\Language\PtBr;

(new Ar())->getPluralForm(0);    // 0 (zero)
(new Ar())->getPluralForm(2);    // 2 (two)
(new Ja())->getPluralForm(5);    // 0 (only form)
(new Pt())->getPluralForm(0);    // 2 (Portugal: other)
(new PtBr())->getPluralForm(0);  // 0 (Brazil: one)
```

These rules operate on **integer counts**. They are not full ICU/CLDR plural formatting and do not handle fractional plural operands. The rules should be tested with the actual message forms used by your translator.

## Locale formatting

The core `LocaleFormatterFactory` reads a PHP configuration from the resource directory you specify:

```php
use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$factory = new LocaleFormatterFactory(
    __DIR__ . '/vendor/wilycode/translation-languages/src/resources/locales',
    'en-US',
);

$date = new DateTimeImmutable('2026-07-08');

$factory->forCode('en-US')->formatDate($date);                // 07/08/2026
$factory->forCode('pl-PL')->formatDate($date);                // 08.07.2026
$factory->forCode('pl-PL')->formatDate($date, DateStyle::Short); // 2026-07-08
$factory->forCode('pl-PL')->formatDate($date, DateStyle::Long);  // 8 lipca 2026 r.
```

The default date style is **`DateStyle::Medium`**, not `Short`. `en-US` and `pl-PL` use `Y-m-d` for their **short** date configuration, while their **medium** formats are `m/d/Y` and `d.m.Y` respectively.

Locale files define PHP `DateTime` patterns, separators, currency codes, and some local month-name maps. `formatMoney()` produces a **currency code followed by a formatted number** (e.g. `PLN 1 234,50`), not automatic currency symbols or conversion. Indian locale `hi-IN` supports Indian digit grouping; `ar-SA` does not automatically convert Western digits to Arabic-Indic digits.

## Custom locale configuration

You can use your own locale resources without editing `vendor/`:

```text
resources/
└── locales/
    ├── en-us.php
    └── pl-pl.php
```

```php
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$factory = new LocaleFormatterFactory(__DIR__ . '/resources/locales', 'en-US');
$polish = $factory->forCode('pl-PL');
```

Copy and modify the regional array files in your application. The factory searches **only the configured directory**: it does not merge files from multiple directories or fall back to resources installed elsewhere. If you choose `en-US` as a default, `en-us.php` must also exist in your custom directory if the requested locale is unavailable.

## Add a new language

The library is extensible without modifying any code inside `vendor/`. An example for **Indonesian (`id-ID`)**, which is not one of the bundled 25 languages, is available at:

- [`examples/Language/Id.php`](examples/Language/Id.php) — implements `LanguageInterface` (one plural form).
- [`examples/resources/locales/id-id.php`](examples/resources/locales/id-id.php) — region-specific date, number, and currency configuration.

Copy these into your application as `app/Language/Id.php` and `resources/locales/id-id.php` respectively, then ensure your `App\` autoload mapping is present.

```php
use App\Language\Id;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$language = new Id();
$factory = new LocaleFormatterFactory(__DIR__ . '/resources/locales', 'id-ID');

$language->getPluralForm(10);            // 0
$factory->forCode('id-ID')->formatMoney(1234.5); // IDR 1.235
```

The example PHP files are available in the **GitHub repository** and are excluded from the Composer distribution. If you create your own rule, implement the three methods of `LanguageInterface` and verify the locale's pluralization categories rather than reusing rules from another language.

## API reference

This package exposes **language classes and PHP configuration arrays**. Its language classes implement `WilyCode\Translation\LanguageInterface`:

| Method | Meaning |
| --- | --- |
| `getCode(): string` | Language identifier, such as `pl` or `en`. |
| `getNumberOfPluralForms(): int` | Number of supported plural-form indexes. |
| `getPluralForm(int $count): int` | Index selected for an integer count. |

**Provided by core `wilycode/translation:^0.1.1`:**

| API | Purpose |
| --- | --- |
| `LocaleFormatterFactory::__construct(string $resourcesDir, string $defaultCode = 'en-US')` | Select the source directory and fallback locale. |
| `LocaleFormatterFactory::forCode(?string $code): LocaleFormatter` | Load a locale and fall back if necessary. |
| `LocaleFormatter::formatDate(DateTimeInterface $date, DateStyle $style = DateStyle::Medium): string` | Format a localized date. |
| `LocaleFormatter::formatDateTime(DateTimeInterface $dateTime, DateStyle $style = DateStyle::Medium): string` | Format a localized date and time. |
| `LocaleFormatter::formatNumber(float\|int $number, int $fractionDigits = 2): string` | Format a number. |
| `LocaleFormatter::formatMoney(float\|int $amount, ?string $currency = null, ?int $fractionDigits = null): string` | Format a number with a currency code. |

Factory codes are case-insensitive and underscores are normalized (`EN_gb` becomes `en-gb`). Its fallback order is: exact code, base-language alias file (if present), then default. An invalid code falls back to the default; if no resource can be found, it throws `RuntimeException`. A copied base alias such as `pl.php` requires its sibling regional file `pl-pl.php`.

## Upgrading from v0.1.0

**v0.2.0 reorganized package ownership**. Applications using the old formatter implementations should:

1. Require `wilycode/translation:^0.1.1` (the dependency is already required by `translation-languages:^0.2`).
2. Change formatter imports to `WilyCode\Translation\LocaleFormatter\LocaleFormatter` and `WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory` from the **core package**. The namespaces are the same; the Composer package supplying them changed.
3. Replace `LocaleFormatterEn` and `LocaleFormatterPl` with the shared factory and `forCode('en-US')` / `forCode('pl-PL')`.
4. If you copy files manually, copy only the desired `Language/*.php` classes and regional resource files, not the formatters.

The `v0.1.0` tag remains available for projects that have not migrated.

## Limitations and security

- This package supplies plural-form rules and regional configuration data, **not** translated messages or automatic application language selection.
- PHP locale files are **executable PHP**, not passive JSON. Only use trusted source files; never load PHP code uploaded by untrusted users.
- The formatter uses a single configured locale directory. It does not merge separate application and vendor resource directories.
- A `DateStyle::Long` month-name map is used only where the resource defines one. Raw PHP date formatting and other custom styles may use English month names.
- This is not a complete CLDR/ICU implementation. There is no fractional cardinal pluralization, currency conversion, automatic digit shaping, or HTML escaping.
- Manually copied language files do not receive updates automatically. Keep them in version control and review fixes from upstream.

## Development

```bash
composer validate --strict
composer install
composer test
```

The tests run on PHP 8.4 via GitHub Actions. See [CONTRIBUTING.md](CONTRIBUTING.md) and [CHANGELOG.md](CHANGELOG.md).

## Related packages

| Package | Purpose |
| --- | --- |
| [`wilycode/translation`](https://github.com/wilycode/translation) | Core contracts, `MessageFormatter`, `LocaleFormatter`, and `LocaleFormatterFactory`. |
| [`wilycode/translation-array`](https://github.com/wilycode/translation-array) | Array-based message translator (separate package; install when available). |
| [`wilycode/translation-database`](https://github.com/wilycode/translation-database) | Database-backed message translator (separate package; install when available). |

## License

MIT — [LICENSE](LICENSE). Copyright © 2026 Simon Piter.
