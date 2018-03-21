<?php

namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Admin\Model\CidadeTable;
use Admin\Controller\CidadesController;

class CidadesControlerFactory
{
    function __invoke(ContainerInterface $container)
    {
        $table   = $container->get(CidadeTable::class);
                        
        return new CidadesController($table);
    }
}