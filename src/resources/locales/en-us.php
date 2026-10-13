<?php

declare(strict_types=1);

return [
    'locale' => 'en-US',
    'date' => [
        'formats' => [
            'short'  => 'Y-m-d',
            'medium' => 'm/d/Y',
            'long'   => 'F j, Y',
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
        'currency'            => 'USD',
        'fraction_digits'     => 2,
    ],
];
