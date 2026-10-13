<?php

declare(strict_types=1);

return [
    'locale' => 'ar-SA',
    'date' => [
        'formats' => [
            'short' => 'd/m/Y',
            'medium' => 'd/m/Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
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
        'decimal_separator' => '.',
        'thousands_separator' => ',',
        'currency' => 'SAR',
        'fraction_digits' => 2,
    ],
];
