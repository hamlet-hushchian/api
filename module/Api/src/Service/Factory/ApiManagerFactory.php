<?php
namespace Api\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Api\Service\ApiManager;

Class ApiManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,$requestedName, array $opt = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new ApiManager($entityManager);
    }
}