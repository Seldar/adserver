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

/**
 * Class CampaignController
 *
 * Handles campaign operations
 *
 * @package Adserver\Controllers
 */
class CampaignController extends Controller
{
    /**
     * Post new campaign resource
     *
     * @param array|null $data
     *
     * @return string
     */
    public function post(array $data = null)
    {
        $restrictions = [];
        $banners = [];

        foreach ($data['restrictions'] as $restriction) {
            $restriction = json_decode($restriction, true);
            $restrictions[] = $this->entityManager->getRepository('Adserver\Entities\Restriction')->save(
                [
                    "type" => $restriction['type'],
                    "first_value" => $restriction['first_value'],
                    "second_value" => $restriction['second_value']
                ]
            );
        }

        foreach ($data['banners'] as $banner) {
            $banner = json_decode($banner, true);
            $banners[] = $this->entityManager->getRepository('Adserver\Entities\Banner')->save(
                [
                    "name" => $banner['name'],
                    "caption" => $banner['caption'],
                    "click_url" => $banner['click_url'],
                    "size_x" => $banner['size_x'],
                    "size_y" => $banner['size_y']
                ]
            );
        }
        $this->entityManager->getRepository('Adserver\Entities\Campaign')->save($data, $restrictions, $banners);
        return "campaignAdded.tpl.php";
    }

    /**
     * Put (update) campaign resource
     *
     * @param array|null $data
     *
     * @return string
     */
    public function put(array $data = null)
    {
        $this->entityManager->getRepository('Adserver\Entities\Campaign')->edit($data);
        return "campaignEdited.tpl.php";
    }

    /**
     * Get campaing resource by id
     *
     * @param array $input
     * @param $key
     *
     * @return array|string
     */
    public function get(array $input, $key)
    {
        if ($key) {
            $data = $this->entityManager->getRepository('Adserver\Entities\Campaign')->findOneBy(["id" => $key]);
            return ["campaignView.tpl.php", $data];
        } else {
            return "campaignForm.tpl.php";
        }
    }

    /**
     * Delete campaign resource along with all related resources
     *
     * @param int $key
     *
     * @return string
     */
    public function delete($key)
    {
        $this->entityManager->getRepository('Adserver\Entities\Campaign')->delete($key);
        return "campaignDeleted.tpl.php";
    }

    /**
     * Returns random valid banner element to publishers
     *
     * @param string $contentUnit
     * @param array|null $sizeRanges
     *
     * @return string
     */
    public function serveBanner($contentUnit, array $sizeRanges = null)
    {
        $banner = $this->entityManager->getRepository('Adserver\Entities\Campaign')->getValidBanners($contentUnit, $sizeRanges);
        return $banner;

    }
}