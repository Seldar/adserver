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

class CampaignController extends Controller
{
    public function post(array $data = null)
    {
        $restrictions = [];
        $banners = [];
        foreach ($data['restrictions'] as $restriction) {
            $restrictions[] = $this->entityManager->getRepository('Adserver\Entities\Restriction')->save(
                [
                    "type" => $restriction['type'],
                    "first_value" => $restriction['first_value'],
                    "second_value" => $restriction['second_value']
                ]
            );
        }

        foreach ($data['banners'] as $banner) {
            $banners[] = $this->entityManager->getRepository('Adserver\Entities\Banner')->save(
                [
                    "name" => $banner['name'],
                    "caption" => $banner['caption'],
                    "click_url" => $banner['click_url'],
                    "image_file" => $banner['image_file'],
                    "size_x" => $banner['size_x'],
                    "size_y" => $banner['size_y']
                ]
            );
        }
        $this->entityManager->getRepository('Adserver\Entities\Campaign')->save($data, $restrictions, $banners);
        return "campaignAdded.tpl.php";
    }

    public function put(array $data = null)
    {
        $this->entityManager->getRepository('Adserver\Entities\Campaign')->edit($data);
        return "campaignEdited.tpl.php";
    }

    public function get(array $input,$key)
    {
        if($key)
        {
            $data = $this->entityManager->getRepository('Adserver\Entities\Campaign')->findOneBy(["id" => $key]);
            return ["campaignView.tpl.php",$data];
        }
        else
        {
            return "campaignForm.tpl.php";
        }
    }
}