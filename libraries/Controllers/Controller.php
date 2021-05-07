<?php


namespace Controllers;

abstract class Controller
{
    protected object $model;
    protected string $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}