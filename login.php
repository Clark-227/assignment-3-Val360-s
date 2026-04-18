<?php
// login.php
$pageTitle = 'Login';
require 'inc/header.inc.php';
require_once 'inc/db_connect.inc.php';
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="alert alert-info shadow">
                <h1 class="bs-blue">Login</h1>
            </div>
            <?php require_once 'inc/login/login.inc.php' ?>
            <form action="login.php" method="POST">
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto"><label class="col-form-label" for="password">Password</label></div>
                        <div class="col-8"></div>
                        <div class="col-auto"><span class="col d-flex justify-content-center" id="showPassword" onclick="showPassword();">Show Password</span></div>
                    </div>
                    <input class="form-control" type="password" name="password" id="password" required>
                </div>
                <input class="btn btn-dark shadow" type="submit" value="Login">
            </form>

            <script src="js/script.js"></script>

            <?php require 'inc/footer.inc.php'; ?>