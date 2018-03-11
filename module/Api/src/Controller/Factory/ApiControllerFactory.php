<?php
namespace Api\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Api\Controller\ApiController;

Class ApiControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,$requestedName, array $opt = null)
    {
        $apiManager = $container->get(\Api\Service\ApiManager::class);

        return new ApiController($apiManager);
    }
}