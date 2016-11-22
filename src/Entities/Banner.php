<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 13:00
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Entities;

/**
 * Class Banner
 *
 * @package Adserver\Entities
 *
 * @Entity(repositoryClass="Adserver\Repositories\BannerRepository") @Table(name="banners")
 */
class Banner
{
    /**
     * Primary unique identifier
     *
     * @var int
     *
     * @id @Column(type="integer") @GeneratedValue
     **/
    protected $id;

    /**
     * The name of the banner
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $name;

    /**
     * Caption of the banner
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $caption;

    /**
     * Url to go to when banner is clicked
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $click_url;

    /**
     * Image file location
     *
     * @var string
     *
     * @column(type="string", nullable=true)
     **/
    protected $image_file;

    /**
     * Size of the banner on x-axis
     *
     * @var int
     *
     * @column(type="integer")
     **/
    protected $size_x;

    /**
     * Size of the banner on y-axis
     *
     * @var int
     *
     * @column(type="integer")
     **/
    protected $size_y;

    /**
     * Campaign fk to identify which campaign this banner belongs to.
     *
     * @var Campaign
     *
     * @manyToOne(targetEntity="Campaign", inversedBy="addBanner",cascade={"persist"})
     **/
    protected $campaign;

    /**
     * Getter for id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for size_x
     *
     * @return int
     */
    public function getSizeX()
    {
        return $this->size_x;
    }

    /**
     * Setter for size_x
     *
     * @param int $size_x
     */
    public function setSizeX($size_x)
    {
        $this->size_x = $size_x;
    }

    /**
     * Getter for size_y
     *
     * @return mixed
     */
    public function getSizeY()
    {
        return $this->size_y;
    }

    /**
     * Setter for size_y
     *
     * @param int $size_y
     */
    public function setSizeY($size_y)
    {
        $this->size_y = $size_y;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     *
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Setter for caption
     *
     * @param $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * Getter for click_url
     *
     * @return string
     */
    public function getClickUrl()
    {
        return $this->click_url;
    }

    /**
     * Setter for click_url
     *
     * @param $click_url
     */
    public function setClickUrl($click_url)
    {
        $this->click_url = $click_url;
    }

    /**
     * Getter for image_file
     *
     * @return string
     */
    public function getImageFile()
    {
        return $this->image_file;
    }

    /**
     * Setter for image_file
     *
     * @param $image_file
     */
    public function setImageFile($image_file)
    {
        $this->image_file = $image_file;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }
}