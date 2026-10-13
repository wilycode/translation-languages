<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use WilyCode\Translation\LocaleFormatter\LocaleFormatter;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

#[CoversClass(LocaleFormatterFactory::class)]
#[CoversClass(LocaleFormatter::class)]
final class LocaleFormatterFactoryTest extends TestCase
{
    private function createFactory(string $defaultCode = 'en-US'): LocaleFormatterFactory
    {
        return new LocaleFormatterFactory(
            __DIR__ . '/../src/resources/locales',
            $defaultCode
        );
    }

    public function test_for_code_returns_en_formatter(): void
    {
        $factory   = $this->createFactory();
        $formatter = $factory->forCode('en-US');

        self::assertInstanceOf(LocaleFormatter::class, $formatter);
        self::assertSame('en-US', $formatter->getLocale());
        self::assertSame('USD 1,234.50', $formatter->formatMoney(1234.5));
        self::assertSame('1,234.50', $formatter->formatNumber(1234.5));
    }

    public function test_for_code_returns_en_gb_formatter_with_day_first_date(): void
    {
        $factory   = $this->createFactory();
        $formatter = $factory->forCode('en-GB');
        $date      = new DateTimeImmutable('2026-07-08 00:00:00');

        self::assertSame('en-GB', $formatter->getLocale());
        self::assertSame('08/07/2026', $formatter->formatDate($date));
        self::assertSame('GBP 1,234.50', $formatter->formatMoney(1234.5));
    }

    public function test_for_code_returns_pl_formatter_case_insensitive(): void
    {
        $factory   = $this->createFactory();
        $formatter = $factory->forCode('pl-PL');

        self::assertInstanceOf(LocaleFormatter::class, $formatter);
        self::assertSame('pl-PL', $formatter->getLocale());
        self::assertSame('PLN 1 234,50', $formatter->formatMoney(1234.5));
        self::assertSame('1 234,50', $formatter->formatNumber(1234.5));
    }

    public function test_unknown_code_falls_back_to_default(): void
    {
        $factory   = $this->createFactory('en-US');
        $formatter = $factory->forCode('xx');

        self::assertSame('USD 1,234.50', $formatter->formatMoney(1234.5));
        self::assertSame('1,234.50', $formatter->formatNumber(1234.5));
    }

    public function test_empty_code_falls_back_to_default(): void
    {
        $factory   = $this->createFactory('en-US');
        $formatter = $factory->forCode('');

        self::assertSame('USD 1,234.50', $formatter->formatMoney(1234.5));
    }

    public function test_german_long_date_uses_localized_month_names(): void
    {
        $formatter = $this->createFactory()->forCode('de-DE');
        $date = new DateTimeImmutable('2026-03-08 12:34:56');

        self::assertSame('de-DE', $formatter->getLocale());
        self::assertSame('8. März 2026', $formatter->formatDate($date, \WilyCode\Translation\DateStyle::Long));
        self::assertSame('EUR 1.234,50', $formatter->formatMoney(1234.5));
    }

    public function test_locale_codes_normalize_case_and_underscores(): void
    {
        $formatter = $this->createFactory()->forCode(' EN_gb ');
        self::assertSame('en-GB', $formatter->getLocale());
    }

    public function test_invalid_locale_code_cannot_traverse_resources_directory(): void
    {
        $formatter = $this->createFactory()->forCode('../sensitive/file');
        self::assertSame('en-US', $formatter->getLocale());
    }

    public function test_base_language_alias_resolves_to_default_region(): void
    {
        self::assertSame('pl-PL', $this->createFactory()->forCode('pl')->getLocale());
    }

    public function test_custom_application_locale_directory_can_be_used(): void
    {
        $dir = sys_get_temp_dir() . '/wilycode_locale_' . bin2hex(random_bytes(8));
        self::assertTrue(mkdir($dir));

        try {
            $config = <<<'PHP'
<?php
return [
    'locale' => 'es-ES',
    'date' => ['formats' => ['short' => 'Y-m-d', 'medium' => 'd/m/Y', 'long' => 'd/m/Y']],
    'time' => ['formats' => ['short' => 'H:i', 'medium' => 'H:i:s', 'long' => 'H:i:s']],
    'number' => [
        'decimal_separator' => ',',
        'thousands_separator' => '.',
        'currency' => 'EUR',
        'fraction_digits' => 2,
    ],
];
PHP;
            self::assertNotFalse(file_put_contents($dir . '/es-es.php', $config));
            $factory = new LocaleFormatterFactory($dir, 'es-ES');
            self::assertSame('es-ES', $factory->forCode('es-ES')->getLocale());
            self::assertSame('EUR 1.234,50', $factory->forCode('es-ES')->formatMoney(1234.5));
            self::assertSame('08/07/2026', $factory->forCode('es-ES')->formatDate(new DateTimeImmutable('2026-07-08')));
        } finally {
            @unlink($dir . '/es-es.php');
            @rmdir($dir);
        }
    }

    public function test_constructor_throws_when_resources_dir_missing(): void
    {
        $this->expectException(\RuntimeException::class);

        new LocaleFormatterFactory(__DIR__ . '/missing-dir');
    }
}
