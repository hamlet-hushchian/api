<?php
namespace Api;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Application;
use Zend\View\Model\JsonModel;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch.error', [$this, 'DispatchErrors'], 100);
        $eventManager->attach('render', [$this, 'renderJsonErrors'], 99);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'processException'], 98);
    }

    public function processException(MvcEvent $e)
    {
        $exception = $e->getParam('exception');

        if ($exception instanceof \Api\Exception\NotFound) {
            $model = new JsonModel([
                'status' => 'NOT_FOUND',
                'message' => $exception->getMessage(),
                'data' => [],
            ]);

            $e->getResponse()->setStatusCode(404);
            $e->setViewModel($model);
            $e->stopPropagation();
        }
    }

    public function renderJsonErrors(MvcEvent $e)
    {
        $statusCode = $e->getResponse()->getStatusCode();
        if($statusCode == 400)
        {
            $model = new JsonModel([
                'status' => 'INVALID_REQUEST',
                'message' => 'Resourse this is not looking you for, young padawan',
                'data' => [],
            ]);

            return $e->setViewModel($model);
        }
    }

    public function DispatchErrors(MvcEvent $e)
    {
        $error  = $e->getError();

        if ($error == Application::ERROR_ROUTER_NO_MATCH) {
            $e->getResponse()->setStatusCode(400);
            $e->stopPropagation();
        }
    }
}
