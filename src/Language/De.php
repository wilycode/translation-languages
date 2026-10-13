<?php

declare(strict_types=1);

namespace WilyCode\Translation\Language;

use WilyCode\Translation\LanguageInterface;

final class De implements LanguageInterface
{
    public function getCode(): string
    {
        return 'de';
    }

    public function getNumberOfPluralForms(): int
    {
        return 2;
    }

    public function getPluralForm(int $count): int
    {
        return $count === 1 ? 0 : 1;
    }
}
