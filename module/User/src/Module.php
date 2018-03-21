<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use User\Controller\AuthController;
use User\Form\LoginForm;
use User\Controller\Factory\AuthControlerFactory;
use User\Form\Factory\LoginFormFactory;
use Zend\Authentication\AuthenticationServiceInterface;
use User\Service\Factory\AuthenticationServiceFactory;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\MvcEvent;


class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
    
    public function onBootstrap(MvcEvent $e){
        $eventManager = $e->getApplication()->getEventManager();
        $container = $e->getApplication()->getServiceManager();
        
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function(MvcEvent $e) use($container){
            
            //-- chega se o usuario esta logado
            $match = $e->getRouteMatch();
            
            $authService = $container->get(AuthenticationServiceInterface::class);
            $routeName = $match->getMatchedRouteName();
            
            //-- seta o layout proprio para o modulo
            $vm = $e->getViewModel();
            
            if($authService->hasIdentity()){
                $vm->setTemplate('layout/layout.phtml');                
                return;
                
            }else if(strpos($routeName, 'admin') !== false){
                $vm->setTemplate('layout/layoutbasico.phtml');
                $match->setParam("controller", AuthController::class)->setParam('action', 'login');
            }else{
                $vm->setTemplate('layout/layoutbasico.phtml');
            }
            
            
            
            /* if(strpos($routeName, 'admin') !== false){
                $vm->setTemplate('layout/layout.phtml');
            }else{
                $vm->setTemplate('layout/layoutbasico.phtml');
            } */
            
            
        }, 100);
        
        //-- evento disparado quando ocorre erro
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function(MvcEvent $e){
            $vm = $e->getViewModel();
            $vm->setTemplate('layout/layoutbasico.phtml');
        }, 99);
        
    }
    
   
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'aliases'   => [
                AuthenticationService::class => AuthenticationServiceInterface::class
            ],            
            'factories' => [
                LoginForm::class => LoginFormFactory::class,
                AuthenticationServiceInterface::class => AuthenticationServiceFactory::class
            ]
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                AuthController::class => AuthControlerFactory::class
            ]
        ];
    }       
}
