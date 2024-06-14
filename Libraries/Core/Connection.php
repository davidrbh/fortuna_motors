<?php

/**
 * Represents a database connection using PDO.
 */
class Connection
{
    /** @var PDO|null The PDO database connection. */
    private $connect;

    /**
     * Initializes a new instance of the Connection class.
     *
     * @throws PDOException If a database connection error occurs.
     */
    public function __construct()
    {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        try {
            // Attempt to create a new PDO connection
            $this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection error gracefully
            $this->connect = null; // Set to null in case of error
            error_log("ERROR: " . $e->getMessage()); // Log the error instead of echoing it
        }
    }

    /**
     * Gets the database connection.
     *
     * @return PDO|null The PDO database connection, or null if an error occurred.
     */
    public function connect(): PDO|null
    {
        return $this->connect;
    }
}
