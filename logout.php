<?php
// logout.php

// Start the session using session_start()
session_start();

// Destroy the session using session_destroy()
session_destroy();

// Redirect the user back to home.php using header("Location: ...")
$message = "You logged out";
header('Location: home.php?message=' . urlencode($message));
