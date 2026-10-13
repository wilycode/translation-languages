<?php

declare(strict_types=1);

return [
    'locale' => 'it-IT',
    'date' => [
        'formats' => [
            'short' => 'd/m/Y',
            'medium' => 'd/m/Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'gennaio',
            2 => 'febbraio',
            3 => 'marzo',
            4 => 'aprile',
            5 => 'maggio',
            6 => 'giugno',
            7 => 'luglio',
            8 => 'agosto',
            9 => 'settembre',
            10 => 'ottobre',
            11 => 'novembre',
            12 => 'dicembre',
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
        'thousands_separator' => '.',
        'currency' => 'EUR',
        'fraction_digits' => 2,
    ],
];
