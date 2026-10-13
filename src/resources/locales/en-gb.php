<?php

declare(strict_types=1);

return [
    'locale' => 'en-GB',
    'date' => [
        'formats' => [
            'short'  => 'Y-m-d',
            'medium' => 'd/m/Y',
            'long'   => 'j F Y',
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
        'decimal_separator'   => '.',
        'thousands_separator' => ',',
        'currency'            => 'GBP',
        'fraction_digits'     => 2,
    ],
];
