<?php
// logout_ajax.php
// This file is called by JavaScript (fetch API) to log the user out via AJAX.
// It returns a JSON response: {"status": "success"}

// Start the session
session_start();

// Destroy the session
session_destroy();

// Return a JSON response indicating success
echo json_encode(['status' => 'success']);
