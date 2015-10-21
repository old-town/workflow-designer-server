<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiModel;

$content_type_whitelist = [
    'multipart/form-data' => 'multipart/form-data',
    'application/x-www-form-urlencoded' => 'application/x-www-form-urlencoded',
];

$accept_whitelist = [
    'multipart/form-data' => 'multipart/form-data',
    'application/x-www-form-urlencoded' => 'application/x-www-form-urlencoded',
];

return [

    'zf-content-negotiation' => [
        'selectors'              => [
            'WorkflowDescriptor' => [
                WorkflowDescriptorApiModel::class => [
                    'text/xml'
                ],
                'ZF\ContentNegotiation\JsonModel'       => [
                    'application/json'
                ],
                'ZF\Hal\View\HalJsonModel'              => [
                    'application/*+json'
                ]
            ]
        ],
        'controllers' => [
            'OldTown\\Workflow\\Designer\\Server\\Api\\V1\\Rest\\WorkflowDescriptorController' => 'WorkflowDescriptor',
        ],
        'accept_whitelist' => [
            'OldTown\\Workflow\\Designer\\Server\\Api\\V1\\Rest\\WorkflowDescriptorController' => $accept_whitelist,
        ],
        'content_type_whitelist' => [
            'OldTown\\Workflow\\Designer\\Server\\Api\\V1\\Rest\\WorkflowDescriptorController' => $content_type_whitelist,
        ],
    ],
];