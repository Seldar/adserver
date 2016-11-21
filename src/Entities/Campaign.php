<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 11:17
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Campaign
 *
 * @package Adserver\Entities
 *
 * @entity(repositoryClass="Adserver\Repositories\CampaignRepository") @Table(name="campaigns")
 */
class Campaign
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
     * The name of the campaign
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $name;

    /**
     * Current status of the campaign
     *
     * @var boolean
     *
     * @column(type="boolean")
     **/
    protected $status;

    /**
     * Impression goal of the whole campaign
     *
     * @var int
     *
     * @column(type="integer")
     **/
    protected $goal;

    /**
     * Current Impression of the banners of the campaign
     *
     * @var int
     *
     * @column(type="integer", options={"default":0})
     **/
    protected $impression;

    /**
     * Banner of the campaign
     *
     * @var Banner[]
     *
     * @oneToMany(targetEntity="Banner", mappedBy="campaign",cascade={"persist"})
     **/
    protected $banners;

    /**
     * Restrictions to apply before showing the campaign banners
     *
     * @var Restriction[]
     *
     * @oneToMany(targetEntity="Restriction", mappedBy="campaign",cascade={"persist"})
     **/
    protected $restrictions;

    /**
     * Campaign constructor.
     */
    public function __construct()
    {
        $this->banners = new ArrayCollection();
        $this->restrictions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * @param int $goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
    }

    /**
     * @return int
     */
    public function getImpression()
    {
        return $this->impression;
    }

    /**
     * @param int $impression
     */
    public function setImpression($impression)
    {
        $this->impression = $impression;
    }

    /**
     * @return mixed
     */
    public function getBanners()
    {
        return $this->banners;
    }

    /**
     * @param Banner $banner
     */
    public function addBanner(Banner $banner = null)
    {
        if (is_object($banner)) {
            $banner->setCampaign($this);
            $this->banners[] = $banner;
        }
    }

    /**
     * @return mixed
     */
    public function getRestrictions()
    {
        return $this->restrictions;
    }

    /**
     * @param Restriction $restriction
     */
    public function addRestriction(Restriction $restriction = null)
    {
        if ($restriction) {
            $restriction->setCampaign($this);
            $this->restrictions[] = $restriction;
        }
    }
}