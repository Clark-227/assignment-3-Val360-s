<?php
// home.php (standalone version — does NOT use header.inc.php / footer.inc.php)

// Start the session using session_start()
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home PHP</title>
</head>

<body>
    <header>
        <a href="register.php" title="Register">Register</a>

        <?php
        // PHP to check if $_SESSION["is_logged_in"] is set.
        if (isset($_SESSION["is_logged_in"])) { // If yes: show a Logout link to logout.php
            echo "<a href='logout.php' title='Log out'>Log out</a>";
        } else { // If no:  show a Login link to login.php
            echo "<a href='login.php' title='Log in'>Log in</a>";
        }

        // Check if $_SESSION["first_name"] is set.
        if (isset($_SESSION["first_name"])) { // If yes: store it in a variable $first_name
            $first_name = $_GET["first_name"];
        } else { // If no:  set $first_name = "Future User"
            $first_name = "Future User";
        }
        ?>
    </header>

    <?php
    // Display the welcome message using a PHP short echo tag
    $message = "Welcome to Online Record Menager";
    echo "<h1>" . $message . ", " . $first_name . "</h1>";
    ?>
</body>

</html>