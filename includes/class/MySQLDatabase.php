<?php
require_once LIB_PATH . DS . "config.php";

##	MySQLDatabase Object
class MySQLDatabase
{

    public $last_query;
    private $connection;

    # Constructor
    function __construct()
    {
        $this->open_connection();
    }

    # Open Connection to Database
    public function open_connection()
    {
        // Connect to DB
        $this->connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    # Close Connection to Database
    public function close_connection()
    {
        if (isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    # MySQL Prep (Removes any SQL Injection Characters)
    public function escape_value($value)
    {
        return mysqli_real_escape_string($this->connection, $value);
    }

    # Query to the DB
    public function query($sql, $public = false)
    {
        global $log;
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    # Fetch Array
    public function fetch_assoc($result_set)
    {
        return mysqli_fetch_assoc($result_set);
    }

    # Number of Rows in a Result Set
    public function num_rows($result_set)
    {
        return mysqli_num_rows($result_set);
    }

    # Get the last id inserted over the current db connection
    public function insert_id()
    {
        return mysqli_insert_id($this->connection);
    }

    # Affected rows
    public function affected_rows()
    {
        return mysqli_affected_rows($this->connection);
    }

    # Free Resources
    public function free_result($result) {
        mysqli_free_result($result);
    }

    # Confirm Query
    private function confirm_query($result, $public = true)
    {
        if (!$result) {
            if ($public) {
                // Add Message to SESSION
                $output  = "<h4>Internal Server Error 500</h4>";
                $output .= "<p>There was a problem on the server. Exiting.</p>";
                redirect_to("index.php");
                // Redirect to index.php

            } else {
                $output = "<h4>Database query failed:</h4>";
                $output .= mysqli_error($this->connection);
                $output .= "<br >";
                $output .= "<h4>Last SQL query: </h4>" . $this->last_query;
                die($output);
            }
        }
    }
}

$database = new MySQLDatabase();    // Create the database.
$db =& $database;    // Create an alias to the database object. Short-hand.
?>
