<?php
require_once "../../lib/autoload.php";
$taakId = isset($_GET['taakid']) ?$_GET['taakid']: null;
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskloader = $container->getTaskLoader();
$apiController = $container->getApiController();
if($apiController->checkAuthentication("usernametest","pasw123"))
{
    switch ($requestMethod)
    {
        case "PUT":
            $taskloader->procesApiUpdateTaskById($taakId);

            break;

        case "GET":
            $taskloader->procesApiGetTaskById($taakId);
            break;

        case "DELETE":
            $taskloader->procesApiDeleteTaskById($taakId);
            break;

    }

}

