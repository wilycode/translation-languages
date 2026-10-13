<?php

declare(strict_types=1);

namespace App\Language;

use WilyCode\Translation\LanguageInterface;

/** Indonesian has a single plural category for integer counts. */
final class Id implements LanguageInterface
{
    public function getCode(): string
    {
        return 'id';
    }

    public function getNumberOfPluralForms(): int
    {
        return 1;
    }

    public function getPluralForm(int $count): int
    {
        return 0;
    }
}
