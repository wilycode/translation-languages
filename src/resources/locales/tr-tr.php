<?php

declare(strict_types=1);

return [
    'locale' => 'tr-TR',
    'date' => [
        'formats' => [
            'short' => 'd.m.Y',
            'medium' => 'd.m.Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'Ocak',
            2 => 'Şubat',
            3 => 'Mart',
            4 => 'Nisan',
            5 => 'Mayıs',
            6 => 'Haziran',
            7 => 'Temmuz',
            8 => 'Ağustos',
            9 => 'Eylül',
            10 => 'Ekim',
            11 => 'Kasım',
            12 => 'Aralık',
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
        'currency' => 'TRY',
        'fraction_digits' => 2,
    ],
];
