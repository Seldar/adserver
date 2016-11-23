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

/**
 * Class BannerRepository
 *
 * Repository to handle database operations through entities
 *
 * @package Adserver\Repositories
 */
class BannerRepository extends EntityRepository
{
    /**
     * Set and persist Banner entity in the database
     *
     * @param array $data
     *
     * @return Banner
     */
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

    /**
     * Set and persist Banner entity
     *
     * @param array $data
     */
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

    /**
     * Removes the entity from database
     *
     * @param int $key
     */
    public function delete($key)
    {
        $banner = $this->find($key);
        $this->_em->remove($banner);
        $this->_em->flush();
    }

    /**
     * Checks the size of banner against the given size range
     *
     * @param Banner $banner
     * @param array $sizeRanges
     *
     * @return bool
     */
    public function checkSize(Banner $banner, array $sizeRanges)
    {
        if ($banner->getSizeX() >= $sizeRanges[0] && $banner->getSizeX() <= $sizeRanges[1] && $banner->getSizeY() >= $sizeRanges[2] && $banner->getSizeY() <= $sizeRanges[3]) {
            return true;
        }
        return false;
    }

}