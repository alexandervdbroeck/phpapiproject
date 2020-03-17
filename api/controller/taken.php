<?php
require_once "../../lib/autoload.php";
$taakId = isset($_GET['taakid']) ?$_GET['taakid']: null;
$requestMethod = $_SERVER['REQUEST_METHOD'];
$taskLoader = $container->getTaskLoader();

switch ($requestMethod)
{
    case "POST":
        $taskLoader->procesApiCreateNewtask();
        break;

    case "GET":
        $taskLoader->procesApiGetAllTasks();
        break;
}

