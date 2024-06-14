<?php

/**
 * Represents a base controller for managing views and models.
 */
class Controllers
{
    /** @var Views The views manager. */
    protected $views; // Cambiado a protected

    /** @var mixed The model associated with the controller. */
    protected $model; // Cambiado a protected

    /**
     * Initializes a new instance of the Controllers class.
     */
    public function __construct()
    {
        $this->views = new Views();
        $this->loadModel();
    }

    /**
     * Loads the corresponding model for the controller.
     * Assumes that the model class name follows the convention: {ControllerName}Model.
     * For example, if the controller is HomeController, the model class should be HomeModel.
     */
    public function loadModel()
    {
        $model = get_class($this) . "Model";
        $modelFilePath = "Models/" . $model . ".php";
        if (file_exists($modelFilePath)) {
            require_once($modelFilePath);
            $this->model = new $model();
        }
    }
}
