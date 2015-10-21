<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

$config = [
];


return array_merge_recursive(
    include __DIR__ . '/service-manager.config.php',
    include __DIR__ . '/router.config.php',
    include __DIR__ . '/zf-rest.config.php',
    include __DIR__ . '/zf-content-negotiation.config.php',
    $config
);