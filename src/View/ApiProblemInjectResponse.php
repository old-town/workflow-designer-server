<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\View;

use Zend\View\ViewEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\View\ApiProblemModel;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\Http\Header\Accept;
use Zend\Http\PhpEnvironment\Response;
use ZF\ContentNegotiation\Request;
use OldTown\Workflow\Designer\Server\XmlWriter\XmlWriter;


/**
 * Class ApiProblemInjectResponse
 *
 * @package ClassifierApi\View
 */
class ApiProblemInjectResponse extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    /**
     * @param ViewEvent $e
     *
     * @return null
     *
     * @throws \Zend\Config\Exception\RuntimeException
     * @throws \Zend\Http\Exception\InvalidArgumentException
     */
    public function injectResponse(ViewEvent $e)
    {
        $model = $e->getModel();
        if (!$model instanceof ApiProblemModel) {
            // Model is not an ApiProblemModel; we cannot handle it here
            return null;
        }

        /** @var Request $request */
        $request = $e->getRequest();

        /** @var Accept $accept */
        $accept = $request->getHeader('Accept');

        if (!($accept instanceof Accept && $accept->hasMediaType('text/xml'))) {
            return null;
        }

        $problem     = $model->getApiProblem();
        $statusCode  = $this->getStatusCodeFromApiProblem($problem);
        $contentType = 'text/xml';

        /** @var Response $response */
        $response = $e->getResponse();

        $problemData = $problem->toArray();
        $xmlWriter = new XmlWriter();

        $output = $xmlWriter->processConfig($problemData);


        $response->setStatusCode($statusCode);
        $response->setContent($output);
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', $contentType);
    }

    /**
     * Retrieve the HTTP status from an ApiProblem object
     *
     * Ensures that the status falls within the acceptable range (100 - 599).
     *
     * @param  ApiProblem $problem
     * @return int
     */
    protected function getStatusCodeFromApiProblem(ApiProblem $problem)
    {
        $problemData = $problem->toArray();
        $status = array_key_exists('status', $problemData) ? $problemData['status'] : 0;

        if ($status < 100 || $status >= 600) {
            return 500;
        }

        return $status;
    }
}
