<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 12:10
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Repositories;

use Doctrine\ORM\EntityRepository;
use Adserver\Entities\Restriction;

/**
 * Class RestrictionRepository
 *
 * Repository to handle database operations through entities
 *
 * @package Adserver\Repositories
 */
class RestrictionRepository extends EntityRepository
{
    /**
     * Set and persist Restriction entity in the database
     *
     * @param array $data
     *
     * @return Restriction
     */
    public function save(array $data)
    {
        $restriction = $this->setAll($data);
        $this->_em->persist($restriction);
        $this->_em->flush();
        return $restriction;
    }

    /**
     * Setter for all columns with an array
     *
     * @param array $data
     *
     * @return Restriction
     */
    public function setAll(array $data)
    {
        $restriction = new Restriction();
        $restriction->setType($data['type']);
        $restriction->setFirstValue($data['first_value']);
        $restriction->setSecondValue($data['second_value']);
        return $restriction;
    }

    /**
     * Set and persist Restriction entity
     *
     * @param array $data
     */
    public function edit(array $data)
    {
        $restriction = $this->_em->getRepository('Adserver\Entities\Restriction')->findOneBy(["id" => $data['id']]);
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);
            if ($key != "id") {
                $restriction->$method($value);
            }
        }
        $this->_em->persist($restriction);
        $this->_em->flush();
    }

    /**
     * Evaluate if the given restriction is passed
     *
     * @param Restriction $restriction
     *
     * @return bool
     */
    public function evaluate(Restriction $restriction)
    {
        $weekday = date("w") + 1;
        $hour = date("G");
        $firstValue = $restriction->getFirstValue();
        $secondValue = $restriction->getSecondValue();
        switch ($restriction->getType()) {
            case "interval":
                if (strtotime($firstValue) <= time() && time() <= strtotime($secondValue)) {
                    return true;
                }
                break;
            case "time-targeting":
                $allowedDaysHours = explode(",", $firstValue);
                foreach ($allowedDaysHours as $daysHours) {
                    $daysHour = explode(":", $daysHours);
                    $day = $daysHour[0];
                    $hours = [];
                    if (isset($daysHour[1])) {
                        $hours = explode("-", $daysHour[1]);
                    }
                    if ($weekday == $day) {
                        if (count($hours) == 0 || (count($hours) > 0 && $hour >= $hours[0] && $hour <= $hours[1])) {
                            return true;
                        }
                    }
                }
                break;
            case "cookie-targeting":
                if (isset($_COOKIE[$firstValue]) && $_COOKIE[$firstValue] == $secondValue) {
                    return true;
                }
                break;
            case "referrer-targeting":
                if (!isset($_SERVER['HTTP_REFERER']))
                    return false;
                $referrers = explode(",", $firstValue);
                if (in_array($_SERVER['HTTP_REFERER'], $referrers)) {
                    return true;
                }
                $referrer = parse_url($_SERVER['HTTP_REFERER']);
                $hostReferrers = explode(",", $secondValue);
                if (in_array($referrer['host'], $hostReferrers)) {
                    return true;
                }
        }
        return false;

    }
}