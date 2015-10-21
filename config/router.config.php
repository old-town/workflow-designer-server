<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

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
                    'api' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'api/',
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'workflow-descriptor' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => 'v1/rest/workflow-descriptor[/:id][/]',
                                    'constraints' => [
                                        'id' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'controller' => 'OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptorController'
                                    ]
                                ],
                            ]
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