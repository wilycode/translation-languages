<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatter;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterPl;

#[CoversClass(LocaleFormatterPl::class)]
final class LocaleFormatterPlTest extends TestCase
{
    public function test_format_money_uses_pl_style_and_default_pln(): void
    {
        $formatter = new LocaleFormatterPl();

        // default: currency = PLN, fractionDigits = 2
        $result = $formatter->formatMoney(1234.567);

        self::assertSame('PLN 1 234,57', $result);
    }

    public function test_format_money_can_override_currency_and_fraction_digits(): void
    {
        $formatter = new LocaleFormatterPl();

        $result = $formatter->formatMoney(1234.5, 'EUR', 3);

        self::assertSame('EUR 1 234,500', $result);
    }

    public function test_format_number_uses_pl_separators(): void
    {
        $formatter = new LocaleFormatterPl();

        self::assertSame('1 234,57', $formatter->formatNumber(1234.567));
        self::assertSame('1 234,6',  $formatter->formatNumber(1234.567, 1));
        self::assertSame('1 235',    $formatter->formatNumber(1234.567, 0));
    }

    public function test_format_date_uses_configured_patterns(): void
    {
        $formatter = new LocaleFormatterPl();
        $date      = new DateTimeImmutable('2026-01-29 12:34:56');

        self::assertSame('29.01.2026', $formatter->formatDate($date));
        self::assertSame('2026-01-29', $formatter->formatDate($date, DateStyle::Short));
        self::assertSame('29 stycznia 2026 r.', $formatter->formatDate($date, DateStyle::Long));
    }

    public function test_medium_date_uses_leading_zeroes(): void
    {
        $formatter = new LocaleFormatterPl();
        $date      = new DateTimeImmutable('2026-07-08 00:00:00');

        self::assertSame('08.07.2026', $formatter->formatDate($date));
    }

    public function test_format_date_long_has_no_leading_zero_and_has_year_suffix(): void
    {
        $formatter = new LocaleFormatterPl();
        $date      = new DateTimeImmutable('2026-01-05 00:00:00');

        self::assertSame('5 stycznia 2026 r.', $formatter->formatDate($date, DateStyle::Long));
    }

    public function test_format_datetime_uses_configured_patterns(): void
    {
        $formatter = new LocaleFormatterPl();
        $dateTime  = new DateTimeImmutable('2026-01-29 12:34:56');

        self::assertSame('29.01.2026 12:34:56', $formatter->formatDateTime($dateTime));
        self::assertSame('2026-01-29 12:34',    $formatter->formatDateTime($dateTime, DateStyle::Short));
        self::assertSame('29 stycznia 2026 r. 12:34:56', $formatter->formatDateTime($dateTime, DateStyle::Long));
    }

    public function test_long_date_can_use_nominative_months_when_enabled(): void
    {
        /** @var array $cfg */
        $cfg = require __DIR__ . '/../src/resources/locales/pl-pl.php';
        $cfg['date']['long_month_case'] = 'nom';

        $formatter = new LocaleFormatter($cfg);
        $date      = new DateTimeImmutable('2026-01-29 00:00:00');

        self::assertSame('29 styczeń 2026 r.', $formatter->formatDate($date, DateStyle::Long));
    }
}
