<?php

namespace Admin\Controller\Factory;

use Interop\Container\ContainerInterface;
use Admin\Model\UsuarioTable;
use Admin\Controller\UsuariosController;
use Admin\Form\UsuarioForm;
use Admin\Model\EstadoTable;
use Admin\Model\CidadeTable;
use Admin\Model\MateriaTable;

class UsuariosControlerFactory
{
    function __invoke(ContainerInterface $container)
    {
        
        $usuarioTable   = $container->get(UsuarioTable::class);
        $estadoTable    = $container->get(EstadoTable::class);
        $cidadeTable    = $container->get(CidadeTable::class);
        $materiaTable   = $container->get(MateriaTable::class);
        $usuarioForm    = $container->get(UsuarioForm::class);
                
        return new UsuariosController($usuarioForm, $usuarioTable, $estadoTable, $cidadeTable, $materiaTable);
    }
}