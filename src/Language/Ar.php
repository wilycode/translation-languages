<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Ar implements LanguageInterface
{
    public function getCode(): string
    {
        return 'ar';
    }

    public function getNumberOfPluralForms(): int
    {
        return 6;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        if ($count === 0) { return 0; }
                if ($count === 1) { return 1; }
                if ($count === 2) { return 2; }
                $lastTwoDigits = $count % 100;
                if ($lastTwoDigits >= 3 && $lastTwoDigits <= 10) { return 3; }
                if ($lastTwoDigits >= 11 && $lastTwoDigits <= 99) { return 4; }
                return 5;
    }
}
