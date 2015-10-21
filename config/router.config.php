<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\Controller\WorkflowDesignerController;

return [
    'router' => [
        'routes' => [
            'workflow-designer' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/workflow/designer/',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'view' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'app',
                            'defaults' => [
                                'controller' => WorkflowDesignerController::class,
                                'action' => 'app'
                            ]
                        ],
                    ],
                    'api' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'api/',
                        ]
                    ]
                ]
            ],
            'assets-workflow-designer' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/assets/workflow/designer/',
                ],
            ]
        ]
    ]
];