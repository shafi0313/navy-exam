<?php

return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'author' => '',
    'subject' => '',
    'keywords' => '',
    'creator' => 'Laravel Pdf',
    'display_mode' => 'fullpage',
    'tempDir' => base_path('../temp/'),
    'pdf_a' => false,
    'pdf_a_auto' => false,
    'icc_profile_path' => '',

    'font_path' => base_path('/public/backend/fonts/'),
    'font_data' => [
        // 'bangla' => [
        //     'R'  => 'SolaimanLipi.ttf',    // regular font
        //     'B'  => 'SolaimanLipi.ttf',       // optional: bold font
        //     'I'  => 'SolaimanLipi.ttf',     // optional: italic font
        //     'BI' => 'SolaimanLipi.ttf', // optional: bold-italic font
        //     'useOTL' => 0xFF,
        //     'useKashida' => 75,
        // ]
        'bangla' => [
            'R' => 'Nirmala.ttf',    // regular font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        // ...add as many as you want.
    ],

];
