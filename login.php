<?php

require "db.class.php";
include  "config.php";
include  "functions.php";
$dbName = "LOGIN";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: #eee;
    }
    .container {
        max-width: 400px;
    }
    .form-control .form-signin {
        position: relative;
        height: auto;
    }
    .check {
        margin: 10px 0 10px 0;
    }
    input[name="username"] {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    input[name="password"] {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
        margin-bottom: 10px;
    }
    #errorBubble {
        display: none;
    }
    .errorAlert {
        color: firebrick;
    }
</style>
<body>

<div class="container well">
    <?php
    $db = new DB($host,$dbUser,$dbPass,$dbName);
    $result = $db->query("SELECT * FROM USERS");

    if(isset($_POST["action"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $remember = $_POST["rememberMe"];
        if (empty($username) && empty($password)) {
            echo "<div class='alert alert-danger col-xs-12'>Empty fields</div>";
        } else {
            $db = new DB($host,$dbUser,$dbPass,$dbName);
            if (isset($remember)) {
                setcookie(username,$username,time()+10);
                setcookie(password,$password,time()+10);
            }
            verifyCredential($db,$username,$password);
        }
    }
    ?>
    <div id="errorBubble" class='alert alert-danger col-xs-12'></div>

    <h2 class="form-signin-heading">Login</h2>

    <form action="login.php" method="post" id="myForm" class="form-signin" autocomplete="off">

        <div id="userFeedback" class=" has-feedback ">
            <input placeholder="Username" id="username" name="username" class=" form-control input-lg" value="<?php cookieLoader("username") ?>" autofocus>
            <span id="userGlyph" class="glyphicon form-control-feedback"></span>
        </div>


        <div id="passFeedback" class="has-feedback">
            <input type="password" placeholder="Password" id="password" name="password" class="form-control input-lg" value="<?php cookieLoader("password")?>">
            <span id="passGlyph" class="glyphicon form-control-feedback"></span>
        </div>

        <div class="errorAlert">
            <p id="uAlert">Username is required*</p>
            <p id="pAlert">Password is required*</p>
        </div>

        <div class="check">
            <input type="checkbox" name="rememberMe" value="Remember"> Remember Me
        </div>


        <input type="submit" name="action" value="Login" class="btn btn-lg btn-primary btn-block">

    </form>

    <div class="errorAlert">

    </div>

    <script>

        var userFeedback = document.getElementById("userFeedback");
        var userGyph = document.getElementById("userGlyph");
        var passFeedback = document.getElementById("passFeedback");
        var passGyph = document.getElementById("passGlyph");
        var usernameField = document.getElementById("username");
        var passwordField = document.getElementById("password");
        var userAlert = document.getElementById("uAlert");
        var passAlert = document.getElementById("pAlert");

        var empty = true;

        function feedbackError(r,e) {
            if (r=='a') {
                e.classList.add("has-error");
            } else  if (r=='r') {
                e.classList.remove("has-error");
            }
        }
        function glyphError(r,e) {
            if (r=='a') {
                e.classList.add("glyphicon-remove");
            } else  if (r=='r') {
                e.classList.remove("glyphicon-remove");
            }
        }


        function formValidation () {
            document.getElementById("myForm").onsubmit = function () {
                if (usernameField.value == "") {
                    feedbackError("a",userFeedback);
                    glyphError("a",userGyph);
                    userAlert.style.display = "block";
                    empty = false;
                } else {
                    feedbackError("r",userFeedback);
                    glyphError("r",userGyph);
                    userAlert.style.display = "none";
                }
                if (passwordField.value == "") {
                    feedbackError("a",passFeedback);
                    glyphError("a",passGyph);
                    passAlert.style.display = "block";
                    empty = false;
                } else {
                    feedbackError("r",passFeedback);
                    glyphError("r",passGyph);
                    passAlert.style.display = "none";
                }
                if (empty == true) {
                    return true;
                } else {
                    return false;
                }
            };
        }

        window.onload = function () {
            userAlert.style.display = "none";
            passAlert.style.display = "none";
            formValidation();
        };
    </script>
</div>
</body>
</html>