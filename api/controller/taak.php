<?php
require_once "../../lib/autoload.php";
$taakId = isset($_GET['taakid']) ?$_GET['taakid']: null;
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskloader = $container->getTaskLoader();

switch ($requestMethod)
{
    case "PUT":

        break;

    case "GET":
        $taskloader->procesApiGetTaskById($taakId);
        break;

    case "DELETE":


}
