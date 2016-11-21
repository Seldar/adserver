<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 17:01
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use Adserver\Controllers\BannerController;

class BannerControllerTest extends DatabaseTestCase
{
    public function testSave()
    {
        $controller = new BannerController();
        $controller->post(['name' => "testName", 'caption' => "testCaption", "click_url" => "testClickUrl", "image_file" => "testImageFile", "size_x" => 100, "size_y" => 100]);
        $this->assertEquals(3, $this->getConnection()->getRowCount('banners'));
    }
}
