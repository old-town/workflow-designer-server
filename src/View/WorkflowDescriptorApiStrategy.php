<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\View;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\View\ViewEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use ZF\Hal\Entity as HalEntity;

/**
 * Class WorkflowDescriptorApiStrategy
 *
 * @package OldTown\Workflow\Designer\Server\View
 */
class WorkflowDescriptorApiStrategy extends AbstractListenerAggregate
{
    /**
     * @var WorkflowDescriptorApiRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  WorkflowDescriptorApiRenderer $renderer
     */
    public function __construct(WorkflowDescriptorApiRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    /**
     * Detect if we should use the FeedRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     *
     * @return null|WorkflowDescriptorApiRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!($model instanceof WorkflowDescriptorApiModel || $model instanceof HalEntity)) {
            return null;
        }

        $this->renderer->setViewEvent($e);

        return $this->renderer;
    }

    /**
     * Inject the response with the feed payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     * @throws \Zend\Http\Exception\InvalidArgumentException
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();

        if ($renderer !== $this->renderer) {
            return;
        }

        $result   = $e->getResult();

        /** @var HttpResponse $response */
        $response = $e->getResponse();
        $response->setContent($result);
        $headers = $response->getHeaders();
        //$headers->addHeaderLine('Content-length', strlen($result));
        $headers->addHeaderLine('content-type', 'text/xml');
    }
}
