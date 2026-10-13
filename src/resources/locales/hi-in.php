<?php

declare(strict_types=1);

return [
    'locale' => 'hi-IN',
    'date' => [
        'formats' => [
            'short' => 'd/m/Y',
            'medium' => 'd/m/Y',
            'long' => 'j F Y',
        ],
        'long_month_case' => 'genitive',
        'months_genitive' => [
            1 => 'जनवरी',
            2 => 'फ़रवरी',
            3 => 'मार्च',
            4 => 'अप्रैल',
            5 => 'मई',
            6 => 'जून',
            7 => 'जुलाई',
            8 => 'अगस्त',
            9 => 'सितंबर',
            10 => 'अक्टूबर',
            11 => 'नवंबर',
            12 => 'दिसंबर',
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
            'grouping' => [3, 2],
        'currency' => 'INR',
        'fraction_digits' => 2,
    ],
];
