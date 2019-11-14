<?php
return [
    'resources' => [
        'preset' => ['url' => '/presets'],
    ],
    'routes' => [
        [
            'name' => 'conversion#convertHere',
            'url'  => 'ajax/convertHere.php',
            'verb' => 'POST'
        ],
    ],
];
