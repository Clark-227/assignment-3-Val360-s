<?php
// is_logged_in.php
// This file is called by JavaScript (fetch API) to check if a user is logged in.
// It returns a JSON response: {"status": "yes"} or {"status": "no"}

// Start the session
session_start();

// Check if $_SESSION['first_name'] is set using isset()
if (isset($_SESSION['first_name'])) { // If yes: echo json_encode(["status" => "yes"])
    echo json_encode(["status" => "yes"]);
} else { // If no:  echo json_encode(["status" => "no"])
    json_encode(["status" => "no"]);
}
