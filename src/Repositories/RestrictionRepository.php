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

class RestrictionRepository extends EntityRepository
{
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
}