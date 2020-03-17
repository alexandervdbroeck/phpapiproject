<?php

class TaskLoader
{
    private $databaseService;
    private $response;

    public function __construct(DatabaseService $databaseService, Response $response)
    {
        $this->databaseService = $databaseService;
        $this->response = $response;
    }

    /**
     * @param $date
     * @return City[]
     */

    public function getTaskById($id)
    {
        $task = $this->databaseService->getData('SELECT * FROM taak where taa_id ='.$id);
        return $task[0];
    }


    public function getTasks()
    {
        $tasksData = $this->queryForTasks();

        $tasks = array();
        foreach ($tasksData as $taskData) {
            $tasks[] = $this->createTaskFromData($taskData);
        }

        return $tasks;
    }

    /**
     * @param array $taskData
     * @return Task
     */
    private function createTaskFromData(array $taskData)
    {
        $task = new Task();
        $task->setId($taskData['taa_id']);
        $task->setDatum($taskData['taa_datum']);
        $task->setOmschr($taskData['taa_omschr']);

        return $task;
    }

    /**
     * @return array
     */
    public function queryForTasks()
    {
        $taskArray = $this->databaseService->getData('SELECT * FROM taak');
        return $taskArray;
    }

    public function getTaskDescriptionByDate($date)
    {
        $i = 0;
        $taskArray = $this->databaseService->getData("SELECT * FROM taak WHERE taa_datum = '". $date . "'");

        if (!$taskArray) {
            return null;
        }

        foreach ($taskArray as $task)
        {
            $tasks[$i] = $this->createTaskFromData($task);
            $i++;
        }

        return $tasks;
    }

    public function procesApiGetAllTasks()
    {

        $tasks = $this->queryForTasks();
        if(!isset($tasks)){
            $this->response->setsuccess(false);
            $this->response->setHttpStatusCode(404);
            $this->response->addMessage('no tasks Where found');
        }else
        {
            $nrOfTasks = count($tasks);
            $this->response->setsuccess(true);
            $this->response->setHttpStatusCode(200);
            $this->response->addMessage('there where '.$nrOfTasks.' tasks found');
            $this->response->setData($tasks);
            $this->response->send();
        }
    }

    public function procesApiGetTaskById($taakId)
    {

        $task = $this->getTaskById($taakId);
        $nrOfTasks = count($task);
        if(!isset($nrOfTasks))
        {
            $this->response->setsuccess(false);
            $this->response->setHttpStatusCode(404);
            $this->response->addMessage('the task with id:'.$taakId.' was not found');

        }else
        {
            $this->response->setsuccess(true);
            $this->response->setHttpStatusCode(200);
            $this->response->setData($task);
            $this->response->addMessage('task with id:'.$taakId.' is loaded');
            $this->response->send();
        }

    }

    public function procesApiCreateNewtask()
    {
        $taskDate = $_POST['taa_datum'];
        $taskOmschr = $_POST['taa_omschr'];
        if($this->databaseService->executeSQL("INSERT INTO taak SET taa_datum=' ". $taskDate."' , taa_omschr= '".$taskOmschr."'"))
        {
            $this->response->setsuccess(true);
            $this->response->setHttpStatusCode(200);
            $this->response->addMessage('the task is loaded in the database');
            $this->response->send();

        }else
        {

            $this->response->setsuccess(false);
            $this->response->setHttpStatusCode(422);
            $this->response->addMessage('there was a error in loading your task');
            $this->response->send();
        }
    }


}