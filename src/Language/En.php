<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class En implements LanguageInterface
{
    public function getCode(): string
    {
        return 'en';
    }

    public function getNumberOfPluralForms(): int
    {
        return 2;
    }

    public function getPluralForm(int $count): int
    {
        // English:
        // 1 → singular (0)
        // everything else → plural (1)
        return $count === 1 ? 0 : 1;
    }
}
