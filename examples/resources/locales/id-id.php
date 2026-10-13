<?php

declare(strict_types=1);

return [
    'locale' => 'id-ID',
    'date' => [
        'formats' => ['short' => 'd/m/Y', 'medium' => 'd/m/Y', 'long' => 'j F Y'],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ],
    ],
    'time' => ['formats' => ['short' => 'H:i', 'medium' => 'H:i:s', 'long' => 'H:i:s']],
    'number' => [
        'decimal_separator' => ',',
        'thousands_separator' => '.',
        'currency' => 'IDR',
        'fraction_digits' => 0,
    ],
];
