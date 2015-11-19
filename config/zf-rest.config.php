<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor\WorkflowDescriptorCollection;
use OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor\WorkflowDescriptorEntityResource;
use OldTown\Workflow\Loader\WorkflowDescriptor;

return [
    'zf-rest' => [
        'OldTown\\Workflow\\Designer\\Server\\Api\\V1\\Rest\\WorkflowDescriptorController' => [
            'listener'                   => WorkflowDescriptorEntityResource::class,
            'route_name'                 => 'workflow-designer\api\workflow-descriptor',
            'collection_name'            => 'workflowDescriptors',
            'entity_http_methods'        => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_http_methods'    => [
            ],
            'collection_query_whitelist' => [],
            'page_size'                  => 25,
            'page_size_param'            => 'pageSize',
            'entity_class'               => WorkflowDescriptor::class,
            'collection_class'           => WorkflowDescriptorCollection::class,
            'service_name'               => 'workflowDescriptor',
            'route_identifier_name'      => 'workflowName',
        ],
    ],
];
