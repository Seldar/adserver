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
 * @entity @Table(name="restrictions")
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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFirstValue(): string
    {
        return $this->first_value;
    }

    /**
     * @param string $first_value
     */
    public function setFirstValue(string $first_value)
    {
        $this->first_value = $first_value;
    }

    /**
     * @return string
     */
    public function getSecondValue(): string
    {
        return $this->second_value;
    }

    /**
     * @param string $second_value
     */
    public function setSecondValue(string $second_value)
    {
        $this->second_value = $second_value;
    }

    /**
     * @return Campaign
     */
    public function getCampaign(): Campaign
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

    public function setAll(array $data)
    {
        $this->setType($data['type']);
        $this->setFirstValue($data['first_value']);
        $this->setSecondValue($data['second_value']);
    }


}