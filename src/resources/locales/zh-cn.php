<?php

declare(strict_types=1);

return [
    'locale' => 'zh-CN',
    'date' => [
        'formats' => [
            'short' => 'Y/m/d',
            'medium' => 'Y-m-d',
            'long' => 'Y年n月j日',
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
        'currency' => 'CNY',
        'fraction_digits' => 2,
    ],
];
