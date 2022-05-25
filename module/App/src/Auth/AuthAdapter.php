<?php
/**
 * Date: 1/23/2020
 * Time: 9:29 PM
 */

namespace App\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class AuthAdapter implements AdapterInterface
{
    private $credential;
    private $identity;


    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($dbAdaper, $identity, $credential)
    {
        $this->identity = $identity;
        $this->credential = $credential;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     */
    public function authenticate()
    {


    }
}