<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor\WorkflowDescriptorEntityResource;

return [
    'service_manager' => [
        'invokables' => [
            WorkflowDescriptorEntityResource::class => WorkflowDescriptorEntityResource::class
        ]
    ]
];