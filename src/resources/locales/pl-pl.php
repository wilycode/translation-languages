<?php

declare(strict_types=1);

return [
    'locale' => 'pl-PL',
    'date' => [
        'formats' => [
            'short'  => 'Y-m-d',
            'medium' => 'd.m.Y',
            'long'   => 'j F Y \r.',
        ],
        'long_month_case' => 'genitive',
        'months_nominative' => [
            1 => 'styczeń',
            2 => 'luty',
            3 => 'marzec',
            4 => 'kwiecień',
            5 => 'maj',
            6 => 'czerwiec',
            7 => 'lipiec',
            8 => 'sierpień',
            9 => 'wrzesień',
            10 => 'październik',
            11 => 'listopad',
            12 => 'grudzień',
        ],
        'months_genitive' => [
            1 => 'stycznia',
            2 => 'lutego',
            3 => 'marca',
            4 => 'kwietnia',
            5 => 'maja',
            6 => 'czerwca',
            7 => 'lipca',
            8 => 'sierpnia',
            9 => 'września',
            10 => 'października',
            11 => 'listopada',
            12 => 'grudnia',
        ],
    ],
    'time' => [
        'formats' => [
            'short'  => 'H:i',
            'medium' => 'H:i:s',
            'long'   => 'H:i:s',
        ],
    ],
    'number' => [
        'decimal_separator'   => ',',
        'thousands_separator' => ' ',
        'currency'            => 'PLN',
        'fraction_digits'     => 2,
    ],
];
