<?php
// register.php
$pageTitle = "Register";
require 'inc/header.inc.php';
require_once 'inc/db_connect.inc.php';
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="alert alert-info shadow">
                <h1 class="bs-blue">Register</h1>
            </div>
            <?php require_once 'inc/register/register.inc.php' ?>
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
        </div>
    </div>
</div>

<?php require 'inc/footer.inc.php'; ?>