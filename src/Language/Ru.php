<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Ru implements LanguageInterface
{
    public function getCode(): string
    {
        return 'ru';
    }

    public function getNumberOfPluralForms(): int
    {
        return 3;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        if ($count % 10 === 1 && $count % 100 !== 11) { return 0; }
                if ($count % 10 >= 2 && $count % 10 <= 4 && !($count % 100 >= 12 && $count % 100 <= 14)) { return 1; }
                return 2;
    }
}
