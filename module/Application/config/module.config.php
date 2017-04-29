<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\AuthController;
use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\I18n\Translator\TranslatorServiceFactory;
use Zend\I18n\View\Helper\Translate;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'map' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/map[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\MapController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'mail' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/mail[/:action[/:id[/:folder]]]',
                    'defaults' => [
                        'controller' => Controller\MailController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'file' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/file[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\FileController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'auth' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/auth',
                    'defaults' => [
                        'controller' => AuthController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'callback' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/callback/:provider',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'callback',
                            ],
                        ],
                    ],
                    'login' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/login',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'login',
                            ],
                        ],
                    ],
                    'register' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/register',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'register',
                            ],
                        ],
                    ],
                    'logout' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/logout',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'logout',
                            ],
                        ],
                    ],
                    'check' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/check',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'check',
                            ],
                        ],
                    ],
                    'reset' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/reset',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'resetPassword',
                            ],
                        ],
                    ],
                    'resetPass' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/resetPass',
                            'defaults' => [
                                'controller' => AuthController::class,
                                'action' => 'resetPassCall',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'admin',
                'icon' => 'fa fa-home'
            ],
            [
                'label' => 'JakZjem-Mapa.pl',
                'route' => 'map',
                'icon' => 'fa fa-map',
                'pages' => [
                    [
                        'label' => 'Dashboard',
                        'route' => 'map',
                        'action' => 'index',
                        'icon' => 'fa fa-dashboard'
                    ],
                    [
                        'label' => 'Statystyki',
                        'route' => 'map',
                        'action' => 'statistics',
                        'icon' => 'fa fa-line-chart'
                    ],
                    [
                        'label' => 'Punkty',
                        'route' => 'map',
                        'action' => 'points',
                        'icon' => 'fa fa-circle',
                        'pages' => [
                            [
                            'label' => 'Edytuj',
                            'route' => 'map',
                            'action' => 'editPoint',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Miasta',
                        'route' => 'map',
                        'action' => 'towns',
                        'icon' => 'fa fa-building',
                        'pages' => [
                            [
                                'label' => 'Edytuj',
                                'route' => 'map',
                                'action' => 'editTown',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Użytkownicy',
                        'route' => 'map',
                        'action' => 'users',
                        'icon' => 'fa fa-group',
                        'pages' => [
                            [
                                'label' => 'Edytuj',
                                'route' => 'map',
                                'action' => 'editUser',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Pliki',
                        'route' => 'map',
                        'action' => 'files',
                        'icon' => 'fa fa-file'
                    ],
                    [
                        'label' => 'Crony',
                        'route' => 'map',
                        'action' => 'crons',
                        'icon' => 'fa fa-tasks'
                    ],
                    [
                        'label' => 'Edytuj',
                        'route' => 'map',
                        'action' => 'editPoint',
                    ],
                    [
                        'label' => 'Dodaj nowy',
                        'route' => 'map',
                        'action' => 'add',
                        'icon' => 'fa fa-plus'
                    ],
                ],
            ],
            [
                'label' => 'Skrzynka mailowa',
                'route' => 'mail',
                'icon' => 'fa fa-envelope'
            ],
            [
                'label' => 'Manager plików',
                'route' => 'file',
                'icon' => 'fa fa-files-o'
            ],
            [
                'label' => 'Application',
                'route' => 'application',
                'icon' => 'fa fa-th-large',
                'pages' => [
                    [
                        'label'  => 'Index',
                        'route'  => 'application',
                        'action' => 'index',
                    ],
                    [
                        'label'  => 'Second',
                        'route'  => 'application',
                        'action' => 'second',
                    ],
                ],
            ],
            [
                'label' => 'Front',
                'route' => 'home',
                'icon' => 'fa fa-star'
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\AuthController::class => Factory\AuthControllerFactory::class,
            Controller\MapController::class => Factory\MapControllerFactory::class,
            Controller\MailController::class => Factory\MailControllerFactory::class,
            Controller\FileController::class => Factory\FileControllerFactory::class,
        ],
    ],
    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'object_manager' => EntityManager::class,
                'identity_class' => User::class,
                'identity_property' => 'email',
                'credential_property' => 'password'
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            TranslatorInterface::class => TranslatorServiceFactory::class,
        ]
    ],
    'controller_plugins' => [
        'invokables' => [
            'translate' => Translate::class
        ],
    ],
    'translator' => [
        'locale' => LOCALE,
        'translation_file_patterns' => [
            [
                'type' => 'php',
                'base_dir' => ROOT_PATH . '/vendor/zendframework/zend-i18n-resources/languages/pl',
                'pattern' => '%s.php',
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
