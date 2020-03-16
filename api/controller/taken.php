<?php
require_once "../../lib/autoload.php";
$taakId = $_GET['taakid'];

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $taskService = $container->getTaskLoader();
    $tasks = $taskService->queryForTasks();
    $response = new Response();
    $response->setsuccess(true);
    $response->setHttpStatusCode(500);
    $response->addMessage('all tasks');
    $response->setData($tasks);
    $response->send();
}elseif($_SERVER['REQUEST_METHOD'] == "GET")
{    $response = new Response();
    $response->setsuccess(true);
    $response->setHttpStatusCode(500);
    $response->addMessage('GET REQUest');
    $response->send();

}
