<?php

namespace App\Auth;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\Config\SessionConfig;

/**
 * Date: 3/1/2020
 * Time: 10:25 PM
 */
class AuthenticationServiceFactory implements FactoryInterface
{


    /**
     * Create an object
     *
     * @param  \Interop\Container\ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException if unable to resolve the service.
     * @throws \Zend\ServiceManager\Exception\ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws \Interop\Container\Exception\ContainerException if any other error occurs
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $sessionConfig = $container->get(SessionConfig::class);
        $storage = $container->get(Storage::class);
        $sessionManager = new \Zend\Session\SessionManager($sessionConfig, $storage);
        return new AuthenticationService(new Session('gitAuth', 'session_auth', $sessionManager));

    }
}