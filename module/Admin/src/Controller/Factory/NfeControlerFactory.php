<?php

namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Admin\Controller\NfeController;
use Admin\Model\NfeTable;
use Admin\Form\NfeForm;

class NfeControlerFactory
{
    function __invoke(ContainerInterface $container)
    {
        $nfeTable   = $container->get(NfeTable::class);
        $nfeForm    = $container->get(NfeForm::class);
                
        return new NfeController($nfeTable, $nfeForm, $test);
    }
}