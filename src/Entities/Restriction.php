<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 13:28
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Entities;

/**
 * Class Resctriction
 *
 * @package Adserver\Entities
 *
 * @entity(repositoryClass="Adserver\Repositories\RestrictionRepository") @Table(name="restrictions")
 */
class Restriction
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
     * The type of the restriction (interval, time-targeting, cookie-targeting, referrer targeting)
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $type;

    /**
     * First value for restriction (i.e. start date)
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $first_value;

    /**
     * Second value for restriction (i.e. end date)
     *
     * @var string
     *
     * @column(type="string")
     **/
    protected $second_value;

    /**
     * Campaign to be restricted
     *
     * @var Campaign
     *
     * @manyToOne(targetEntity="Campaign", inversedBy="addRestriction",cascade={"persist"})
     **/
    protected $campaign;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFirstValue()
    {
        return $this->first_value;
    }

    /**
     * @param string $first_value
     */
    public function setFirstValue($first_value)
    {
        $this->first_value = $first_value;
    }

    /**
     * @return string
     */
    public function getSecondValue()
    {
        return $this->second_value;
    }

    /**
     * @param string $second_value
     */
    public function setSecondValue($second_value)
    {
        $this->second_value = $second_value;
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