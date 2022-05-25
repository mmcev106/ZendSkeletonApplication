<?php
/**
 * Date: 1/21/2020
 * Time: 10:24 PM
 */

namespace App;

use Zend\ServiceManager\Di\ConfigProvider;

class Module
{
    const VERSION = '1';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    /**
     * Return configuration for zend-mvc applications.
     *
     * @return array
     */
    public function getServiceConfig()
    {
        $provider = new ConfigProvider();
        return [
            'service_manager' => $provider->getDependencyConfig(),
        ];
    }
}