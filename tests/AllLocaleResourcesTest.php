<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use WilyCode\Translation\DateStyle;
use WilyCode\Translation\LocaleFormatter\LocaleFormatterFactory;

final class AllLocaleResourcesTest extends TestCase
{
    /** @return iterable<string, array{string, string, ?string}> */
    public static function locales(): iterable
    {
        yield 'en-US' => ['en-US', 'USD', "March"];
        yield 'en-GB' => ['en-GB', 'GBP', "March"];
        yield 'pl-PL' => ['pl-PL', 'PLN', "marca"];
        yield 'de-DE' => ['de-DE', 'EUR', "März"];
        yield 'fr-FR' => ['fr-FR', 'EUR', "mars"];
        yield 'es-ES' => ['es-ES', 'EUR', "marzo"];
        yield 'it-IT' => ['it-IT', 'EUR', "marzo"];
        yield 'pt-PT' => ['pt-PT', 'EUR', "março"];
        yield 'pt-BR' => ['pt-BR', 'BRL', "março"];
        yield 'nl-NL' => ['nl-NL', 'EUR', "maart"];
        yield 'cs-CZ' => ['cs-CZ', 'CZK', "března"];
        yield 'sk-SK' => ['sk-SK', 'EUR', "marca"];
        yield 'uk-UA' => ['uk-UA', 'UAH', "березня"];
        yield 'ru-RU' => ['ru-RU', 'RUB', "марта"];
        yield 'sv-SE' => ['sv-SE', 'SEK', "mars"];
        yield 'da-DK' => ['da-DK', 'DKK', "marts"];
        yield 'nb-NO' => ['nb-NO', 'NOK', "mars"];
        yield 'fi-FI' => ['fi-FI', 'EUR', "maaliskuuta"];
        yield 'ro-RO' => ['ro-RO', 'RON', "martie"];
        yield 'hu-HU' => ['hu-HU', 'HUF', "március"];
        yield 'el-GR' => ['el-GR', 'EUR', "Μαρτίου"];
        yield 'tr-TR' => ['tr-TR', 'TRY', "Mart"];
        yield 'ja-JP' => ['ja-JP', 'JPY', null];
        yield 'zh-CN' => ['zh-CN', 'CNY', null];
        yield 'ko-KR' => ['ko-KR', 'KRW', null];
        yield 'ar-SA' => ['ar-SA', 'SAR', "مارس"];
        yield 'hi-IN' => ['hi-IN', 'INR', "मार्च"];
    }

    #[DataProvider('locales')]
    public function test_locale_resource(string $locale, string $currency, ?string $marchName): void
    {
        $factory = new LocaleFormatterFactory(__DIR__ . '/../src/resources/locales');
        $formatter = $factory->forCode($locale);
        self::assertSame($locale, $formatter->getLocale());
        self::assertStringStartsWith($currency . " ", $formatter->formatMoney(1234.5));
        $longDate = $formatter->formatDate(new DateTimeImmutable("2026-03-08"), DateStyle::Long);
        if ($marchName !== null) {
            self::assertStringContainsString($marchName, $longDate, $locale);
        } else {
            self::assertStringContainsString("2026", $longDate, $locale);
        }
    }

    public function test_italian_custom_month_does_not_fall_back_to_english(): void
    {
        $factory = new LocaleFormatterFactory(__DIR__ . '/../src/resources/locales');
        $date = $factory->forCode("it-IT")->formatDate(new DateTimeImmutable("2026-03-08"), DateStyle::Long);
        self::assertSame("8 marzo 2026", $date);
    }

    public function test_indian_grouping_and_negative_numbers(): void
    {
        $formatter = (new LocaleFormatterFactory(__DIR__ . '/../src/resources/locales'))->forCode('hi-IN');
        self::assertSame("12,34,567.89", $formatter->formatNumber(1234567.89));
        self::assertSame("-12,34,567.89", $formatter->formatNumber(-1234567.89));
        self::assertSame("1,234.50", (new LocaleFormatterFactory(__DIR__ . "/../src/resources/locales"))->forCode("en-US")->formatNumber(1234.5));
    }

    public function test_japanese_zero_fraction_currency(): void
    {
        $formatter = (new LocaleFormatterFactory(__DIR__ . '/../src/resources/locales'))->forCode('ja-JP');
        self::assertSame("JPY 1,235", $formatter->formatMoney(1234.5));
    }
}
