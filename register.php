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
                <label class="col-form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" required name="email">
                <br><br>
                <label class="col-form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" required name="password">
                <br><br>
                <label class="col-form-label" for="first_name">First Name</label>
                <input class="form-control" type="text" id="first_name" required name="first_name">
                <br><br>
                <label class="col-form-label" for="last_name">Last Name</label>
                <input class="form-control" type="text" id="last_name" required name="last_name">
                <br><br>
                <input class="btn btn-dark shadow" type="submit" value="Register">
            </form>
        </div>
    </div>
</div>

<?php require 'inc/footer.inc.php'; ?>