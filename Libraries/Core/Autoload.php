<?php
// Autoload function to load class files dynamically
spl_autoload_register(function ($class) {
    // Construct the file path based on the class name
    $classPath = 'Libraries/Core/' . $class . '.php';

    // Check if the file exists
    if (file_exists($classPath)) {
        require_once($classPath);
    }
});
