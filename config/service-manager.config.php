<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor\WorkflowDescriptorEntityResource;
use OldTown\Workflow\Designer\Server\Factory\ApiProblemInjectResponseFactory;
use OldTown\Workflow\Designer\Server\Factory\SendApiProblemResponseListenerFactory;
use OldTown\Workflow\Designer\Server\Factory\WorkflowDescriptorApiRendererFactory;
use OldTown\Workflow\Designer\Server\Factory\WorkflowDescriptorApiStrategyFactory;
use OldTown\Workflow\Designer\Server\Listener\SendApiProblemResponseListener;
use OldTown\Workflow\Designer\Server\View\ApiProblemInjectResponse;
use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiRenderer;
use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiStrategy;

return [
    'service_manager' => [
        'invokables' => [
            WorkflowDescriptorEntityResource::class => WorkflowDescriptorEntityResource::class
        ],
        'factories' => [
            WorkflowDescriptorApiStrategy::class => WorkflowDescriptorApiStrategyFactory::class,
            WorkflowDescriptorApiRenderer::class => WorkflowDescriptorApiRendererFactory::class,
            SendApiProblemResponseListener::class => SendApiProblemResponseListenerFactory::class,
            ApiProblemInjectResponse::class => ApiProblemInjectResponseFactory::class
        ]
    ]
];