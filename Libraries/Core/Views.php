<?php

/**
 * Represents a utility class for loading views (template files) dynamically.
 */
class Views
{
    /**
     * Gets the view file path based on the controller and view name.
     *
     * @param object $controller The calling controller instance.
     * @param string $view The name of the view to load.
     * @param mixed $data (Optional) Additional data to pass to the view.
     * @return void
     */
    public function getView($controller, string $view, $data = "")
    {
        // Get the class name of the controller instance
        $controllerName = get_class($controller);

        // Determine the view file path based on the controller name
        $viewPath = ($controllerName === "Home")
            ? "Views/$view.php"  // For the Home controller, use a simple path
            : "Views/$controllerName/$view.php";  // For other controllers, use a nested path

        // Include the view file
        require_once($viewPath);
    }
}
