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


/**
 * Class Controller
 *
 * Abstract Class to provide entity manager to children
 *
 * @package Adserver\Controllers
 */
abstract class Controller
{
    /**
     * EntityManager of Doctrine ORM
     *
     * @var \Doctrine\ORM\EntityManager
     */
    public $entityManager;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->entityManager = DoctrineController::get();
    }
}