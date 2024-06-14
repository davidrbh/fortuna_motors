<?php
// Capitalize the controller name (e.g., "home" becomes "Home")
$controller = ucwords($controller);

// Construct the file path for the controller
$controllerFile = 'Controllers/' . $controller . '.php';

// Check if the controller file exists
if (file_exists($controllerFile)) {
    // Include the controller file
    require_once($controllerFile);

    // Create an instance of the controller class
    $controller = new $controller();

    // Check if the specified method exists in the controller
    if (method_exists($controller, $method)) {
        // Call the specified method with the provided parameters
        $controller->{$method}($params);
    } else {
        // If the method doesn't exist, include the error controller
        require_once('Controllers/Error.php');
    }
} else {
    // If the controller file doesn't exist, include the error controller
    require_once('Controllers/Error.php');
}
