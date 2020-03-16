<?php
require_once "../lib/autoload.php";
//$serverMethod = $_SERVER['REQUEST_METHOD'];
//$fullUrl = explode("/",$_SERVER['REQUEST_URI']);
//$arrayLength = count($fullUrl);
//var_dump($fullUrl[$arrayLength-1]);
//var_dump($fullUrl[$arrayLength-2]);


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $response = new Response();
    $response->setsuccess(true);
    $response->setHttpStatusCode(500);
    $response->addMessage('joepie');
    $response->send();

}

