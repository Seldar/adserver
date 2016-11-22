<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 16:53
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineController
{
    public static function get()
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);

        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_mysql',
            'dbname' => 'adserver',
            'user' => 'root',
            'password' => '',
            'host' => '127.0.0.1',
        );

        // obtaining the entity manager
        return EntityManager::create($conn, $config);
    }
}