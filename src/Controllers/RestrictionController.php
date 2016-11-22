<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 12:24
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;


/**
 * Class RestrictionController
 *
 * Handles restriction operations
 *
 * @package Adserver\Controllers
 */
class RestrictionController extends Controller
{
    /**
     * Post new restriction resource
     *
     * @param array $data
     */
    public function post(array $data)
    {
        $this->entityManager->getRepository('Adserver\Entities\Restriction')->save($data);
    }
}