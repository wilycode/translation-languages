<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Ro implements LanguageInterface
{
    public function getCode(): string
    {
        return 'ro';
    }

    public function getNumberOfPluralForms(): int
    {
        return 3;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        if ($count === 1) { return 0; }
                if ($count === 0 || ($count % 100 >= 1 && $count % 100 <= 19)) { return 1; }
                return 2;
    }
}
