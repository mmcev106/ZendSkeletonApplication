<?php
/**
 * Date: 2/2/2020
 * Time: 8:32 PM
 */

namespace App\Di;


use Interop\Container\ContainerInterface;

interface ContainerAwareInterface
{

    public function setContainer(ContainerInterface $container);
}