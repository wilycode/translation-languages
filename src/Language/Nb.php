<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Nb implements LanguageInterface
{
    public function getCode(): string
    {
        return 'nb';
    }

    public function getNumberOfPluralForms(): int
    {
        return 2;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        return $count === 1 ? 0 : 1;
    }
}
