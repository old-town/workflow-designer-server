<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor;


use OldTown\Workflow\Basic\BasicWorkflow;
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
     * @return \OldTown\Workflow\Loader\WorkflowDescriptor
     */
    public function fetch($id)
    {

            \OldTown\Workflow\Config\DefaultConfiguration::addDefaultPathToConfig(__DIR__ . '/../../../../../../../../config/workflow');
            \OldTown\Workflow\Loader\XmlWorkflowFactory::addDefaultPathToWorkflows(__DIR__ . '/../../../../../../../../config/workflow');

            $wf = new BasicWorkflow('johndoe');
            //$id = $wf->initialize('example', 100, null);


            $workflowDescriptor = $wf->getWorkflowDescriptor('example');

            return $workflowDescriptor;

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