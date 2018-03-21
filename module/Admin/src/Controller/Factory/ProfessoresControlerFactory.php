<?php

namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Admin\Controller\ProfessoresController;
use Admin\Model\UsuarioTable;

class ProfessoresControlerFactory
{
    function __invoke(ContainerInterface $container)
    {
        
        //$usuarioTable = $container->get(UsuarioTable::class);
        
        
        /* $nfeTable   = $container->get(NfeTable::class);
        $nfeForm    = $container->get(NfeForm::class); */
                
        //return new NfeController($nfeTable, $nfeForm, $test);
        
        return new ProfessoresController($usuarioTable);
    }
}