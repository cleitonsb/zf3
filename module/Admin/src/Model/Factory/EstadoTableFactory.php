<?php

namespace Admin\Model\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Admin\Model;
use Admin\Model\EstadoTable;

class EstadoTableFactory implements FactoryInterface
{
    
    function __invoke(ContainerInterface $container, $requestedName, array $option = null)
    {
        $tableGateway = $container->get(Model\EstadoTableGateway::class);
        return new EstadoTable($tableGateway);
    }
}