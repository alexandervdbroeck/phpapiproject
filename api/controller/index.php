<?php
require_once "../../lib/autoload.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$uriParts = explode("/", $_SERVER['REQUEST_URI']);

$count = count($uriParts);

$lastUriPart = $uriParts[$count-1];
$secondToLastUriPart = $uriParts[$count-2];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskLoader = $container->getTaskLoader();
$apiController = $container->getApiController();
//if($apiController->checkAuthentication("username","123"))
//{
//    switch ($requestMethod)
//    {
//        case "POST":
//            $taskLoader->procesApiCreateNewtask();
//            break;
//
//        case "GET":
//            $taskLoader->procesApiGetAllTasks();
//            break;
//    }
//}
if ($lastUriPart === 'taken') {
    if($apiController->checkAuthentication("username","123"))
    {
        switch ($requestMethod)
        {
            case "POST":
                $taskLoader->procesApiCreateNewtask();
                break;

            case "GET":
                $taskLoader->procesApiGetAllTasks();
                break;
        }
    }
}

elseif ($secondToLastUriPart === 'taak') {
    if($apiController->checkAuthentication("username","123"))
    {
        switch ($requestMethod)
        {
            case "PUT":
                $taskLoader->procesApiUpdateTaskById($lastUriPart);

                break;

            case "GET":
                $taskLoader->procesApiGetTaskById($lastUriPart);
                break;

            case "DELETE":
                $taskLoader->procesApiDeleteTaskById($lastUriPart);
                break;

        }

    }
}
