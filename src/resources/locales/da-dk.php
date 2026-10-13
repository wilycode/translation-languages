<?php

declare(strict_types=1);

return [
    'locale' => 'da-DK',
    'date' => [
        'formats' => [
            'short' => 'd.m.Y',
            'medium' => 'd.m.Y',
            'long' => 'j. F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'januar',
            2 => 'februar',
            3 => 'marts',
            4 => 'april',
            5 => 'maj',
            6 => 'juni',
            7 => 'juli',
            8 => 'august',
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
        'currency' => 'DKK',
        'fraction_digits' => 2,
    ],
];
