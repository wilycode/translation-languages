<?php

declare(strict_types=1);

return [
    'locale' => 'sv-SE',
    'date' => [
        'formats' => [
            'short' => 'Y-m-d',
            'medium' => 'Y-m-d',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'januari',
            2 => 'februari',
            3 => 'mars',
            4 => 'april',
            5 => 'maj',
            6 => 'juni',
            7 => 'juli',
            8 => 'augusti',
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
        'thousands_separator' => ' ',
        'currency' => 'SEK',
        'fraction_digits' => 2,
    ],
];
