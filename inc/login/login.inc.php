<?php // FileName: 'login.inc.php'

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Check if the form was submitted using $_SERVER['REQUEST_METHOD']
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from $_POST
    $email = $_POST["email"];

    // Hash the password from $_POST using hash('sha512', ...)
    $password = hash('sha512', $_POST['password']);

    //  Write a SQL SELECT query to find a user matching the email AND password
    // Use named placeholders :email and :password
    $sql = "SELECT * FROM user WHERE email=:email AND password=:password LIMIT 1";

    // Prepare and execute the query using PDO ($db->prepare, $stmt->execute)
    $stmt = $db->prepare($sql);
    $stmt->execute(["email" => $email, "password" => $password]);

    // Check if a matching user was found ($stmt->rowCount())
    // If found:
    // - Fetch the user row
    // - Start a session with session_start()
    // - Store "is_logged_in" and "first_name" in $_SESSION
    // - Redirect to home.php using header("Location: home.php")
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        session_start();
        $_SESSION["is_logged_in"] = 1;
        $_SESSION["first_name"] = $row->first_name;
        header("Location: home.php");
    } else { // If not found: Echo an error message like "Invalid user credentials"
        echo "Invalid user credentials";
    }
}
