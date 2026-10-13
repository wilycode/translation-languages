<?php

declare(strict_types=1);

return [
    'locale' => 'ko-KR',
    'date' => [
        'formats' => [
            'short' => 'Y.m.d.',
            'medium' => 'Y. m. d.',
            'long' => 'Y년 n월 j일',
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
        'currency' => 'KRW',
        'fraction_digits' => 0,
    ],
];
