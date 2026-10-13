<?php

declare(strict_types=1);

return [
    'locale' => 'fi-FI',
    'date' => [
        'formats' => [
            'short' => 'd.m.Y',
            'medium' => 'j.n.Y',
            'long' => 'j. F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'tammikuuta',
            2 => 'helmikuuta',
            3 => 'maaliskuuta',
            4 => 'huhtikuuta',
            5 => 'toukokuuta',
            6 => 'kesäkuuta',
            7 => 'heinäkuuta',
            8 => 'elokuuta',
            9 => 'syyskuuta',
            10 => 'lokakuuta',
            11 => 'marraskuuta',
            12 => 'joulukuuta',
        ],
        'months_nominative' => [
            1 => 'tammikuu',
            2 => 'helmikuu',
            3 => 'maaliskuu',
            4 => 'huhtikuu',
            5 => 'toukokuu',
            6 => 'kesäkuu',
            7 => 'heinäkuu',
            8 => 'elokuu',
            9 => 'syyskuu',
            10 => 'lokakuu',
            11 => 'marraskuu',
            12 => 'joulukuu',
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
