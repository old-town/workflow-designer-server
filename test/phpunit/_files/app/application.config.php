<?php

use OldTown\Workflow\Designer\Server\PhpUnit\Test\Paths;

return [
    'modules' => [
        'ZF\\ApiProblem',
        'ZF\\Configuration',
        'ZF\\MvcAuth',
        'ZF\\Hal',
        'ZF\\ContentNegotiation',
        'ZF\\ContentValidation',
        'ZF\\Rest',
        'OldTown\\Workflow\\ZF2',
        'OldTown\\Workflow\\Designer\\Server',
    ],
    'module_listener_options' => [
        'module_paths' => [
            'OldTown\\Workflow\\ZF2\\View' => Paths::getPathToModule(),
        ],
        'config_glob_paths' => []
    ]
];
