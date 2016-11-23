<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 15:47
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use PHPUnit_Extensions_Database_TestCase;

class DatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{
    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    /**
     * Connecting to database
     *
     * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new \PDO('mysql:host=localhost;dbname=adserver',
                    'root',
                    '');
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, 'adserver');
        }

        return $this->conn;
    }

    /**
     * Creating fixture
     *
     * @return DbUnitArrayDataSet
     */
    final public function getDataSet()
    {
        return new DbUnitArrayDataSet(
            [
                'campaigns' => [
                    [
                        'id' => 1,
                        'name' => 'Test Name',
                        'status' => 1,
                        'goal' => 100,
                        'impression' => 50
                    ],
                    [
                        'id' => 2,
                        'name' => 'Test Name 2',
                        'status' => 0,
                        'goal' => 100,
                        'impression' => 100
                    ]
                ],
                'banners' => [
                    [
                        'id' => 1,
                        'name' => 'Test Name',
                        'caption' => 'Test Caption',
                        'click_url' => 'http://example.com',
                        'image_file' => 'http://example.com/example.png',
                        'size_x' => 100,
                        'size_y' => 100,
                        'campaign_id' => 1

                    ],
                    [
                        'id' => 2,
                        'name' => 'Test Name 2',
                        'caption' => 'Test Caption 2',
                        'click_url' => 'http://example2.com',
                        'image_file' => 'http://example2.com/example.png',
                        'size_x' => 200,
                        'size_y' => 200,
                        'campaign_id' => 1
                    ],
                ],
                'restrictions' => [
                    [
                        'id' => 1,
                        'type' => 'interval',
                        'first_value' => date("Y-m-d H:i:s", strtotime("-1 day")),
                        'second_value' => date("Y-m-d H:i:s", strtotime("+1 day")),
                        'campaign_id' => 1
                    ],
                    [
                        'id' => 2,
                        'type' => 'time-targeting',
                        'first_value' => "1:11-13,3:0-24,4:0-19,5:0-24,6:0-19,7:0-19",
                        'second_value' => "",
                        'campaign_id' => 1
                    ],
                    [
                        'id' => 3,
                        'type' => 'cookie-targeting',
                        'first_value' => "ad-req-cookie",
                        'second_value' => 1,
                        'campaign_id' => 1
                    ],
                    [
                        'id' => 4,
                        'type' => 'referrer-targeting',
                        'first_value' => "http://localhost/adserver/campaigns/1,http://example.com/test.php",
                        'second_value' => "allowhost.com,localhost",
                        'campaign_id' => 1
                    ]
                ]
            ]
        );
    }
    /*protected function getTearDownOperation()
    {
        return \PHPUnit_Extensions_Database_Operation_Factory::TRUNCATE();
    }*/
}