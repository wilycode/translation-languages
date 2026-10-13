<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Ko implements LanguageInterface
{
    public function getCode(): string
    {
        return 'ko';
    }

    public function getNumberOfPluralForms(): int
    {
        return 1;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        return 0;
    }
}
