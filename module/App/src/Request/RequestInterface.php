<?php
/**
 * Date: 2/2/2020
 * Time: 8:26 PM
 */

namespace App\Request;


interface RequestInterface extends \Zend\Stdlib\RequestInterface
{
    public function getMethod();

    public function getUri();

    public function getQuery($name = null, $default = null);

    public function getPost($name = null, $default = null);

    public function getCookie();

    public function getFiles($name = null, $default = null);

    public function getHeader($name, $default = false);

    public function isPost();

    public function isXmlHttpRequest();

}