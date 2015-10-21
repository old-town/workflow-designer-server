<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\View;

use OldTown\Workflow\Loader\WorkflowDescriptor;
use Zend\View\Exception;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\HelperPluginManager;
use Zend\View\Resolver\ResolverInterface as Resolver;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemRenderer;
use Zend\View\ViewEvent;
use ZF\Hal\Entity;

/**
 * Class WorkflowDescriptorApiRenderer
 *
 * @package OldTown\Workflow\Designer\Server\View
 */
class WorkflowDescriptorApiRenderer  implements Renderer
{
    /**
     * @var ApiProblemRenderer
     */
    protected $apiProblemRenderer;

    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * @var ViewEvent
     */
    protected $viewEvent;

    /**
     * @param ApiProblemRenderer $apiProblemRenderer
     */
    public function __construct(ApiProblemRenderer $apiProblemRenderer)
    {
        $this->apiProblemRenderer = $apiProblemRenderer;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @param  Resolver $resolver
     * @return $this
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    /**
     * @var HelperPluginManager
     */
    protected $helpers;

    /**
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     * @param null                                   $values
     *
     * @return string
     *
     * @throws \OldTown\Workflow\Exception\InternalWorkflowException
     * @throws \OldTown\Workflow\Exception\InvalidDescriptorException
     * @throws \OldTown\Workflow\Exception\InvalidWriteWorkflowException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function render($nameOrModel, $values = null)
    {

        /** @var WorkflowDescriptor $data */
        $data = $this->getRendererData($nameOrModel);

        $output = $data->writeXml()->saveXML();

        return  $output;
    }

    /**
     * @param $nameOrModel
     *
     * @return array|string|ApiProblem
     *
     * @throws Exception\RuntimeException
     */
    protected function getRendererData($nameOrModel)
    {
        if (!$nameOrModel instanceof WorkflowDescriptorApiModel) {
            $errMsg = sprintf('Рендерер поддерживает только %s', WorkflowDescriptorApiModel::class);
            throw new Exception\RuntimeException($errMsg);
        }

        if ($nameOrModel->isEntity()) {
            /** @var Entity $payload */
            $payload = $nameOrModel->getPayload();
            $descriptor = call_user_func([$payload, '__get'], 'entity');

            if ($descriptor instanceof WorkflowDescriptor) {
                return $descriptor;
            }
        }

        $errMsg = 'Ошибка в рендеринге';
        throw new Exception\RuntimeException($errMsg);
    }


    /**
     * @param  ViewEvent $event
     * @return self
     */
    public function setViewEvent(ViewEvent $event)
    {
        $this->viewEvent = $event;
        return $this;
    }

    /**
     * @return ViewEvent
     */
    public function getViewEvent()
    {
        return $this->viewEvent;
    }
}
