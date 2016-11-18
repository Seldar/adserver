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

use Adserver\Entities\Campaign;

class CampaignController extends Controller
{
    public function save(array $data, array $restrictions = [], array $banners = [])
    {
        $campaign = new Campaign();
        $campaign->setAll($data);

        foreach($restrictions as $restriction)
        {
            $campaign->addRestriction($restriction);
        }
        foreach($banners as $banner)
        {
            $campaign->addBanner($banner);
        }
        $this->entityManager->persist($campaign);
        $this->entityManager->flush();
    }
}