<?php

use Pagekit\Application;

return [
    'name' => 'notes',

    'type' => 'extension',

    'autoload' => [
            'Pagekit\\Notes\\' => 'src'
    ],

    'resources' => [
            'notes:' => ''
    ],
    'nodes' => [

        'notes' => [
            'name' => '@notes',
            'label' => 'Notes',
            'controller' => 'Pagekit\\Notes\\Controller\\SiteController',
            'protected' => true,
            'frontpage' => true
        ]

    ],

    'routes' => [

        '/notes' => [
            'name' => '@notes',
            'controller' => 'Pagekit\\Notes\\Controller\\NotesController',
        ],
    ],


    'menu' => [

        'notes' => [
            'label' => 'Notes',
            'icon' => 'notes:icon.svg',
            'url' => '@notes/page',
            'active' => '@notes/page*',
            'priority' => 110
        ],
        'notes: page' => [
            'label' => 'Notes',
            'parent' => 'notes',
            'url' => '@notes/page',
            'active' => '@notes/page*'
        ],
        'notes: new' => [
            'label' => 'Add a note',
            'parent' => 'notes',
            'url' => '@notes/add',
            'active' => '@notes/add'
        ],
        'notes: settings' => [
            'label' => 'Settings',
            'parent' => 'notes',
            'url' => '@notes/settings',
            'active' => '@notes/settings'
        ],
    ],
];
