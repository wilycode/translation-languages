<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Pl implements LanguageInterface
{
    public function getCode(): string
    {
        return 'pl';
    }

    public function getNumberOfPluralForms(): int
    {
        return 3;
    }

    public function getPluralForm(int $count): int
    {
        // Polish plural forms:
        // 0: 1
        // 1: 2-4, 22-24, 32-34, ... (but not 12-14)
        // 2: the rest
        if ($count === 1) {
            return 0;
        }

        $mod10  = $count % 10;
        $mod100 = $count % 100;

        if ($mod10 >= 2 && $mod10 <= 4 && !($mod100 >= 12 && $mod100 <= 14)) {
            return 1;
        }

        return 2;
    }
}
