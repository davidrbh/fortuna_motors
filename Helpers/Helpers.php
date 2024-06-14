<?php

/**
 * Returns the base URL defined in the constant BASE_URL.
 *
 * @return string The base URL.
 */
function base_url()
{
    return BASE_URL;
}

/**
 * Returns the URL for the assets directory.
 *
 * @return string The assets URL.
 */
function media()
{
    return BASE_URL . "/Assets";
}

/**
 * Includes the header template for admin pages.
 *
 * @param mixed $data Optional data to pass to the header view.
 * @return void
 */
function headerAdmin($data = "")
{
    $view_header = "./Views/Templates/header_admin.php";
    require_once($view_header);
}

/**
 * Includes the footer template for admin pages.
 *
 * @param mixed $data Optional data to pass to the footer view.
 * @return void
 */
function footerAdmin($data = "")
{
    $view_footer = "./Views/Templates/footer_admin.php";
    require_once($view_footer);
}

/**
 * Displays formatted information for debugging purposes.
 *
 * @param mixed $data The data to format.
 * @return string Formatted data enclosed in <pre> tags.
 */
function dep($data)
{
    $format  = '<pre>';
    $format .= print_r($data, true);
    $format .= '</pre>';
    return $format;
}

/**
 * Loads a modal view dynamically.
 *
 * @param string $nameModal The name of the modal view file (without .php extension).
 * @param mixed $data Optional data to pass to the modal view.
 * @return void
 */
function getModal(string $nameModal, $data)
{
    $view_modal = "Views/Templates/Modals/{$nameModal}.php";
    require_once($view_modal);
}


/**
 * This function loads a specific view file and returns its content.
 *
 * @param string $url The URL path to the view file (without .php extension).
 * @param mixed $data Optional data to pass to the view.
 * @return string The rendered view file content.
 */
function getFile(string $url, $data)
{
    ob_start(); // Start output buffering.
    require_once("Views/{$url}.php"); // Include the specified view file.
    return ob_get_clean(); // Get the contents of the output buffer and then clean it.
}


/**
 * This function retrieves the permissions for a specific module.
 *
 * @param int $id_module The ID of the module.
 */
function getPermissions(int $id_module)
{
    require_once("Models/PermissionModel.php"); // Includes the PermissionModel.
    $objPermissions = new PermissionModel(); // Creates a new instance of PermissionModel.

    $id_rol = $_SESSION['userData']['id_rol']; // Gets the role ID from the session.
    $arrPermissions = $objPermissions->PermissionsModules($id_rol); // Gets the permissions for the role.

    if (!empty($arrPermissions)) { // Checks if there are any permissions.
        $_SESSION['Permissions'] = $arrPermissions; // Stores the permissions in the session.
        $_SESSION['PermissionsMod'] = $arrPermissions[$id_module] ?? ""; // Stores the module permissions in the session.
    }
}

/**
 * This function retrieves the user session.
 *
 * @param int $id_user The ID of the user.
 * @return mixed The user session.
 */
function sessionUser(int $id_user)
{
    require_once("Models/LoginModel.php"); // Includes the LoginModel.
    $objLogin = new LoginModel(); // Creates a new instance of LoginModel.

    return $objLogin->sessionLogin($id_user); // Gets the user session.
}

/**
 * This function starts the session and checks for inactivity.
 */
function sessionStart()
{
    session_start(); // Start the session.
    $inactive = 12000; // Set the inactivity time limit.
    $session_in = time() - ($_SESSION['start'] ?? 0); // Calculate the time since the session started.

    if ($session_in > $inactive) { // Check if the session has been inactive for too long.
        session_destroy(); // Destroy the session.
        header("Location: " . BASE_URL . "/logout"); // Redirect to the logout page.
    }
}


/**
 * Cleans a string by removing excess spaces and potentially harmful characters.
 *
 * @param string $strCadena Input string to be cleaned
 * @return string Cleaned string
 */

function strClean($strCadena)
{
    // Verify if the input is a string
    if (!is_string($strCadena)) {
        throw new InvalidArgumentException('Input must be a string.');
    }

    // Remove unnecessary white spaces and backslashes
    $string = preg_replace('/\\s+/', ' ', $strCadena);
    $string = trim($string);
    $string = stripslashes($string);

    // Remove script tags (before SQL keywords)
    $string = removeScriptTags($string);

    // Remove SQL keywords
    $string = removeSQLKeywords($string);

    // Remove SQL injection patterns
    $string = removeSQLInjection($string);

    // Remove special characters
    $string = removeSpecialCharacters($string);

    return $string;
}


/**
 * Generates a random password of specified length.
 *
 * @param int $length Length of the generated password (default: 10)
 * @return string Randomly generated password
 */
function passGenerator($length = 10)
{
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $randomPassword = substr(str_shuffle($characters), 0, $length);
    return $randomPassword;
}

/**
 * Removes potentially harmful script tags from a string.
 *
 * @param string $input Input string
 * @return string Cleaned string
 */
function removeScriptTags($input)
{

    $scriptPatterns = [
        "<script>", "</script>", "<script src>",
        "<script type=>"
    ];
    return str_ireplace($scriptPatterns, '', $input);
}

/**
 * Removes potentially harmful SQL injection patterns from a string.
 *
 * @param string $input Input string
 * @return string Cleaned string
 */
function removeSQLInjection($input)
{
    $sqlPatterns = [
        "OR '1'='1", 'OR "1"="1"', 'OR ´1´=´1´',
        "is NULL; --", "LIKE '", 'LIKE "', "LIKE ´",
        "OR 'a'='a", 'OR "a"="a"', "OR ´a´=´a"
    ];

    return str_ireplace($sqlPatterns, '', $input);
}

/**
 * Removes special characters that may pose security risks.
 *
 * @param string $input Input string
 * @return string Cleaned string
 */
function removeSpecialCharacters($input)
{
    $patterns = ["--", "^", "[", "]", "=="];
    return str_replace($patterns, '', $input);
}

/**
 * Removes potentially harmful SQL keywords and patterns from a string.
 *
 * @param string $input Input string
 * @return string Cleaned string
 */
function removeSQLKeywords($input)
{
    $sqlKeywords = [
        "SELECT * FROM", "DELETE FROM", "INSERT INTO", "SELECT COUNT(*) FROM", "DROP TABLE",
        "FROM", "SELECT", "DROP"
    ];

    return str_ireplace($sqlKeywords, '', $input);
}

/**
 * Generates a unique token.
 *
 * @return string Unique token
 */
function token()
{
    $randomString = bin2hex(random_bytes(20)); // Generate a random string (40 characters)
    $token = implode('-', str_split($randomString, 8)); // Format the string into a token
    return $token;
}

/**
 * Formats a monetary value with decimal and thousand separators.
 *
 * @param float $count Monetary value to format
 * @return string Formatted monetary value
 */
function formatMoney($count)
{
    return number_format($count, 2, SPM, SPD);
}
