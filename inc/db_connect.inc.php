<?php
// Create variables for your database connection:
$host     = 'localhost';
$user     = 'root';
$password = '';
$dbname   = 'ctec';

// Build the DSN (Data Source Name) string:
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// Create a new PDO instance:
$db = new PDO($dsn, $user, $password);

// Set the default fetch mode to return objects:
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
