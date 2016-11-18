<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 14:21
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;


abstract class Controller
{
    public $entityManager;

    public function __construct()
    {
        $this->entityManager = DoctrineController::get();
    }
}