<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 21.11.2016
 * Time: 12:34
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Controllers;


class RESTControler
{
    public function route()
    {

        // get the HTTP method, path and body of the request
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode('/', trim($_GET['path'], '/'));
        if ($_POST) {
            $input = $_POST;
        } else {
            parse_str(file_get_contents("php://input"), $input);
        }
        // retrieve the table and key from the path
        $table = preg_replace('/[^a-z0-9_]+/i', '', array_shift($request));
        $key = array_shift($request) + 0;

        // escape the columns and values from the input object
        switch ($table) {
            case "campaigns":
                $controller = new CampaignController();
                break;
            case "banners":
                $controller = new BannerController();
                break;
            case "restrictions":
                $controller = new RestrictionController();
                break;
            default:
                $controller = null;
        }
        return $controller->{strtolower($method)}($input, $key);
    }
}