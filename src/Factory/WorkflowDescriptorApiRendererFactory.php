<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Factory;

use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiRenderer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\ApiProblem\View\ApiProblemRenderer;

/**
 * Class WorkflowDescriptorApiRendererFactory
 *
 * @package OldTown\Workflow\Designer\Server\Factory
 */
class WorkflowDescriptorApiRendererFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return WorkflowDescriptorApiRenderer
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        /** @var ApiProblemRenderer $apiProblemRenderer */
        $apiProblemRenderer = $serviceLocator->get(ApiProblemRenderer::class);

        $renderer = new WorkflowDescriptorApiRenderer($apiProblemRenderer);
        return $renderer;
    }
}
