<?php
/**
 * @link    https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Api\V1\Rest\WorkflowDescriptor;

use OldTown\Workflow\WorkflowInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\Rest\AbstractResourceListener;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;


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
     *
     * @return \OldTown\Workflow\Loader\WorkflowDescriptor
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function fetch($id)
    {
        $routeMath = $this->getEvent()->getRouteMatch();
        $workflowManager = $routeMath->getParam('workflowManager', null);

        if (null === $workflowManager || '' === trim($workflowManager)) {
            return new ApiProblemResponse(
                new ApiProblem(400, 'Invalid workflow manager name')
            );
        }

        if (null === $id || '' === trim($id)) {
            return new ApiProblemResponse(
                new ApiProblem(400, 'Invalid workflow name')
            );
        }

        try {
            /** @var WorkflowInterface $workflow */
            $workflowServiceName = sprintf('workflow.manager.%s', $workflowManager);
            $workflow = $this->getServiceLocator()->get($workflowServiceName);

            $workflowDescriptor = $workflow->getWorkflowDescriptor($id);
        } catch (\Exception $e) {
            return new ApiProblemResponse(
                new ApiProblem(400, $e->getMessage())
            );
        }




        return $workflowDescriptor;
    }

    /**
     * @param array $params
     *
     * @return void
     */
    public function fetchAll($params = [])
    {
        die('fetchAll');
    }
}
