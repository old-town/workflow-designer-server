<?php
return array(
    'modules' => array(
        'AsseticBundle',
        'OldTown\\Workflow\\Designer\\Client'
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
