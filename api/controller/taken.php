<?php
require_once "../../lib/autoload.php";
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskLoader = $container->getTaskLoader();
$apiController = $container->getApiController();
if($apiController->checkAuthentication("usernametest","pasw123"))
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


