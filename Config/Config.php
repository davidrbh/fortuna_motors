<?php
// Base URL for the application
define('BASE_URL', 'http://localhost/fortuna_motors');

// Set the time zone to America/Caracas
date_default_timezone_set('America/Caracas');

// Database connection data
define('DB_HOST', 'localhost'); // Database host
define('DB_NAME', 'fortuna_motors'); // Database name
define('DB_USER', 'root'); // Database username
define('DB_PASSWORD', ''); // Database password
define('DB_CHARSET', 'utf8'); // Database character set

// Decimal and thousand delimiters (e.g., 24,1989.00)
define('SPD', '.'); // Decimal delimiter
define('SPM', ','); // Thousand delimiter

// Currency symbol (e.g., Bs)
define('SMONEY', 'Bs'); // Currency symbol

// Email sending data
define('SENDER_NAME', 'Fortuna Motors'); // Sender name for emails
define('EMAIL_SENDER', 'no-reply@fortunaMotors.com'); // Sender email address

// Company information
define('WEB_COMPANY', ''); // Company website (if applicable)
define('COMPANY_NAME', ''); // Company name
