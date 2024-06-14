<?php

require_once("Config/Config.php");
require_once("Helpers/Helpers.php");

/**
 * Get the value of 'url' from the GET request or set a default value.
 *
 * @var string $url
 */
$url = $_GET['url'] ?? 'login/login';



/**
 * Split the URL into parts using the '/' character.
 *
 * @var array $arrUrl
 */
$arrUrl = explode("/", $url);


/**
 * The first element is the controller.
 *
 * @var string $controller
 */
$controller = $arrUrl[0];


/**
 * The second element (if it exists) is the method.
 *
 * @var string $method
 */
$method = $arrUrl[1] ?? $controller;


/**
 * If there's a third element in the URL, consider it as parameters.
 * @var string $params
 */
$params = implode(',', array_slice($arrUrl, 2));

require_once("Libraries/Core/Autoload.php");
require_once("Libraries/Core/Load.php");
