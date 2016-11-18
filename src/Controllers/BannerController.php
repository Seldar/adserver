<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 16:55
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;

use Adserver\Entities\Banner;

class BannerController extends Controller
{
    public function save(array $data)
    {
        $banner = new Banner();
        $banner->setAll($data);

        $this->entityManager->persist($banner);
        $this->entityManager->flush();
    }
}