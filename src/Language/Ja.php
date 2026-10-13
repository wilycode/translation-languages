<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Ja implements LanguageInterface
{
    public function getCode(): string
    {
        return 'ja';
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
