<?php
/**
 * Date: 2/24/2020
 * Time: 8:22 PM
 */

namespace App\Di;


use Interop\Container\ContainerInterface;

class Injector
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Injector constructor.
     * @param ContainerInterface $container
     */
    public function __construct($container = null)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @return mixed
     * @throws \Exception
     */
    public function getInstance($className)
    {
        if (class_exists($className)) {
            $classObject = $this->container->get($className);
            return $this->injectAnnotations($classObject);
        }
        throw  new \Exception('Class not found for injection: ' . $className);
    }

    private function init(&$classObject)
    {
        if ($classObject instanceof InitializableInterface) {
            $classObject->init();
        }
        if ($classObject instanceof ContainerAwareInterface) {
            $classObject->setContainer($this->container);
        }
    }

    /**
     * @param $classObject
     * @return mixed
     * @throws \ReflectionException
     */
    public function injectAnnotations(&$classObject)
    {
        $className = get_class($classObject);
        $reflectionClass = new \ReflectionClass($className);
        $classProperties = $reflectionClass->getProperties();
        foreach ($classProperties as $property) {
            $propertyComment = $property->getDocComment();
            if (strpos($propertyComment, '@Inject')) {
                $annotationArr = explode("\"", $propertyComment);
                $injectionClass = $annotationArr[1];
                if (class_exists($injectionClass)) {
                    $injectionClassInstance = $this->getInstance($injectionClass);
                }
                elseif ($this->container->has($injectionClass)) {
                    $injectionClassInstance = $this->container->get($injectionClass);
                }
                else {
                    throw  new \Exception('Class not found for property injection: ' . $className);
                }

                $propertyName = $property->getName();
                $setterMethod = 'set' . $propertyName;
                if (method_exists($classObject, $setterMethod)) {
                    $classObject->{$setterMethod}($injectionClassInstance);
                    continue;
                } else {
                    throw  new \Exception('Setter missing for class property injection: ' . $className . ':' . $setterMethod);
                }
            }
        }
        $this->init($classObject);
        return $classObject;
    }
}