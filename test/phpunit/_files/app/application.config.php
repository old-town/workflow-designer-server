<?php
return array(
    'modules' => array(
        'ZF\\ApiProblem',
        'ZF\\Configuration',
        'ZF\\MvcAuth',
        'ZF\\Hal',
        'ZF\\ContentNegotiation',
        'ZF\\ContentValidation',
        'ZF\\Rest',
        'OldTown\\Workflow\\Designer\\Server'
    ),

    'module_listener_options' => array(

        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            __DIR__ . '/config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    )
);
