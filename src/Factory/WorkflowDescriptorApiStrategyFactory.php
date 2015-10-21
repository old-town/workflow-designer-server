<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Factory;

use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiRenderer;
use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Class WorkflowDescriptorApiStrategyFactory
 *
 * @package OldTown\Workflow\Designer\Server\Factory
 */
class WorkflowDescriptorApiStrategyFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return WorkflowDescriptorApiStrategy
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var WorkflowDescriptorApiRenderer $renderer */
        $renderer = $serviceLocator->get(WorkflowDescriptorApiRenderer::class);
        return new WorkflowDescriptorApiStrategy($renderer);
    }
}
