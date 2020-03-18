<?php
require_once "../../lib/autoload.php";
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

