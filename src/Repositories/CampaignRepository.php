<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 11:55
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Repositories;

use Doctrine\ORM\EntityRepository;
use Adserver\Entities\Campaign;

class CampaignRepository extends EntityRepository
{
    public function save(array $data, array $restrictions = [], array $banners = [])
    {

        $campaign = $this->setAll($data);

        foreach ($restrictions as $restriction) {
            $campaign->addRestriction($restriction);
        }

        foreach ($banners as $banner) {
            $campaign->addBanner($banner);
        }
        $this->_em->persist($campaign);
        $this->_em->flush();

    }

    public function setAll(array $data)
    {
        $campaign = new Campaign();
        $campaign->setName($data['name']);
        $campaign->setStatus($data['status']);
        $campaign->setGoal($data['goal']);
        $campaign->setImpression($data['impression']);
        return $campaign;
    }

    public function edit(array $data)
    {
        $campaign = $this->_em->getRepository('Adserver\Entities\Campaign')->findOneBy(["id" => $data['id']]);
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if ($key != "id") {
                $campaign->$method($value);
            }
        }
        $this->_em->persist($campaign);
        $this->_em->flush();
    }
}