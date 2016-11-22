<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 22.11.2016
 * Time: 11:26
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

include "vendor/autoload.php";

$range_x1 = (int)$_GET['x1'];
$range_x2 = (int)$_GET['x2'];
$range_y1 = (int)$_GET['y1'];
$range_y2 = (int)$_GET['y2'];
$contentUnit = $_GET['contentUnit'];

$campaign = new \Adserver\Controllers\CampaignController();
echo $campaign->serveBanner($contentUnit, [$range_x1, $range_x2, $range_y1, $range_y2]);