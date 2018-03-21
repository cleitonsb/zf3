<?php

namespace Admin\Model\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Admin\Model\NfeTable;

use Admin\Model;

class NfeTableFactory implements FactoryInterface
{
    
    function __invoke(ContainerInterface $container, $requestedName, array $option = null)
    {
        $tableGateway = $container->get(Model\NfeTableGateway::class);
        return new NfeTable($tableGateway);
    }
}