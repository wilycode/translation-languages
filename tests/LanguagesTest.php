<?php

declare(strict_types=1);

namespace WilyCode\Translation\Languages\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use WilyCode\Translation\Language\De;
use WilyCode\Translation\Language\En;
use WilyCode\Translation\Language\Pl;

#[CoversClass(De::class)]
#[CoversClass(En::class)]
#[CoversClass(Pl::class)]
final class LanguagesTest extends TestCase
{

    public function test_de_plural_forms(): void
    {
        $de = new De();

        self::assertSame('de', $de->getCode());
        self::assertSame(2, $de->getNumberOfPluralForms());
        self::assertSame(0, $de->getPluralForm(1));
        self::assertSame(1, $de->getPluralForm(0));
        self::assertSame(1, $de->getPluralForm(2));
    }

    public function test_en_plural_forms(): void
    {
        $en = new En();

        self::assertSame('en', $en->getCode());
        self::assertSame(2, $en->getNumberOfPluralForms());
        self::assertSame(0, $en->getPluralForm(1));
        self::assertSame(1, $en->getPluralForm(0));
        self::assertSame(1, $en->getPluralForm(2));
    }

    public function test_pl_plural_forms(): void
    {
        $pl = new Pl();

        self::assertSame('pl', $pl->getCode());
        self::assertSame(3, $pl->getNumberOfPluralForms());

        self::assertSame(0, $pl->getPluralForm(1));
        self::assertSame(1, $pl->getPluralForm(2));
        self::assertSame(1, $pl->getPluralForm(4));
        self::assertSame(2, $pl->getPluralForm(5));
        self::assertSame(2, $pl->getPluralForm(12));
        self::assertSame(2, $pl->getPluralForm(14));
        self::assertSame(1, $pl->getPluralForm(22));
        self::assertSame(2, $pl->getPluralForm(0));
        self::assertSame(1, $pl->getPluralForm(104));
        self::assertSame(2, $pl->getPluralForm(112));
    }
}
