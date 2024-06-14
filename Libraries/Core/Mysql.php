<?php

/**
 * Represents a MySQL database interaction class.
 * Extends the base Connection class.
 */
class Mysql extends Connection
{
    /** @var PDO The database connection. */
    private $connection;

    /** @var string The SQL query string. */
    private $strquery;

    /** @var array The array of parameter values for prepared statements. */
    private $arrValues;

    /**
     * Initializes a new instance of the Mysql class.
     * Establishes a database connection using the parent Connection class.
     */
    public function __construct()
    {
        // Establish a database connection using the parent Connection class
        $this->connection = (new Connection())->connect();
    }

    /**
     * Insert data into the database using prepared statements.
     *
     * @param string $query The SQL query with placeholders.
     * @param array $arrValues An associative array of parameter values.
     * @return int|string The last inserted ID or an error message.
     * @throws Exception If the insert fails or an error occurs.
     */
    public function insert(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;

            // Prepare the statement
            $insert = $this->connection->prepare($this->strquery);

            // Execute the statement with provided values
            $resInsert = $insert->execute($this->arrValues);

            if ($resInsert) {
                // Return the last inserted ID
                return $this->connection->lastInsertId();
            } else {
                // Throw an exception if the insert fails
                throw new Exception("Insertion failed.");
            }
        } catch (PDOException $e) {
            // Handle the exception and throw a custom exception
            throw new Exception("Error executing insert: " . $e->getMessage());
        }
    }

    /**
     * Execute a SELECT query and retrieve a single row of data.
     *
     * @param string $query The SQL SELECT query.
     * @return array|false An associative array representing the fetched row, or false if no data found.
     * @throws Exception If an error occurs during execution.
     */
    public function select(string $query)
    {
        try {
            $this->strquery = $query;

            // Prepare the statement
            $result = $this->connection->prepare($this->strquery);

            // Execute the statement
            $result->execute();

            // Fetch the data as an associative array
            $data = $result->fetch(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $e) {
            // Handle the exception and throw a custom exception
            throw new Exception('Error executing SELECT query: ' . $e->getMessage());
        }
    }

    /**
     * Execute a SELECT query and retrieve all rows of data.
     *
     * @param string $query The SQL SELECT query.
     * @return array An array of associative arrays representing the fetched rows.
     * @throws Exception If an error occurs during execution.
     */
    public function select_all(string $query)
    {
        try {
            $this->strquery = $query;

            // Prepare the statement
            $result = $this->connection->prepare($this->strquery);

            // Execute the statement
            $result->execute();

            // Fetch all data as an array of associative arrays
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $e) {
            // Handle the exception and throw a custom exception
            throw new Exception('Error executing SELECT query: ' . $e->getMessage());
        }
    }

    /**
     * Execute an UPDATE query to modify existing data.
     *
     * @param string $query The SQL UPDATE query.
     * @param array $arrValues An associative array of parameter values.
     * @return bool True if the update was successful, false otherwise.
     * @throws Exception If an error occurs during execution.
     */
    public function update(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;

            // Prepare the statement
            $update = $this->connection->prepare($this->strquery);

            // Execute the statement with provided values
            $resExecute = $update->execute($this->arrValues);

            return $resExecute;
        } catch (PDOException $e) {
            // Handle the exception and throw a custom exception
            throw new Exception('Error executing UPDATE query: ' . $e->getMessage());
        }
    }

    /**
     * Execute a DELETE query to remove data from the database.
     *
     * @param string $query The SQL DELETE query.
     * @return bool True if the deletion was successful, false otherwise.
     * @throws Exception If an error occurs during execution.
     */
    public function delete(string $query)
    {
        try {
            $this->strquery = $query;

            // Prepare the statement
            $result = $this->connection->prepare($this->strquery);

            // Execute the statement
            $del = $result->execute();

            return $del;
        } catch (PDOException $e) {
            // Handle the exception and throw a custom exception
            throw new Exception('Error executing DELETE query: ' . $e->getMessage());
        }
    }
}