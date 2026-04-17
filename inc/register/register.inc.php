<?php // Filename: register.inc.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

require_once 'inc/functions/functions.inc.php';

$error_bucket = [];

// Initialize variables for sticky form fields
$email = "";
$first_name = "";
$last_name = "";
$password = "";

// Check if the form was submitted using $_SERVER['REQUEST_METHOD']
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // // Check if CSRF token is present in the POST data and session
    // if (!isset($_POST['csrf_token'], $_SESSION['csrf_token'])) {
    //     // yes the die statement is a bit harsh, but it effectively stops the script if the token is missing, which is a critical security issue. 
    //     // In a production application, you might want to handle this more gracefully by showing an error message to the user instead of just terminating the script.    
    //     // Yes Karli, I understand that using die() can be harsh, but in this context, it's a straightforward way to immediately stop the script if the CSRF token is missing, which is a critical security issue. In a production application, you might want to handle this more gracefully by showing an error message to the user instead of just terminating the script. However, for this example, it effectively prevents any further processing if the token is not present, which is essential for security.
    //     die("CSRF token missing.");
    // }

    // // Use hash_equals to prevent timing attacks when comparing tokens
    // if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    //     die("Invalid CSRF token.");
    // }

    // Get email, first_name, last_name from $_POST
    // First insure that all required fields are filled in
    if (empty($_POST["email"])) {
        array_push($error_bucket, "An email address is required.");
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["first_name"])) {
        array_push($error_bucket, "A first name is required.");
    } else {
        $first_name = $_POST["first_name"];
    }
    if (empty($_POST["last_name"])) {
        array_push($error_bucket, "A last name is required.");
    } else {
        $last_name = $_POST["last_name"];
    }
    if (empty($_POST["password"])) {
        array_push($error_bucket, "Password is required.");
    } else {
        $password = $_POST["password"];
    }

    // TODO 3: Hash the password using hash('sha512', ...)
    $password = hash('sha512', $_POST['password']);

    // TODO 4: Write a SQL INSERT query to add a new user to the 'user' table
    //         Columns: first_name, last_name, email, password
    //         Use named placeholders :first_name, :last_name, :email, :password
    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "INSERT INTO user (email,first_name,last_name,password) ";
        $sql .= "VALUES (:email,:first_name,:last_name,:password)";

        // Prepare and execute the query using PDO
        // Pass the values as an associative array to $stmt->execute()
        $stmt = $db->prepare($sql);
        $stmt->execute(["first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password]);
        // TODO 6: Check if the insert was successful using $stmt->rowCount()
        // If rowCount == 0: echo an error message
        // If successful: echo "User successfully registered"
        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you.</div>';
        } else {
            // Optional: regenerate token after use
            // $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            header("Location: home.php?message=The user <strong>" . $email . "</strong> successfully registered.");
        }
    } else {
        display_error_bucket($error_bucket);
    }
}
