<?php
/**
 * Date: 1/30/2020
 * Time: 11:20 PM
 */

namespace App\Di;


interface InitializableInterface
{

    /**
     * @return mixed
     */
    public function init();

}