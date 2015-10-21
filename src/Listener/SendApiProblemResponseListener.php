<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Listener;

use OldTown\Workflow\Designer\Server\XmlWriter\XmlWriter;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\ResponseSender\SendResponseEvent;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Mvc\MvcEvent;
use Zend\Http\Header\Accept;
use ZF\ContentNegotiation\Request;
use ZF\ApiProblem\Listener\SendApiProblemResponseListener as SendApiProblemResponseListenerApigility;


/**
 * Class SendApiProblemResponseListener
 *
 * @package OldTown\Workflow\Designer\Server\Listener
 */
class SendApiProblemResponseListener extends SendApiProblemResponseListenerApigility
{
    /**
     *
     * @var MvcEvent
     */
    protected $mvcEvent;

    /**
     * @return MvcEvent
     */
    public function getMvcEvent()
    {
        return $this->mvcEvent;
    }

    /**
     * @param MvcEvent $mvcEvent
     *
     * @return $this
     */
    public function setMvcEvent(MvcEvent $mvcEvent)
    {
        $this->mvcEvent = $mvcEvent;

        return $this;
    }


    /**
     * Send the response content
     *
     * Sets the composed ApiProblem's flag for including the stack trace in the
     * detail based on the display exceptions flag, and then sends content.
     *
     * @param SendResponseEvent $e
     * @return self
     *
     * @throws \Zend\Config\Exception\RuntimeException
     */
    public function sendContent(SendResponseEvent $e)
    {
        $response = $e->getResponse();
        if (!$response instanceof ApiProblemResponse) {
            return $this;
        }
        $response->getApiProblem()->setDetailIncludesStackTrace($this->displayExceptions());

        /** @var Request $request */
        $request  = $this->getMvcEvent()->getRequest();

        /** @var Accept $accept */
        $accept = $request->getHeader('Accept');

        if ($accept instanceof Accept && $accept->hasMediaType('text/xml')) {
            $arrayResponse = $response->getApiProblem()->toArray();

            $xmlWriter = new XmlWriter();

            if (array_key_exists('trace', $arrayResponse)) {
                array_walk($arrayResponse['trace'], function (&$item) {
                    unset($item['args']);
                });
            }
            if (array_key_exists('exception_stack', $arrayResponse)) {
                array_walk($arrayResponse['exception_stack'], function (&$item) {
                    array_walk($item['trace'], function (&$trace) {
                        unset($trace['args']);
                    });
                });
            }
            $output = $xmlWriter->processConfig($arrayResponse);

            echo $output;
            $e->setContentSent();
            return $this;
        }

        return parent::sendHeaders($e);
    }

    /**
     * Send HTTP response headers
     *
     * If an application response is composed, and is an HTTP response, merges
     * its headers with the ApiProblemResponse headers prior to sending them.
     *
     * @param  SendResponseEvent $e
     * @return self
     *
     * @throws \Zend\Http\Exception\InvalidArgumentException
     */
    public function sendHeaders(SendResponseEvent $e)
    {
        $response = $e->getResponse();
        if (!$response instanceof ApiProblemResponse) {
            return $this;
        }

        /** @var Request $request */
        $request  = $this->getMvcEvent()->getRequest();

        /** @var Accept $accept */
        $accept = $request->getHeader('Accept');

        if ($accept instanceof Accept && $accept->hasMediaType('text/xml')) {
            $headers = $response->getHeaders();

            if ($headers->has('content-type')) {
                $contentTypeHeader = $headers->get('content-type');
                $headers->removeHeader($contentTypeHeader);
            }
            $headers->addHeaderLine('content-type', 'text/xml');

            if ($this->applicationResponse instanceof HttpResponse) {
                $this->mergeHeaders($this->applicationResponse, $response);
            }
        }

        return parent::sendHeaders($e);
    }
}
