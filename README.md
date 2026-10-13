# WilyCode Translation Languages

[![PHP 8.4+](https://img.shields.io/badge/PHP-8.4%2B-777BB4)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Tests](https://github.com/wilycode/translation-languages/actions/workflows/tests.yml/badge.svg)](https://github.com/wilycode/translation-languages/actions/workflows/tests.yml)
[![Packagist](https://img.shields.io/packagist/v/wilycode/translation-languages)](https://packagist.org/packages/wilycode/translation-languages)

**Ready-to-use pluralization rules for 25 languages and formatters for 27 locales, built for PHP 8.4+.** Install the complete library with Composer **or copy only the language classes and locale files your application needs**. Unused languages do not have to be downloaded or kept in your project.

> **WilyCode PHP Ecosystem**
>
> This library is part of **[WilyCode](https://github.com/wilycode/wilycode)** — independent PHP packages with their own repositories, releases and Composer installations.
>
> **[Explore the WilyCode ecosystem →](https://github.com/wilycode/wilycode)**

## Table of contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Install only selected languages (without the full package)](#install-only-selected-languages-without-the-full-package)
- [Quick start](#quick-start)
- [Supported languages and locales](#supported-languages-and-locales)
- [Choose only the languages your application needs](#choose-only-the-languages-your-application-needs)
- [Customize locale resources](#customize-locale-resources)
- [Add a new language](#add-a-new-language)
- [Pluralization](#pluralization)
- [Date, number and currency formatting](#date-number-and-currency-formatting)
- [API reference](#api-reference)
- [Integrations](#integrations)
- [Limitations and security](#limitations-and-security)
- [Development and license](#development-and-license)

## Introduction

`wilycode/translation-languages` supplies **concrete language rules and locale formatters** for the [wilycode/translation](https://github.com/wilycode/translation) contracts.

| Component | Purpose |
| --- | --- |
| `Language\En`, `Language\Pl`, `Language\De`, and 22 more | Implement `LanguageInterface` with plural-form indexes for 25 languages. |
| `LocaleFormatter\LocaleFormatter` | Format values from a PHP locale configuration array. |
| `LocaleFormatter\LocaleFormatterFactory` | Load regional configuration files by locale code, with fallback. |
| `LocaleFormatter\LocaleFormatterEn` | Convenient English (US) formatter. |
| `LocaleFormatter\LocaleFormatterPl` | Convenient Polish formatter. |
| `src/resources/locales/*.php` | Regional date, time, number, and currency defaults. |

**What this package does not do:** it does not translate message keys, store translated strings, pick a user language automatically, or bundle an ICU/CLDR translation engine. Use a translator implementation (or your own) for message lookup.

## Installation

**Two ways to use this library:**

| Approach | What gets installed | Best for |
| --- | --- | --- |
| [Copy selected languages](#install-only-selected-languages-without-the-full-package) | Only the language and locale files you choose, plus the shared `wilycode/translation` contracts | Small applications, fixed language lists, minimal application files |
| Install with Composer | The full library: 25 language definitions and 27 regional locale resources | Applications using many languages, easy package updates |

**Requirements:** PHP 8.4+ and the shared interfaces from [`wilycode/translation`](https://github.com/wilycode/translation). The base package is a dependency for either approach; you **do not need to install `wilycode/translation-languages`** when copying individual implementations.

For the complete library, run:

```bash
composer require wilycode/translation-languages
```

Composer installs the entire `translation-languages` package, including languages the application does not use. If you want only one or two languages on disk, use the selective installation guide below instead. The built-in formatters do not require `ext-intl`.

## Install only selected languages (without the full package)

**You can use individual files from this GitHub repository without installing `wilycode/translation-languages`.** For example, an application that only supports Polish needs only one pluralization class and one locale configuration, in addition to two shared formatter classes if it needs date, number and currency formatting.

### 1. Install only the shared contracts

```bash
composer require wilycode/translation:^0.1
```

This installs the **base contracts package**, not the collection of 25 language definitions. If your application already depends on `wilycode/translation`, skip this step.

### 2. Download exactly the files you need

Open each source file on GitHub and use **Download raw file** (or copy its contents). For a Polish-only application:

| File in this repository | Where to place it in your application | Needed for |
| --- | --- | --- |
| [`src/Language/Pl.php`](src/Language/Pl.php) | `app/Translation/Language/Pl.php` | Polish pluralization |
| [`src/LocaleFormatter/LocaleFormatter.php`](src/LocaleFormatter/LocaleFormatter.php) | `app/Translation/LocaleFormatter/LocaleFormatter.php` | Date, number and currency formatting |
| [`src/LocaleFormatter/LocaleFormatterFactory.php`](src/LocaleFormatter/LocaleFormatterFactory.php) | `app/Translation/LocaleFormatter/LocaleFormatterFactory.php` | Loading locale files |
| [`src/resources/locales/pl-pl.php`](src/resources/locales/pl-pl.php) | `resources/locales/pl-pl.php` | Polish regional formatting |

**If you need pluralization only**, copy just `Pl.php` and omit the formatter files. **If you need formatting only**, omit `Pl.php` and copy the formatter files and `pl-pl.php`.

Your application directory will look like this for both features:

```text
app/
└── Translation/
    ├── Language/
    │   └── Pl.php
    └── LocaleFormatter/
        ├── LocaleFormatter.php
        └── LocaleFormatterFactory.php
resources/
└── locales/
    └── pl-pl.php
```

### 3. Use your application's namespace

The copied PHP classes originally declare `WilyCode\Translation\...` namespaces. **Change only their namespace declarations** to match your application's `App\` PSR-4 autoload mapping; keep the `use WilyCode\Translation\LanguageInterface`, `LocaleFormatterInterface` and `DateStyle` imports pointing to the base contracts.

In `app/Translation/Language/Pl.php`:

```php
namespace App\Translation\Language;
```

In both `app/Translation/LocaleFormatter/*.php` files:

```php
namespace App\Translation\LocaleFormatter;
```

Your application's `composer.json` should map `App\` to `app/` (this mapping is already present in many frameworks):

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

The JSON above illustrates the relevant autoload section; **merge it into your existing `composer.json`**, do not replace your full Composer configuration. If you add or change the mapping, run `composer dump-autoload`.

### 4. Use the selected language

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Translation\Language\Pl;
use App\Translation\LocaleFormatter\LocaleFormatterFactory;
use WilyCode\Translation\DateStyle;

$language = new Pl();
$factory = new LocaleFormatterFactory(__DIR__ . '/resources/locales', 'pl-PL');
$formatter = $factory->forCode('pl-PL');

echo $language->getPluralForm(2); // 1 (few)
echo $formatter->formatDate(
    new DateTimeImmutable('2026-07-08'),
    DateStyle::Long,
); // 8 lipca 2026 r.
```

**Adding English later?** Download `src/Language/En.php` into `app/Translation/Language/En.php` and `src/resources/locales/en-us.php` into `resources/locales/en-us.php`, then change the class namespace to `App\Translation\Language`. No other language files are required. If your app uses locale aliases such as `pl` rather than `pl-PL`, also copy the corresponding alias file (`pl.php`), because aliases include the regional file from the same directory.

This is an **opt-in source-copy approach**, not an extra Composer feature: updates to the source repository will **not automatically update copied files**. Review upstream changes when upgrading your application. Keep copies under version control, preserve the MIT license attribution, and download code only from a source you trust. The convenience formatters `LocaleFormatterPl` and `LocaleFormatterEn` load resources via paths relative to their original locations; when using custom application directories, prefer the factory shown above.

## Quick start

The examples in this section assume the **full `wilycode/translation-languages` package is installed with Composer**. For apps using copied files instead, follow [selective installation](#install-only-selected-languages-without-the-full-package) and use the `App\Translation\...` namespaces shown there.

### Plural rules

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use WilyCode\Translation\Language\Pl;

$polish = new Pl();

echo $polish->getCode();              // pl
echo $polish->getNumberOfPluralForms(); // 3

echo $polish->getPluralForm(1);  // 0
echo $polish->getPluralForm(2);  // 1
echo $polish->getPluralForm(5);  // 2
```

The numbers `0`, `1` and `2` are **plural-form indexes**, not translated words. The message translator chooses the corresponding text.

### Regional formatting

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
$date = new DateTimeImmutable('2026-07-08 12:34:56');

echo $formatter->formatDate($date);                  // 08.07.2026
echo $formatter->formatDate($date, DateStyle::Long); // 8 lipca 2026 r.
echo $formatter->formatNumber(1234.5);              // 1 234,50
echo $formatter->formatMoney(1234.5);               // PLN 1 234,50
```

The resource path above is relative to an application's root directory containing `vendor/`. In other layouts, pass the correct absolute directory.

## Supported languages and locales

A **language rule** (for example, `Language\Ru`) returns a plural-form index. A **locale resource** (for example, `ru-RU`) controls date, time, decimal separators and currency. They are independent: you choose both in your application's configuration.

### Language rules (25 languages)

| Language | Code | PHP class | Integer plural forms |
| --- | --- | --- | ---: |
| English | `en` | `Language\En` | 2 |
| Polish | `pl` | `Language\Pl` | 3 |
| German | `de` | `Language\De` | 2 |
| French | `fr` | `Language\Fr` | 3 |
| Spanish | `es` | `Language\Es` | 3 |
| Italian | `it` | `Language\It` | 3 |
| Portuguese (Portugal) | `pt` | `Language\Pt` | 3 |
| Dutch | `nl` | `Language\Nl` | 2 |
| Czech | `cs` | `Language\Cs` | 3 |
| Slovak | `sk` | `Language\Sk` | 3 |
| Ukrainian | `uk` | `Language\Uk` | 3 |
| Russian | `ru` | `Language\Ru` | 3 |
| Swedish | `sv` | `Language\Sv` | 2 |
| Danish | `da` | `Language\Da` | 2 |
| Norwegian Bokmål | `nb` | `Language\Nb` | 2 |
| Finnish | `fi` | `Language\Fi` | 2 |
| Romanian | `ro` | `Language\Ro` | 3 |
| Hungarian | `hu` | `Language\Hu` | 2 |
| Greek | `el` | `Language\El` | 2 |
| Turkish | `tr` | `Language\Tr` | 2 |
| Japanese | `ja` | `Language\Ja` | 1 |
| Chinese (Simplified) | `zh` | `Language\Zh` | 1 |
| Korean | `ko` | `Language\Ko` | 1 |
| Arabic | `ar` | `Language\Ar` | 6 |
| Hindi | `hi` | `Language\Hi` | 2 |
| Portuguese (Brazil, regional variant) | `pt` | `Language\PtBr` | 3 |

`Pt` follows Portuguese as used in Portugal; `PtBr` implements the **Brazilian Portuguese** variant. Both return `pt` as their language code; select `PtBr` explicitly for `pt-BR`. All rule indexes are **zero-based**, and the ordering of categories is implementation-specific. For example Arabic uses indexes `0=zero, 1=one, 2=two, 3=few, 4=many, 5=other`; do not assume the English `0=singular, 1=plural` model applies everywhere.

For integer counts, French, Spanish, Italian and Portuguese distinguish **exact positive multiples of one million**, so they expose three plural forms (`one`, `many`, `other`). This follows CLDR integer cardinal categories; translation files must provide all returned indexes. `Japanese`, `Chinese` and `Korean` have a single plural category. `LanguageInterface` accepts integers; fractional-number plural rules are out of scope.

### Plural index conventions

Plural indexes refer to the corresponding **position in your translation forms array**. They are *not* universal across languages:

| Language rules | Index meaning (in order) |
| --- | --- |
| `En`, `De`, `Nl`, `Sv`, `Da`, `Nb`, `Fi`, `Hu`, `El`, `Tr`, `Hi` | `one`, `other` |
| `Pl`, `Ru`, `Uk` | `one`, `few`, `many` |
| `Cs`, `Sk`, `Ro` | `one`, `few`, `other` |
| `Fr`, `Es`, `It`, `Pt`, `PtBr` | `one`, `many`, `other` |
| `Ar` | `zero`, `one`, `two`, `few`, `many`, `other` |
| `Ja`, `Zh`, `Ko` | `other` |

For example, a Czech translator needs **three** translated variants in this order, whereas a Japanese translator needs **one**. Hindi places `0` and `1` in the `one` category; French does so too, but its million category introduces a third form.

### Regional formatters (27 locales)

| Locale | Resource | Default currency |
| --- | --- | --- |
| `en-US` | `en-us.php` | USD |
| `en-GB` | `en-gb.php` | GBP |
| `pl-PL` | `pl-pl.php` | PLN |
| `de-DE` | `de-de.php` | EUR |
| `fr-FR` | `fr-fr.php` | EUR |
| `es-ES` | `es-es.php` | EUR |
| `it-IT` | `it-it.php` | EUR |
| `pt-PT` | `pt-pt.php` | EUR |
| `pt-BR` | `pt-br.php` | BRL |
| `nl-NL` | `nl-nl.php` | EUR |
| `cs-CZ` | `cs-cz.php` | CZK |
| `sk-SK` | `sk-sk.php` | EUR |
| `uk-UA` | `uk-ua.php` | UAH |
| `ru-RU` | `ru-ru.php` | RUB |
| `sv-SE` | `sv-se.php` | SEK |
| `da-DK` | `da-dk.php` | DKK |
| `nb-NO` | `nb-no.php` | NOK |
| `fi-FI` | `fi-fi.php` | EUR |
| `ro-RO` | `ro-ro.php` | RON |
| `hu-HU` | `hu-hu.php` | HUF |
| `el-GR` | `el-gr.php` | EUR |
| `tr-TR` | `tr-tr.php` | TRY |
| `ja-JP` | `ja-jp.php` | JPY |
| `zh-CN` | `zh-cn.php` | CNY |
| `ko-KR` | `ko-kr.php` | KRW |
| `ar-SA` | `ar-sa.php` | SAR |
| `hi-IN` | `hi-in.php` | INR |

Each language also has a short alias such as `fr.php` or `ja.php` pointing to its default regional file. The built-in aliases choose one **default region**, not a universal configuration for all countries using that language. `LocaleFormatterEn` and `LocaleFormatterPl` remain shortcuts for `en-US` and `pl-PL`; the factory handles every region.

## Choose only the languages your application needs

There are **two distinct choices**:

- **Only selected languages on disk:** use [selective installation](#install-only-selected-languages-without-the-full-package) to download and maintain just the PHP classes and locale files that your project needs. No `wilycode/translation-languages` Composer installation is required.
- **The full package installed, but only selected languages enabled:** install with Composer and configure the supported locales in the application. Composer downloads all 25 language definitions, but the example below instantiates only the selected ones.

The following example assumes the **full package is installed with Composer**:

```php
<?php

use WilyCode\Translation\Language\En;
use WilyCode\Translation\Language\Pl;
use WilyCode\Translation\LanguageInterface;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$supported = [
    'en-US' => new En(),
    'pl-PL' => new Pl(),
];

$requestedLocale = 'pl-PL'; // For example, from a user profile.
$locale = array_key_exists($requestedLocale, $supported) ? $requestedLocale : 'en-US';

/** @var LanguageInterface $language */
$language = $supported[$locale];

$factory = new LocaleFormatterFactory(
    __DIR__ . '/vendor/wilycode/translation-languages/src/resources/locales',
    'en-US',
);

$formatter = $factory->forCode($locale);
```

With **selective installation**, use your own `App\Translation\...` classes and `resources/locales` directory instead, as shown earlier. Your application is responsible for deciding which locales to support; neither approach enables additional languages automatically.

## Customize locale resources

**Do not edit `vendor/`.** This section is for applications that installed the **full package with Composer** but want to customize date patterns, currency defaults or separators. Copy only the desired locale *resource files* into an application-owned directory. With [selective installation](#install-only-selected-languages-without-the-full-package), the resources are already in your application and can be edited directly.

For example, on macOS/Linux, from your application's root:

```bash
mkdir -p resources/locales
cp vendor/wilycode/translation-languages/src/resources/locales/en-us.php resources/locales/
cp vendor/wilycode/translation-languages/src/resources/locales/pl-pl.php resources/locales/
```

Edit `resources/locales/pl-pl.php` in your application, then point the factory to your files:

```php
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$factory = new LocaleFormatterFactory(
    __DIR__ . '/resources/locales',
    'en-US',
);

$formatter = $factory->forCode('pl-PL');
```

You only need to copy the locales you intend to support **and the default fallback resource** (here `en-us.php`). The factory reads from **one directory**; it does not merge application resources with `vendor/` automatically. If you use aliases such as `pl`, copy `pl.php` too, or request the full region code (`pl-PL`). Aliases load sibling regional files, so copying an alias alone is not sufficient.

Configuration is stored in regular PHP files returning arrays; this also makes it possible to define additional resources directly in the application. These files are executable PHP, so use **trusted, version-controlled configuration**, never user-uploaded PHP.

## Add a new language

You can add languages **without editing `vendor/` or changing this package**. The built-in set already includes Spanish, French, Italian, etc.; the example below deliberately uses **Indonesian (`id-ID`)**, which is *not* bundled. Fully editable examples are provided in [`examples/Language/Id.php`](examples/Language/Id.php) and [`examples/resources/locales/id-id.php`](examples/resources/locales/id-id.php) in the GitHub source repository.

### 1. Implement a language rule

Create `app/Language/Id.php` with the `App\` PSR-4 namespace configured by your application:

```php
<?php

declare(strict_types=1);

namespace App\Language;

use WilyCode\Translation\LanguageInterface;

final class Id implements LanguageInterface
{
    public function getCode(): string
    {
        return 'id';
    }

    public function getNumberOfPluralForms(): int
    {
        return 1;
    }

    public function getPluralForm(int $count): int
    {
        return 0;
    }
}
```

Indonesian has one cardinal plural category, so every integer maps to index `0`. For languages with multiple plural categories, implement and test the appropriate CLDR rules rather than copying the Indonesian example.

### 2. Create the regional resource

Create `resources/locales/id-id.php` in **your application**:

```php
<?php

declare(strict_types=1);

return [
    'locale' => 'id-ID',
    'date' => [
        'formats' => [
            'short' => 'd/m/Y',
            'medium' => 'd/m/Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ],
    ],
    'time' => ['formats' => ['short' => 'H:i', 'medium' => 'H:i:s', 'long' => 'H:i:s']],
    'number' => [
        'decimal_separator' => ',',
        'thousands_separator' => '.',
        'currency' => 'IDR',
        'fraction_digits' => 0,
    ],
];
```

The example includes month names so a long date does not unexpectedly fall back to English. The built-in factory reads **one directory** at a time: if you require both custom `id-ID` and built-in `en-US` as a fallback, copy `en-us.php` into the same application directory.

### 3. Enable the language in your application

```php
use App\Language\Id;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

$language = new Id();
$factory = new LocaleFormatterFactory(__DIR__ . '/resources/locales', 'id-ID');
$formatter = $factory->forCode('id-ID');

$language->getPluralForm(2);     // 0
$formatter->formatMoney(1234.5); // IDR 1.235
```

Make sure your application's `App\` namespace is registered with Composer and run `composer dump-autoload` when changing PSR-4 mappings.

## Pluralization

`LanguageInterface` returns an integer index that identifies a plural form. It is up to a translator implementation to map that index to messages.

| Count | `En` | `Pl` | `De` |
| ---: | ---: | ---: | ---: |
| 0 | 1 | 2 | 1 |
| 1 | 0 | 0 | 0 |
| 2 | 1 | 1 | 1 |
| 4 | 1 | 1 | 1 |
| 5 | 1 | 2 | 1 |
| 12 | 1 | 2 | 1 |
| 22 | 1 | 1 | 1 |

The `Pl` rule correctly handles the exceptions around values such as `12–14`. These indexes should never be treated as translated output.

The suite covers all 25 language rules and the separate `PtBr` variant against representative CLDR cardinal integer cases, including `0`, `1`, `2`, `5`, `11`, `21`, `100` and `1,000,000`. For example:

```php
use WilyCode\Translation\Language\Ar;
use WilyCode\Translation\Language\Ja;
use WilyCode\Translation\Language\Pt;
use WilyCode\Translation\Language\PtBr;

(new Ar())->getPluralForm(0);     // 0 — zero
(new Ar())->getPluralForm(2);     // 2 — two
(new Ar())->getPluralForm(11);    // 4 — many
(new Ja())->getPluralForm(21);    // 0 — other (the sole form)
(new Pt())->getPluralForm(0);     // 2 — other (Portugal)
(new PtBr())->getPluralForm(0);   // 0 — one (Brazil)
```

**Plural category positions are a contract between the chosen language rule and your translator's message forms.** Switching the language rule may require a different number and order of translated forms.


## Date, number and currency formatting

```php
use DateTimeImmutable;
use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterEn;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterPl;

$date = new DateTimeImmutable('2026-07-08 12:34:56');

echo (new LocaleFormatterEn())->formatDate($date); // 07/08/2026
echo (new LocaleFormatterPl())->formatDate($date); // 08.07.2026
echo (new LocaleFormatterPl())->formatDate($date, DateStyle::Long); // 8 lipca 2026 r.
```

| Method | Behavior |
| --- | --- |
| `getLocale()` | Return locale code from the configuration. |
| `getDateFormat(DateStyle $style = DateStyle::Medium)` | Return PHP date pattern. |
| `formatDate(DateTimeInterface $date, DateStyle $style = DateStyle::Medium)` | Render a date. |
| `formatDateTime(DateTimeInterface $dateTime, DateStyle $style = DateStyle::Medium)` | Render date and time. |
| `formatNumber(float\|int $number, int $fractionDigits = 2)` | Render number using configured separators. |
| `formatMoney(float\|int $amount, ?string $currency = null, ?int $fractionDigits = null)` | Format number and prepend currency code. |

The short date format is locale-configurable: `en-US` and `pl-PL` ship with ISO `Y-m-d`, whereas `de-DE` ships with `d.m.Y`. Localized month names are supplied for long-date formats that use `F` (including genitive month forms for Polish, Czech, Slovak, Ukrainian, Russian, Finnish and Greek). Use `date.long_month_case = "nom"` where nominative month mappings are provided. Japanese, Chinese and Korean long-date patterns use numeric months and local date characters instead of English month names.

The `hi-IN` resource supports Indian digit grouping (e.g. `12,34,567.89`). Formatting otherwise uses PHP numbers and separators: `ar-SA` does not automatically change Western digits to Arabic-Indic digits. `JPY` and `KRW` default to zero currency fraction digits; `formatNumber()` still defaults to two decimals unless overridden.

**Currency formatting is intentionally simple:** the result is `CODE formatted-number` (for example `PLN 1 234,50`), not automatic locale-aware currency symbols or exchange-rate conversion. For full CLDR/ICU behavior, use a specialized `intl`-based implementation instead.

## API reference

| Class | Public entry point | Notes |
| --- | --- | --- |
| `Language\En` | `new En()` | Implements `LanguageInterface`; two plural forms. |
| `Language\Pl` | `new Pl()` | Implements `LanguageInterface`; three plural forms. |
| `Language\De` | `new De()` | Implements `LanguageInterface`; two plural forms. |
| `Language\Fr`, `Language\Es`, `Language\Ar`, etc. | `new Fr()`, `new Es()`, `new Ar()` | 25 language classes in total; all implement `LanguageInterface` and expose the same three methods. |
| `Language\PtBr` | `new PtBr()` | Regional Portuguese pluralization for Brazil (still returns `getCode() === "pt"`). |
| `LocaleFormatter\LocaleFormatter` | `new LocaleFormatter(array $config)` | Implements `LocaleFormatterInterface` with configuration-based formats. |
| `LocaleFormatter\LocaleFormatterFactory` | `new LocaleFormatterFactory(string $resourcesDir, string $defaultCode = 'en-US')` | Loads a locale resource directory. |
| `LocaleFormatter\LocaleFormatterFactory` | `forCode(?string $code): LocaleFormatter` | Returns a formatter, applying fallback rules. |
| `LocaleFormatter\LocaleFormatterEn` | `new LocaleFormatterEn()` | US English defaults. |
| `LocaleFormatter\LocaleFormatterPl` | `new LocaleFormatterPl()` | Polish defaults. |

`LocaleFormatterFactory::forCode()` normalizes case and underscores (`EN_gb` → `en-gb`), tries the exact resource name, then its base-language alias (e.g. `pl`), and finally the configured default code. Invalid locale identifiers (including path traversal characters) are treated as missing and fall back to the configured default. It throws `RuntimeException` if the resource directory is missing or no resource can be found. A PHP resource file must return the expected configuration array.

For formatting method signatures see the table in [Date, number and currency formatting](#date-number-and-currency-formatting). The base interfaces are defined in [`wilycode/translation`](https://github.com/wilycode/translation).

## Integrations

| Package | Purpose |
| --- | --- |
| [`wilycode/translation`](https://github.com/wilycode/translation) | Shared translator, language and locale formatter contracts (required). |
| [`wilycode/translation-array`](https://github.com/wilycode/translation-array) | Planned array-backed message translator. |
| [`wilycode/translation-database`](https://github.com/wilycode/translation-database) | Planned database-backed message translator. |

Translations, language choice, and routing are intentionally separate responsibilities. The packages above can be installed independently according to your application's architecture.

## Limitations and security

- The factory does **not** search multiple locale directories or merge configurations across them.
- Base-language aliases (`en.php`, `pl.php`, `de.php`, `fr.php`, etc.) require their regional sibling files if copied into a custom directory.
- The bundled regions are defaults, not complete CLDR/ICU implementations; unlisted regional variants need their own resources. In particular, script variants and numbering systems are not inferred automatically.
- Month names are localized via explicit long-date maps where provided; arbitrary date patterns outside the `DateStyle::Long` path and raw PHP `F`/`M` formatting may still use English.
- Locale files are trusted executable PHP. Do not load paths derived from untrusted input or accept user-uploaded locale files.
- This package does not escape HTML, perform message lookup, validate a locale against an application's supported list, convert currencies, shape native-script digits, or handle CLDR fractional cardinal categories.

## Development and license

```bash
composer validate --strict
composer install
composer test
```

GitHub Actions runs the PHPUnit suite on PHP 8.4. See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidelines and [CHANGELOG.md](CHANGELOG.md) for release history.

Licensed under the [MIT License](LICENSE). Copyright © 2026 Simon Piter.
