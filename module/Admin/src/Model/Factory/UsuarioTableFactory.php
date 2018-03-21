<?php

namespace Admin\Model\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Admin\Model;
use Admin\Model\UsuarioTable;

class UsuarioTableFactory implements FactoryInterface
{
    
    function __invoke(ContainerInterface $container, $requestedName, array $option = null)
    {
        $tableGateway = $container->get(Model\UsuarioTableGateway::class);
        return new UsuarioTable($tableGateway);
    }
}