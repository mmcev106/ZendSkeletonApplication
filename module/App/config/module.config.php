<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace App;

use App\Auth\AuthenticationServiceFactory;
use App\Auth\Storage;
use App\Db\Connection;
use App\Di\AbstractFactory;
use App\Di\ControllerManagerFactory;
use App\Di\InjectorFactory;
use App\Db\ConnectionFactory;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Service\SessionConfigFactory;
use Zend\Session\Service\StorageFactory;

return [
    'service_manager' => [
        'factories' => [
            'Zend\Session\Config\ConfigInterface' => 'Zend\Session\Service\SessionConfigFactory',
            'Zend\Session\Storage\StorageInterface' => 'Zend\Session\Service\SessionStorageFactory',
            'Zend\Session\ManagerInterface' => 'Zend\Session\Service\SessionManagerFactory',
            'App\Db\Connection' => 'App\Db\ConnectionFactory',
            'injector' => InjectorFactory::class,
            'ControllerManager' => ControllerManagerFactory::class,
            Connection::class => ConnectionFactory::class,
            AuthenticationService::class => AuthenticationServiceFactory::class,
            SessionConfig::class => SessionConfigFactory::class,
            Storage::class => StorageFactory::class,
        ],
        'abstract_factories' => [
            AbstractFactory::class,
        ],
        'aliases' => [
            'auth' => AuthenticationService::class,
        ],
    ],
    'dependencies' => [
        'abstract_factories' => [
            ConfigAbstractFactory::class,
        ],
    ],
    'session_config' => [
//        'remember_me_seconds' => 10000000000,
//        'remember_me_seconds' => 10,
//        'name' => 'gitAuth',
//        'cookie_httponly' => false,
//        'cookie_lifetime' => 10,
//        'cookie_lifetime' => 1000000000000,
        'save_path' => 'c:/devapps/php/php_sessions',
//        'use_cookies' => true,
    ],
    'session_storage' => [
        'type' => Storage::class,
        'options' => [], // Likely don't want to seed it
    ],
    'session_containers' => [
        'User',
    ],
    'gitDb' => require __DIR__ . '/database.config.php',
];
