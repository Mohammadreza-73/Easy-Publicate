<?php

use Samoon\App\Helpers\Config;
use Samoon\App\Helpers\Response;
use Samoon\App\Services\ScholarService;

require_once realpath("../../../vendor/autoload.php");

$userId = $_GET['user'] ?? null;
$url = 'https://scholar.google.com/citations?user=' . $userId;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$scholar = new ScholarService($url);
$methods = Config::get('scholar', 'methods');

switch ($requestMethod) {
    case 'GET':
        if (! isset($userId) )
            Response::respondAndDie(['Invalid Parameter'], Response::HTTP_NOT_FOUND);
            
        foreach ($methods as $method => $value) {
            if ( $value ) {
                $response = $scholar->{$method}();
                echo Response::respondAndDie($response);
            }
        }

        $response = $scholar->getData();
        echo Response::respondAndDie($response);

    default:
        Response::respondAndDie(['Method not allowed'], Response::HTTP_METHOD_NOT_ALLOWED);
}