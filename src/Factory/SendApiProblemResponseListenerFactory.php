<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\Factory;

use OldTown\Workflow\Designer\Server\Listener\SendApiProblemResponseListener;
use Zend\Http\Response as HttpResponse;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;


/**
 * Class SendApiProblemResponseListenerFactory
 *
 * @package OldTown\Workflow\Designer\Server\Factory
 */
class SendApiProblemResponseListenerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return SendApiProblemResponseListener
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var array  $config */
        $config            = $serviceLocator->get('Config');
        $displayExceptions = array_key_exists('view_manager', $config)
            && array_key_exists('display_exceptions', $config['view_manager'])
            && $config['view_manager']['display_exceptions'];

        $listener = new SendApiProblemResponseListener();
        $listener->setDisplayExceptions($displayExceptions);

        if ($serviceLocator->has('Response')) {
            $response = $serviceLocator->get('Response');
            if ($response instanceof HttpResponse) {
                $listener->setApplicationResponse($response);
            }
        }

        if ($serviceLocator->has('Application')) {
            /** @var Application $app */
            $app = $serviceLocator->get('Application');
            $mvcEvent = $app->getMvcEvent();

            if ($mvcEvent instanceof MvcEvent) {
                $listener->setMvcEvent($mvcEvent);
            }
        }



        return $listener;
    }
}
