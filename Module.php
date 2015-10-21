<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server;

use OldTown\Workflow\Designer\Server\View\ApiProblemInjectResponse;
use OldTown\Workflow\Designer\Server\View\WorkflowDescriptorApiStrategy;
use Zend\Mvc\Application;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ResponseSender\SendResponseEvent;
use Zend\Mvc\SendResponseListener;
use OldTown\Workflow\Designer\Server\Listener\SendApiProblemResponseListener;
use Zend\View\View;

/**
 * Class Module
 *
 * @package OldTown\Workflow\Designer\Server
 */
class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    AutoloaderProviderInterface
{
    /**
     * @param EventInterface $e
     *
     * @return array|void
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var MvcEvent $e */
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'onRoute'), -1 * PHP_INT_MAX);
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'onRender'), PHP_INT_MAX);


        $serviceManager = $e->getApplication()->getServiceManager();

        /** @var SendResponseListener $sendResponseListener */
        $sendResponseListener = $serviceManager->get('SendResponseListener');

        $sendApiProblemResponseListener = $serviceManager->get(SendApiProblemResponseListener::class);

        $sendResponseEventManager =  $sendResponseListener->getEventManager();
        $sendResponseEventManager->attach(SendResponseEvent::EVENT_SEND_RESPONSE, $sendApiProblemResponseListener, -400);


    }


    /**
     * @param MvcEvent $e
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function onRoute(MvcEvent $e)
    {
        /** @var Application $app */
        $app = $e->getParam('application');
        $sm = $app->getServiceManager();

        if ($sm->has('View')) {

            /** @var View $view */
            $view   = $sm->get('View');

            $eventManager = $view->getEventManager();
            $eventManager->attach($sm->get(WorkflowDescriptorApiStrategy::class), 200);

        }

    }

    /**
     * @param MvcEvent $e
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function onRender(MvcEvent $e)
    {
        /** @var Application $app */
        $app = $e->getParam('application');
        $sm = $app->getServiceManager();

        if ($sm->has('View')) {

            /** @var View $view */
            $view   = $sm->get('View');

            $eventManager = $view->getEventManager();

            $eventManager->attach($sm->get(ApiProblemInjectResponse::class), 100);
        }

    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        $config = [];
        $autoloadFile = __DIR__ . '/autoload_classmap.php';
        if (file_exists($autoloadFile)) {
            $config['Zend\Loader\ClassMapAutoloader'] = [
                    $autoloadFile,
                ];
        }
        $config['Zend\Loader\StandardAutoloader'] = [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
        ];
        return $config;
    }
}