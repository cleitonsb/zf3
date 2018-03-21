<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Admin\Model\Factory\NfeTableGatewayFactory;
use Admin\Controller\NfeController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Admin\Model\Factory\NfeTableFactory;
use Admin\Controller\Factory\NfeControlerFactory;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Admin\Form\NfeForm;
use Admin\Form\Factory\NfeFormFactory;
use Admin\Controller\IndexController;
use Zend\ServiceManager\Factory\InvokableFactory;
use Admin\Controller\ProfessoresController;
use Admin\Controller\Factory\ProfessoresControlerFactory;
use Admin\Controller\UsuariosController;
use Admin\Controller\Factory\UsuariosControlerFactory;
use Admin\Model\Factory\UsuarioTableFactory;
use Admin\Model\Factory\UsuarioTableGatewayFactory;
use Admin\Form\UsuarioForm;
use Admin\Form\Factory\UsuarioFormFactory;
use Admin\Model\Factory\EstadoTableFactory;
use Admin\Model\Factory\EstadoTableGatewayFactory;
use Admin\Model\Factory\CidadeTableFactory;
use Admin\Model\Factory\CidadeTableGatewayFactory;
use Admin\Model\Factory\MateriaTableFactory;
use Admin\Model\Factory\MateriaTableGatewayFactory;
use Admin\Controller\CidadesController;
use Admin\Controller\Factory\CidadesControlerFactory;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
    const VERSION = '3.0.0dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                // Nfe
                Model\NfeTable::class => NfeTableFactory::class,
                Model\NfeTableGateway::class => NfeTableGatewayFactory::class,
                NfeForm::class  => NfeFormFactory::class,
                // Usuario
                Model\UsuarioTable::class => UsuarioTableFactory::class,
                Model\UsuarioTableGateway::class => UsuarioTableGatewayFactory::class,
                UsuarioForm::class => UsuarioFormFactory::class,
                // Estado
                Model\EstadoTable::class => EstadoTableFactory::class,
                Model\EstadoTableGateway::class => EstadoTableGatewayFactory::class,
                //Cidade
                Model\CidadeTable::class => CidadeTableFactory::class,
                Model\CidadeTableGateway::class => CidadeTableGatewayFactory::class,
                //Materia
                Model\MateriaTable::class => MateriaTableFactory::class,
                Model\MateriaTableGateway::class => MateriaTableGatewayFactory::class,
            ]
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                NfeController::class => NfeControlerFactory::class,
                IndexController::class => InvokableFactory::class,
                ProfessoresController::class => ProfessoresControlerFactory::class,
                UsuariosController::class => UsuariosControlerFactory::class,
                CidadesController::class => CidadesControlerFactory::class,
            ]
        ];
    }
}
