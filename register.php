<?php
// register.php
$pageTitle = "Register";
require 'inc/header.inc.php';
require_once 'inc/db_connect.inc.php';

// Check if the form was submitted using $_SERVER['REQUEST_METHOD']


    // TODO 2: Get email, first_name, last_name from $_POST

    // TODO 3: Hash the password using hash('sha512', ...)

    // TODO 4: Write a SQL INSERT query to add a new user to the 'user' table
    //         Columns: first_name, last_name, email, password
    //         Use named placeholders :first_name, :last_name, :email, :password

    // TODO 5: Prepare and execute the query using PDO
    //         Pass the values as an associative array to $stmt->execute()

    // TODO 6: Check if the insert was successful using $stmt->rowCount()
    //         If rowCount == 0: echo an error message
    //         If successful: echo "User successfully registered"

?>

<h1>Register</h1>
<form action="register.php" method="POST">
    <label for="email">Email</label>
    <input type="email" id="email" required name="email">
    <br><br>
    <label for="password">Password</label>
    <input type="password" id="password" required name="password">
    <br><br>
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" required name="first_name">
    <br><br>
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" required name="last_name">
    <br><br>
    <input type="submit" value="Register">
</form>
<?php require 'inc/footer.inc.php'; ?>