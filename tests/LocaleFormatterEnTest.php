<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use DateTimeImmutable;
use WilyCode\Translation\DateStyle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterEn;

#[CoversClass(LocaleFormatterEn::class)]
final class LocaleFormatterEnTest extends TestCase
{
    public function test_format_money_uses_us_style_and_default_usd(): void
    {
        $formatter = new LocaleFormatterEn();

        // default: currency = USD, fractionDigits = 2
        $result = $formatter->formatMoney(1234.567);

        self::assertSame('USD 1,234.57', $result);
    }

    public function test_format_money_can_override_currency_and_fraction_digits(): void
    {
        $formatter = new LocaleFormatterEn();

        $result = $formatter->formatMoney(1234.5, 'EUR', 3);

        self::assertSame('EUR 1,234.500', $result);
    }

    public function test_format_number_uses_en_separators(): void
    {
        $formatter = new LocaleFormatterEn();

        self::assertSame('1,234.57', $formatter->formatNumber(1234.567));
        self::assertSame('1,234.6',  $formatter->formatNumber(1234.567, 1));
        self::assertSame('1,235',    $formatter->formatNumber(1234.567, 0));
    }

    public function test_format_date_uses_configured_patterns(): void
    {
        $formatter = new LocaleFormatterEn();
        $date      = new DateTimeImmutable('2026-01-29 12:34:56');

        self::assertSame('01/29/2026', $formatter->formatDate($date));
        self::assertSame('2026-01-29',   $formatter->formatDate($date, DateStyle::Short));
        self::assertSame('January 29, 2026', $formatter->formatDate($date, DateStyle::Long));
    }

    public function test_medium_date_uses_leading_zeroes(): void
    {
        $formatter = new LocaleFormatterEn();
        $date      = new DateTimeImmutable('2026-07-08 00:00:00');

        self::assertSame('07/08/2026', $formatter->formatDate($date));
    }

    public function test_format_datetime_uses_configured_patterns(): void
    {
        $formatter = new LocaleFormatterEn();
        $dateTime  = new DateTimeImmutable('2026-01-29 12:34:56');

        self::assertSame('01/29/2026 12:34:56', $formatter->formatDateTime($dateTime));
        self::assertSame('2026-01-29 12:34',      $formatter->formatDateTime($dateTime, DateStyle::Short));
        self::assertSame('January 29, 2026 12:34:56', $formatter->formatDateTime($dateTime, DateStyle::Long));
    }

}
