<?php

declare(strict_types=1);

return [
    'locale' => 'hu-HU',
    'date' => [
        'formats' => [
            'short' => 'Y.m.d.',
            'medium' => 'Y. m. d.',
            'long' => 'Y. F j.',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'január',
            2 => 'február',
            3 => 'március',
            4 => 'április',
            5 => 'május',
            6 => 'június',
            7 => 'július',
            8 => 'augusztus',
            9 => 'szeptember',
            10 => 'október',
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
        'currency' => 'HUF',
        'fraction_digits' => 2,
    ],
];
