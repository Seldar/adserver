<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 13:01
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */
include "vendor/autoload.php";
$rootUrl = basename(__DIR__) ;
$rest = new \Adserver\Controllers\RESTControler();
$view = $rest->route();
if (is_array($view)) {
    $data = $view[1];
    include "src/Views/" . $view[0];
} elseif ($view) {
    include "src/Views/" . $view;
}
