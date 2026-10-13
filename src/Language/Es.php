<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class Es implements LanguageInterface
{
    public function getCode(): string
    {
        return 'es';
    }

    public function getNumberOfPluralForms(): int
    {
        return 3;
    }

    /** CLDR cardinal plural categories for non-negative integer counts. */
    public function getPluralForm(int $count): int
    {
        if ($count === 1) { return 0; }
                if ($count > 0 && $count % 1000000 === 0) { return 1; }
                return 2;
    }
}
