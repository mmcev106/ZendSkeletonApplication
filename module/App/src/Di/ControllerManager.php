<?php
/**
 * Date: 2/24/2020
 * Time: 8:22 PM
 */

namespace App\Di;

use Interop\Container\ContainerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\Stdlib\DispatchableInterface;

class ControllerManager extends \Zend\Mvc\Controller\ControllerManager
{

    /**
     * Constructor
     *
     * Injects an initializer for injecting controllers with an
     * event manager and plugin manager.
     *
     * @param $configOrContainerInstance
     * @param  array $config
     */
    public function __construct($configOrContainerInstance, array $config = [])
    {
        $this->addInitializer([$this, 'injectAnnotations']);
        parent::__construct($configOrContainerInstance, $config);
    }


    /**
     * Initializer: inject plugin manager
     *
     * @param ContainerInterface $container
     * @param DispatchableInterface $controller
     * @throws \ReflectionException
     */
    public function injectAnnotations(ContainerInterface &$container, $controller)
    {
        if (method_exists($controller, 'setContainer')) {
            $controller->setContainer($container);
        }
        /** @var Injector $injector */
        $injector = $container->get('injector');
        $injector->injectAnnotations($controller);
    }

}