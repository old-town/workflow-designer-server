<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

/** @noinspection PhpIncludeInspection */
return [
    'view_manager' => [

        'template_map' => array_merge(
            [],
            file_exists( __DIR__ . '/../template_map.php') ?  include __DIR__ . '/../template_map.php' : []
        ),
        'template_path_stack' => [
            __DIR__ . '/../view',
        ]
    ],
];