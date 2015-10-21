<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor;


use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\Rest\AbstractResourceListener;


/**
 * Class WorkflowDescriptorEntityResource
 *
 * @package OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor
 */
class WorkflowDescriptorEntityResource extends AbstractResourceListener implements
    ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @param mixed $id
     * @return void
     */
    public function fetch($id)
    {
        die('fetch');
    }

    /**
     * @param array $params
     * @return void
     */
    public function fetchAll($params = [])
    {
        die('fetchAll');
    }

}