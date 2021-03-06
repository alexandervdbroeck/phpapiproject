<?php
class City
{
    private $id;
    private $filename;
    private $title;
    private $width;
    private $height;
    private $temprature;
    private $weatherDescription;

    /**
     * @return mixed
     */
    public function getWeatherDescription()
    {
        return $this->weatherDescription;
    }

    /**
     * @param mixed $weatherDescription
     */
    public function setWeatherDescription($weatherDescription)
    {
        $this->weatherDescription = $weatherDescription;
    }

    /**
     * @return mixed
     */
    public function getTemprature()
    {
        return $this->temprature;
    }

    /**
     * @param mixed $temprature
     */
    public function setTemprature($temprature)
    {
        $this->temprature = $temprature;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->filename;
    }

    /**
     * @param mixed $name
     */
    public function setFileName($name)
    {
        $this->filename = $name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }
}