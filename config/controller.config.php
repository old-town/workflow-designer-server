<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\Controller\WorkflowDesignerController;

return [
    'controllers' => [
        'invokables' => [
            WorkflowDesignerController::class => WorkflowDesignerController::class
        ]
    ]
];