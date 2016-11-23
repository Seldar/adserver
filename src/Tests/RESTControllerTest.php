<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 23.11.2016
 * Time: 11:36
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use Adserver\Controllers\RESTController;

class RESTControllerTest extends DatabaseTestCase
{
    public function testRoute()
    {
        $_SERVER['REQUEST_METHOD'] = "GET";
        $_GET['path'] = "campaigns/1";
        $controller = new RESTController();
        $result = $controller->route();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) == 2);
        $this->assertInstanceOf('Adserver\Entities\Campaign',$result[1]);

        $_SERVER['REQUEST_METHOD'] = "POST";
        $_GET['path'] = "campaigns";
        $_POST =  [
            'name' => "testName",
            'status' => true,
            "goal" => 50,
            "impression" => 0,
            "restrictions" =>
                [
                    '{"type":"interval", "first_value":"2016-11-18 10:00:00", "second_value":"2016-11-20 10:00:00"}'
                ],
            "banners" =>
                [
                    '{"name":"testName", "caption":"testCaption", "click_url":"testClickUrl", "size_x":100, "size_y":100}'
                ]
        ];
        $controller = new RESTController();
        $result = $controller->route();
        $this->assertInternalType('string', $result);

        $_SERVER['REQUEST_METHOD'] = "GET";
        $_GET['path'] = "banners/1";
        $controller = new RESTController();
        $result = $controller->route();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) == 2);
        $this->assertInstanceOf('Adserver\Entities\Banner',$result[1]);

        $_SERVER['REQUEST_METHOD'] = "GET";
        $_GET['path'] = "campaigns";
        $controller = new RESTController();
        $result = $controller->route();
        $this->assertInternalType('string', $result);
    }
}
