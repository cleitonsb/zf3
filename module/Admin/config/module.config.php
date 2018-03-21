<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'admin-professores' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/professores[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\ProfessoresController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'admin-usuarios' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/usuarios[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\UsuariosController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'admin-aulas' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/professores[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\ProfessoresController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'admin-materias' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/professores[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\ProfessoresController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'cidades' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/cidades[/:action[/:uf]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'uf' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CidadesController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            /* 'admin' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/admin',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'professores' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/professores[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller'    => Controller\ProfessoresController::class,
                                'action'        => 'index',
                            ],
                        ],
                    ],
                ],
            ], */
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\NfeController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'        => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index'    => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'            => __DIR__ . '/../view/error/404.phtml',
            'error/index'          => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
