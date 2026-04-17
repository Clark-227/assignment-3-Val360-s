<?php // Filename: register.inc.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// Initialize variables for sticky form fields
$email = "";
$first_name = "";
$last_name = "";
$password = "";

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

    // First insure that all required fields are filled in
    if (empty($_POST["first_name"])) {
        array_push($error_bucket, "A first name is required.");
    } else {
        $first = $_POST["first_name"];
    }
    if (empty($_POST["last"])) {
        array_push($error_bucket, "A last name is required.");
    } else {
        $last = $_POST["last"];
    }
    if (empty($_POST["student_id"])) {
        array_push($error_bucket, "A student ID is required.");
    } else {
        $student_id = intval($_POST["student_id"]);
    }
    if (empty($_POST["email"])) {
        array_push($error_bucket, "An email address is required.");
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["phone"])) {
        array_push($error_bucket, "A phone number is required.");
    } else {
        $phone = $_POST["phone"];
    }

    // Add new fields in the check for filled in fields and declare var if !empty
    if (isset($_POST["gpa"])) {
        $gpa = $_POST["gpa"];
    } else {
        $gpa = 0;
    }
    // Validate the financial aid field
    if (!isset($_POST["financial_aid"]) || $_POST["financial_aid"] === "") {
        array_push($error_bucket, "Financial Aid status is required.");
    } else {
        $financial_aid = intval($_POST["financial_aid"]);
    }

    // The Degree Program is always set => declare the var
    $degree_program = $_POST["degree_program"];

    // If graduation date is not set 
    if (!empty($_POST["graduation_date"])) {
        $graduation_date = $_POST["graduation_date"];
    } elseif ($_POST["graduation_date"] == "0000-00-00") {
        $graduation_date = NULL;
    } else {
        $graduation_date = NULL;
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "INSERT INTO $db_table (first_name,last_name,email,phone,student_id,gpa,financial_aid,degree_program,graduation_date) ";
        $sql .= "VALUES (:first,:last,:email,:phone,:student_id,:gpa,:financial_aid,:degree_program,:graduation_date)";

        $stmt = $db->prepare($sql);
        $stmt->execute(["first" => $first, "last" => $last, "email" => $email, "phone" => $phone, "student_id" => $student_id, "gpa" => $gpa, "financial_aid" => $financial_aid, "degree_program" => $degree_program, "graduation_date" => $graduation_date]);

        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you.</div>';
        } else {
            // Optional: regenerate token after use
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            header("Location: display-records.php?message=The record for <strong>" . $first . "</strong> has been created.");
        }
    } else {
        display_error_bucket($error_bucket);
    }
}
