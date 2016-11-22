<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 12:05
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Repositories;

use Doctrine\ORM\EntityRepository;
use Adserver\Entities\Banner;

class BannerRepository extends EntityRepository
{
    public function save(array $data)
    {
        $banner = $this->setAll($data);

        $uploads_dir = 'storage/images';

        if (isset($_FILES["image_file"]) && $_FILES["image_file"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["image_file"]["tmp_name"];
            $name = $_FILES["image_file"]["name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $banner->setImageFile($name);
        }

        $this->_em->persist($banner);
        $this->_em->flush();
        return $banner;
    }

    /**
     * Setter for all columns with an array
     *
     * @param array $data
     *
     * @return Banner
     */
    public function setAll(array $data)
    {
        $banner = new Banner();
        $banner->setName($data["name"]);
        $banner->setCaption($data["caption"]);
        $banner->setClickUrl($data["click_url"]);
        $banner->setSizeX($data["size_x"]);
        $banner->setSizeY($data["size_y"]);
        return $banner;

    }

    public function edit(array $data)
    {
        $banner = $this->_em->getRepository('Adserver\Entities\Banner')->findOneBy(["id" => $data['id']]);
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if ($key != "id") {
                $banner->$method($value);
            }
        }
        $this->_em->persist($banner);
        $this->_em->flush();
    }

    public function checkSize(Banner $banner, $sizeRanges)
    {
        if ($banner->getSizeX() >= $sizeRanges[0] && $banner->getSizeX() <= $sizeRanges[1] && $banner->getSizeY() >= $sizeRanges[2] && $banner->getSizeY() <= $sizeRanges[3]) {
            return true;
        }
        return false;
    }

}