<?php
namespace Api;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'books' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/books',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'books',
                    ],
                ],
            ],
            'authors' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/authors[/:id][/:data]',
                    'constraints' => [
                        'data' => 'books'
                    ],
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'authors',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => Controller\Factory\ApiControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\ApiManager::class => Service\Factory\ApiManagerFactory::class,
            // ...
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
