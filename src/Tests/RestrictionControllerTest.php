<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 12:25
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use Adserver\Controllers\RestrictionController;

class RestrictionControllerTest extends DatabaseTestCase
{
    public function testSave()
    {
        $controller = new RestrictionController();
        $controller->post(['type' => 'interval', 'first_value' => '2016-11-18 10:00:00', 'second_value' => '2016-11-20 10:00:00']);
        $this->assertEquals(3, $this->getConnection()->getRowCount('restrictions'));
    }
}
