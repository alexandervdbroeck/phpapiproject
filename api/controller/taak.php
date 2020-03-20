<?php
require_once "../../lib/autoload.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskLoader = $container->getTaskLoader();
$apiController = $container->getApiController();
if($apiController->checkAuthentication("username","123"))
{
    switch ($requestMethod)
    {
        case "PUT":
            $taskLoader->procesApiUpdateTaskById($_GET['taakid']);

            break;

        case "GET":
            $taskLoader->procesApiGetTaskById($_GET['taakid']);
            break;

        case "DELETE":
            $taskLoader->procesApiDeleteTaskById($_GET['taakid']);
            break;

    }

}

