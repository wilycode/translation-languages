<?php

declare(strict_types=1);

return [
    'locale' => 'cs-CZ',
    'date' => [
        'formats' => [
            'short' => 'd.m.Y',
            'medium' => 'j. n. Y',
            'long' => 'j. F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'ledna',
            2 => 'února',
            3 => 'března',
            4 => 'dubna',
            5 => 'května',
            6 => 'června',
            7 => 'července',
            8 => 'srpna',
            9 => 'září',
            10 => 'října',
            11 => 'listopadu',
            12 => 'prosince',
        ],
        'months_nominative' => [
            1 => 'leden',
            2 => 'únor',
            3 => 'březen',
            4 => 'duben',
            5 => 'květen',
            6 => 'červen',
            7 => 'červenec',
            8 => 'srpen',
            9 => 'září',
            10 => 'říjen',
            11 => 'listopad',
            12 => 'prosinec',
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
        'currency' => 'CZK',
        'fraction_digits' => 2,
    ],
];
