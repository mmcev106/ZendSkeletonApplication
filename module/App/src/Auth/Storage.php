<?php
/**
 * Date: 1/23/2020
 * Time: 10:01 PM
 */

namespace App\Auth;

use Zend\Authentication\Storage\StorageInterface;
use Zend\Session\Storage\SessionStorage;

class Storage extends SessionStorage implements StorageInterface
{

    protected $data = [];

    /**
     * Returns true if and only if storage is empty
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If it is impossible to
     *               determine whether storage is empty
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If reading contents from storage is impossible
     * @return mixed
     */

    public function read()
    {
        return $this->data;
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If writing $contents to storage is impossible
     * @return void
     */

    public function write($contents)
    {
        $this->data = $contents;
    }

    /**
     * Clears contents from storage
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If clearing contents from storage is impossible
     * @return void
     */

    public function clear($key = null)
    {
        if ($key) {
            unset($this->data[$key]);
        }else{
            $this->data = [];
        }
    }
}