<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/** Integer cardinal plural cases verified against CLDR data (Babel 2.18). */
final class AllLanguagePluralRulesTest extends TestCase
{
    private const COUNTS = [0, 1, 2, 3, 4, 5, 10, 11, 12, 14, 19, 20, 21, 22, 23, 24, 25, 99, 100, 101, 102, 103, 104, 105, 110, 111, 112, 114, 119, 120, 121, 122, 200, 201, 1000000, 2000000, 100000000];

    /** @return iterable<string, array{class-string, string, int, list<int>}> */
    public static function languageCases(): iterable
    {
        yield 'En' => [\WilyCode\Translation\Language\En::class, 'en', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Pl' => [\WilyCode\Translation\Language\Pl::class, 'pl', 3, [2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 2, 2, 2, 2, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2]];
        yield 'De' => [\WilyCode\Translation\Language\De::class, 'de', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Fr' => [\WilyCode\Translation\Language\Fr::class, 'fr', 3, [0, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1]];
        yield 'Es' => [\WilyCode\Translation\Language\Es::class, 'es', 3, [2, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1]];
        yield 'It' => [\WilyCode\Translation\Language\It::class, 'it', 3, [2, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1]];
        yield 'Pt' => [\WilyCode\Translation\Language\Pt::class, 'pt', 3, [2, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1]];
        yield 'PtBr' => [\WilyCode\Translation\Language\PtBr::class, 'pt', 3, [0, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1]];
        yield 'Nl' => [\WilyCode\Translation\Language\Nl::class, 'nl', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Cs' => [\WilyCode\Translation\Language\Cs::class, 'cs', 3, [2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2]];
        yield 'Sk' => [\WilyCode\Translation\Language\Sk::class, 'sk', 3, [2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2]];
        yield 'Uk' => [\WilyCode\Translation\Language\Uk::class, 'uk', 3, [2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 0, 1, 1, 1, 2, 2, 2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 0, 1, 2, 0, 2, 2, 2]];
        yield 'Ru' => [\WilyCode\Translation\Language\Ru::class, 'ru', 3, [2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 0, 1, 1, 1, 2, 2, 2, 0, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 0, 1, 2, 0, 2, 2, 2]];
        yield 'Sv' => [\WilyCode\Translation\Language\Sv::class, 'sv', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Da' => [\WilyCode\Translation\Language\Da::class, 'da', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Nb' => [\WilyCode\Translation\Language\Nb::class, 'nb', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Fi' => [\WilyCode\Translation\Language\Fi::class, 'fi', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Ro' => [\WilyCode\Translation\Language\Ro::class, 'ro', 3, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 1, 2, 2, 2]];
        yield 'Hu' => [\WilyCode\Translation\Language\Hu::class, 'hu', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'El' => [\WilyCode\Translation\Language\El::class, 'el', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Tr' => [\WilyCode\Translation\Language\Tr::class, 'tr', 2, [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
        yield 'Ja' => [\WilyCode\Translation\Language\Ja::class, 'ja', 1, [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        yield 'Zh' => [\WilyCode\Translation\Language\Zh::class, 'zh', 1, [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        yield 'Ko' => [\WilyCode\Translation\Language\Ko::class, 'ko', 1, [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        yield 'Ar' => [\WilyCode\Translation\Language\Ar::class, 'ar', 6, [0, 1, 2, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 5, 5, 5, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5]];
        yield 'Hi' => [\WilyCode\Translation\Language\Hi::class, 'hi', 2, [0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]];
    }

    #[DataProvider('languageCases')]
    public function test_cldr_integer_plural_categories(string $class, string $code, int $formCount, array $expected): void
    {
        $language = new $class();
        self::assertSame($code, $language->getCode());
        self::assertSame($formCount, $language->getNumberOfPluralForms());

        foreach (self::COUNTS as $i => $count) {
            self::assertSame($expected[$i], $language->getPluralForm($count), $class . " ($count)");
        }
    }
}
