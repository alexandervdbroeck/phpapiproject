<?php

class TaskLoader
{
    private $databaseService;
    private $apiController;

    public function __construct(DatabaseService $databaseService, ApiController $apiController)
    {
        $this->databaseService = $databaseService;
        $this->apiController = $apiController;
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
            $this->apiController->sendError(404,'no tasks Where found');

        }else
        {
            $nrOfTasks = count($tasks);
            $this->apiController->sendSuccess('there where '.$nrOfTasks.' tasks found',$tasks);
        }
    }

    public function procesApiGetTaskById($taakId)
    {

        $task = $this->getTaskById($taakId);
        $nrOfTasks = count($task);
        if(!isset($nrOfTasks))
        {
            $this->apiController->sendError(404,'the task with id:'.$taakId.' was not found');

        }else
        {
            $this->apiController->sendSuccess('task with id:'.$taakId.' is loaded',$task);

        }

    }

    public function procesApiCreateNewtask()
    {

        $data = $this->apiController->getJsonFromApiRequest("POST");
        if($data)
        {
            if($this->databaseService->executeSQL("INSERT INTO taak SET taa_datum=' ". $data->taa_datum."' , taa_omschr= '".$data->taa_omschr."'"))
            {
                $this->apiController->sendSuccess('the task is loaded in the database');

            }else
            {
                $this->apiController->sendError(422,'there was a error in loading your task');
            }
        }else
        {
            $this->apiController->sendError(422,'Can not read your Json from your api request');

        }

    }

    public function procesApiDeleteTaskById($taakId)
    {
        $task = $this->getTaskById($taakId);
        if(isset($task))
        {
            if($this->databaseService->executeSQL("DELETE FROM taak WHERE taa_id =".$taakId))
            {
                $this->apiController->sendSuccess('your task with id:'.$taakId." is deleted");

            }else
            {
                $this->apiController->sendError(422,'there was a error in deleting your task');

            }
        }else
        {
            $this->apiController->sendError(422,'the task with id'.$taakId." does not exist");

        }

    }

    public function procesApiUpdateTaskById($taakId)
    {

        $data = $this->apiController->getJsonFromApiRequest("POST");

        // get posted data

        if($this->databaseService->executeSQL("UPDATE taak SET taa_datum ='".$data->taa_datum."' , taa_omschr = '".$data->taa_omschr."' WHERE taa_id = ".$taakId))
        {
            $task = $this->getTaskById($taakId);
            $this->apiController->sendSuccess("your task with id:".$taakId."is updated", $task);


        }else
        {
            $this->apiController->sendError(422,'there was a error updating your task');

        }
    }



}