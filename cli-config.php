<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 17.11.2016
 * Time: 12:55
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);