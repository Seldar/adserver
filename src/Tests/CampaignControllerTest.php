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
                    ['type' => 'interval', 'first_value' => '2016-11-18 10:00:00', 'second_value' => '2016-11-20 10:00:00']
                ],
                "banners" =>
                [
                    ['name' => "testName", 'caption' => "testCaption", "click_url" => "testClickUrl", "image_file" => "testImageFile", "size_x" => 100, "size_y" => 100]
                ]
            ]
        );

        $this->assertEquals(3, $this->getConnection()->getRowCount('campaigns'));
        $this->assertEquals(3, $this->getConnection()->getRowCount('banners'));
        $this->assertEquals(5, $this->getConnection()->getRowCount('restrictions'));
    }
}
