<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 12:51
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'dbname' => 'adserver',
    'user' => 'root',
    'password' => '',
    'host' => '127.0.0.1',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);