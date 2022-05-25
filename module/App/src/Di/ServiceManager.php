<?php
/**
 * Date: 2/24/2020
 * Time: 8:09 PM
 */

namespace App\Di;

use Interop\Container\ContainerInterface;

class ServiceManager extends \Zend\ServiceManager\ServiceManager
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Injector
     */
    protected $injector;

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $name
     * @return mixed|void
     * @throws \ReflectionException
     */
    public function get($name)
    {
        $object = parent::get($name);
        if ($object instanceof InjectableInterface) {
            $this->getInjector()->injectAnnotations($object);
        }
    }

    /**
     * @param mixed $container
     * @return ServiceManager
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    private function getInjector()
    {
        if (!isset($this->injector)) {
            $this->injector = $this->container->get('injector');
        }
        return $this->injector;
    }


}