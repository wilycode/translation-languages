<?php

declare(strict_types=1);

return [
    'locale' => 'sk-SK',
    'date' => [
        'formats' => [
            'short' => 'd.m.Y',
            'medium' => 'j. n. Y',
            'long' => 'j. F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'januára',
            2 => 'februára',
            3 => 'marca',
            4 => 'apríla',
            5 => 'mája',
            6 => 'júna',
            7 => 'júla',
            8 => 'augusta',
            9 => 'septembra',
            10 => 'októbra',
            11 => 'novembra',
            12 => 'decembra',
        ],
        'months_nominative' => [
            1 => 'január',
            2 => 'február',
            3 => 'marec',
            4 => 'apríl',
            5 => 'máj',
            6 => 'jún',
            7 => 'júl',
            8 => 'august',
            9 => 'september',
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
        'currency' => 'EUR',
        'fraction_digits' => 2,
    ],
];
