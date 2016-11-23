<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 15:01
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;


use Adserver\Controllers\CampaignController;

class CampaignControllerTest extends DatabaseTestCase
{

    public function testSave()
    {
        $controller = new CampaignController();

        $controller->post(
            [
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
            ]
        );

        $this->assertEquals(3, $this->getConnection()->getRowCount('campaigns'));
        $this->assertEquals(3, $this->getConnection()->getRowCount('banners'));
        $this->assertEquals(5, $this->getConnection()->getRowCount('restrictions'));
    }

    public function testPut()
    {
        $controller = new CampaignController();
        $result = $controller->put(["id" => 1, "status" => 0]);
        $this->assertInternalType("string", $result);
    }

    public function testDelete()
    {
        $controller = new CampaignController();
        $result = $controller->delete(1);
        $this->assertInternalType("string", $result);
    }

    public function testGet()
    {
        $controller = new CampaignController();
        $result = $controller->get([],1);
        $this->assertInternalType("array", $result);
    }

    public function testServeBanner()
    {
        $controller = new CampaignController();
        $_COOKIE["ad-req-cookie"] = 1;
        $_SERVER['HTTP_REFERER'] = "http://localhost/adserver/";
        $result = $controller->serveBanner("contentUnit", [0, 500, 0, 500]);

        $this->assertRegExp('/a href.*>.*<img.*>.*<div.*caption.*<.*>/is', $result);
    }
}
