<?php

declare(strict_types=1);

return [
    'locale' => 'fr-FR',
    'date' => [
        'formats' => [
            'short' => 'd/m/Y',
            'medium' => 'd/m/Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'janvier',
            2 => 'février',
            3 => 'mars',
            4 => 'avril',
            5 => 'mai',
            6 => 'juin',
            7 => 'juillet',
            8 => 'août',
            9 => 'septembre',
            10 => 'octobre',
            11 => 'novembre',
            12 => 'décembre',
        ],
    ],
    'time' => [
        'formats' => [
            'short' => 'H:i',
            'medium' => 'H:i:s',
            'long' => 'H:i:s',
        ],
    ],
    'number' => [
        'decimal_separator' => ',',
        'thousands_separator' => ' ',
        'currency' => 'EUR',
        'fraction_digits' => 2,
    ],
];
