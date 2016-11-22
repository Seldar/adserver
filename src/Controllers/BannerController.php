<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 16:55
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;

class BannerController extends Controller
{
    public function post(array $data)
    {
        $this->entityManager->getRepository('Adserver\Entities\Banner')->save($data);
    }

    public function get(array $input, $key)
    {
        if ($key) {
            $data = $this->entityManager->getRepository('Adserver\Entities\Banner')->findOneBy(["id" => $key]);
            return ["bannerView.tpl.php", $data];
        } else {
            return "bannerForm.tpl.php";
        }
    }
}