<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Factory;

use OldTown\Workflow\Designer\Server\View\ApiProblemInjectResponse;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ApiProblemInjectResponseFactory
 *
 * @package OldTown\Workflow\Designer\Server\Factory
 */
class ApiProblemInjectResponseFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ApiProblemInjectResponse
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ApiProblemInjectResponse();
    }
}
