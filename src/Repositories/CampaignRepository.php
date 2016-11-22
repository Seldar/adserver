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
use Adserver\Entities\Banner;

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

    public function getValidBanners($contentUnit, array $sizeRanges = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from('Adserver\Entities\Campaign', 'c')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('c.status', 1),
                $qb->expr()->gt('c.goal', 'c.impression')
            ));
        $query = $qb->getQuery();
        $result = $query->getArrayResult();
        $bannerCollection = $this->checkFilters($result, $sizeRanges);
        if(count($bannerCollection) > 0) {
            $banner = $this->pickBanner($bannerCollection);
            $this->increaseImpression($banner);

            return $this->createHTML($banner, $contentUnit);

        }
        else
        {
            return "<div>No banners found!</div>";
        }
    }

    public function checkFilters($result, array $sizeRanges = null)
    {
        $bannerCollection = [];
        foreach ($result as $campaign) {
            $data = $this->_em->getRepository('Adserver\Entities\Campaign')->findOneBy(["id" => $campaign['id']]);
            $restrictions = $data->getRestrictions();
            $failed = 0;
            foreach ($restrictions as $restriction) {
                if (!$this->_em->getRepository('Adserver\Entities\Restriction')->evaluate($restriction)) {
                    $failed = 1;
                    break;
                }
            }

            if (!$failed) {
                $banners = $data->getBanners();
                foreach ($banners as $banner) {
                    if ($this->_em->getRepository('Adserver\Entities\Banner')->checkSize($banner, $sizeRanges)) {
                        $bannerCollection[] = $banner;
                    }
                }
            }
        }
        count($bannerCollection);
        return $bannerCollection;
    }

    public function increaseImpression(Banner $banner)
    {
        $campaign = $banner->getCampaign();
        $campaign->setImpression($campaign->getImpression() + 1);
        $this->_em->persist($campaign);
        $this->_em->flush();
    }

    public function pickBanner($bannerCollection)
    {
        return $bannerCollection[array_rand($bannerCollection)];
    }

    public function createHTML(Banner $banner, $contentUnit)
    {
        return '<a href="' . $banner->getClickUrl() . '">
                        <img style="width:' . $banner->getSizeX() . 'px;height:' . $banner->getSizeY() . 'px;" src="storage/images/' . $banner->getImageFile() . '" />
                        <div class="caption">' . $banner->getCaption() . '</div>
                </a>';
    }
}