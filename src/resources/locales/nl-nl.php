<?php

declare(strict_types=1);

return [
    'locale' => 'nl-NL',
    'date' => [
        'formats' => [
            'short' => 'd-m-Y',
            'medium' => 'd-m-Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'januari',
            2 => 'februari',
            3 => 'maart',
            4 => 'april',
            5 => 'mei',
            6 => 'juni',
            7 => 'juli',
            8 => 'augustus',
            9 => 'september',
            10 => 'oktober',
            11 => 'november',
            12 => 'december',
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
