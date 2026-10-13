<?php

declare(strict_types=1);

namespace WilyCode\Translation\LocaleFormatter;

final class LocaleFormatterPl extends LocaleFormatter
{
    public function __construct()
    {
        parent::__construct(require __DIR__ . '/../resources/locales/pl-pl.php');
    }
}
