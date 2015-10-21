<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

$config = [
];


return array_merge_recursive(
    include __DIR__ . '/view.config.php',
    include __DIR__ . '/router.config.php',
    include __DIR__ . '/controller.config.php',
    include __DIR__ . '/assetic.config.php',
    $config
);