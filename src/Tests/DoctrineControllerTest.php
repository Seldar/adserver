<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 23.11.2016
 * Time: 10:51
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use Adserver\Controllers\DoctrineController;

class DoctrineControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $controller = new DoctrineController();
        $this->assertInstanceOf('Doctrine\ORM\EntityManager',$controller->get());
    }
}
