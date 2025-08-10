<?php // config/flasher.php

return [
    'plugins' => [
        'notyf' => [
            'scripts' => [
                '/vendor/flasher/flasher-notyf.min.js',
            ],
            'styles' => [
                '/vendor/flasher/flasher-notyf.min.css',
            ],
            'options' => [
                'duration' => 5000,
                'dismissible' => true,
                'types' => [
                [
                    'type' => 'success',
                    'background' => '#2ecc71',
                    'icon' => [
                        'tagName' => 'i',
                        'className' => 'fas fa-check',
                        'color' => 'white',
                    ],
                ],
                [
                    'type' => 'info',
                    'background' => '#3498db',
                    'icon' => [
                        'tagName' => 'i',
                        'className' => 'fas fa-info',
                        'text' => '',
                        'color' => 'white',
                    ],
                ],
                [
                    'type' => 'warning',
                    'background' => '#f39c12',
                    'icon' => [
                        'tagName' => 'i',
                        'className' => 'fas fa-exclamation',
                        'text' => '',
                        'color' => 'white',
                    ],
                ],
                [
                    'type' => 'error',
                    'background' => '#e74c3c',
                    'icon' => [
                        'tagName' => 'i',
                        'className' => 'fas fa-xmark',
                        'text' => '',
                        'color' => 'white',
                    ],
                ],
            ],
        ],
    ],
]];
