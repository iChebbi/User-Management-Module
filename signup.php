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
    <title>Sign Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: #eee;
    }
    .container {
        max-width: 400px;
    }
    .form-control {
        position: relative;
        height: auto;
    }
    input[name="username"] {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        margin-bottom: -1px; !important;
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
        if (empty($username) && empty($password)) {
            echo "<div class='alert alert-danger col-xs-12'>Empty fields</div>";
        } else {
            $db = new DB($host,$dbUser,$dbPass,$dbName);
            insertCredential($db,$username,$password);
        }
    }
    ?>

    <div id="errorBubble" class='alert alert-danger col-xs-12'></div>

    <h2 class="form-signin-heading">Sign Up</h2>

    <form action="signup.php" method="post" id="myForm" class="form-signin"autocomplete="off">

        <div id="userFeedback" class=" has-feedback ">
            <input placeholder="Username" id="username" name="username" class="form-control input-lg" value="<?php cookieLoader("username") ?>">
            <span id="userGlyph" class="glyphicon form-control-feedback"></span>
        </div>

        <div id="passFeedback" class="has-feedback">
            <input type="password" placeholder="Password" id="password" name="password" class="form-control input-lg" value="<?php cookieLoader("password")?>">
            <span id="passGlyph" class="glyphicon form-control-feedback"></span>
        </div>

        <div class="errorAlert">
            <p id="uAlert"></p>
            <p id="pAlert"></p>
        </div>

        <input type="submit" name="action" value="Sign Up" class="btn btn-lg btn-success btn-block">

    </form>

<script src="" ></script>

    <script>
        var userFeedback = document.getElementById("userFeedback");
        var userGlyph = document.getElementById("userGlyph");
        var passFeedback = document.getElementById("passFeedback");
        var passGlyph = document.getElementById("passGlyph");
        var usernameField = document.getElementById("username");
        var passwordField = document.getElementById("password");
        var userAlert = document.getElementById("uAlert");
        var passAlert = document.getElementById("pAlert");
        var error = false;

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

        function feedbackSuccess(r,e) {
            if (r=='a') {
                e.classList.add("has-success");
            } else  if (r=='r') {
                e.classList.remove("has-success");
            }
        }
        function glyphSuccess(r,e) {
            if (r=='a') {
                e.classList.add("glyphicon-ok");
            } else  if (r=='r') {
                e.classList.remove("glyphicon-ok");
            }
        }


        function formValidation () {

            usernameField.onblur = function() {
                if (usernameField.value == "") {
                    feedbackError("a",userFeedback);
                    glyphError("a",userGlyph);
                    userAlert.textContent = "Username is required";
                    userAlert.style.display = "block";
                    error = true;
                } else if (usernameField.value.length < 6) {
                    feedbackError("a", userFeedback);
                    glyphError("a", userGlyph);
                    userAlert.textContent = "Username needs to be 6 character at least";
                    userAlert.style.display = "block";
                    error = true;
                } else {
                    feedbackError("r",userFeedback);
                    glyphError("r",userGlyph);
                    feedbackSuccess("a",userFeedback);
                    glyphSuccess("a",userGlyph);
                    userAlert.style.display = "none";
                    error = false;
                }
            };
            usernameField.oninput = function() {
                if (usernameField.value.length < 6) {
                    feedbackError("a",userFeedback);
                    glyphError("a",userGlyph);
                    userAlert.textContent = "Username needs to be 6 character at least";
                    userAlert.style.display = "block";
                    error = true;
                } else {
                    feedbackError("r",userFeedback);
                    glyphError("r",userGlyph);
                    feedbackSuccess("a",userFeedback);
                    glyphSuccess("a",userGlyph);
                    userAlert.style.display = "none";
                    error = false;
                }
            };

            passwordField.onblur = function() {
                if (passwordField.value == "") {
                    feedbackError("a",passFeedback);
                    glyphError("a",passGlyph);
                    passAlert.textContent = "Password is required";
                    passAlert.style.display = "block";
                    error = true;
                } else if (passwordField.value.length < 6) {
                    feedbackError("a",passFeedback);
                    glyphError("a",passGlyph);
                    passAlert.textContent = "Password needs to be 6 character at least";
                    passAlert.style.display = "block";
                    error = true;
                } else {
                    feedbackError("r",passFeedback);
                    glyphError("r",passGlyph);
                    feedbackSuccess("a",passFeedback);
                    glyphSuccess("a",passGlyph);
                    passAlert.style.display = "none";
                    error = false;

                }
            };
            passwordField.oninput = function() {
                if (passwordField.value.length < 6) {
                    feedbackError("a",passFeedback);
                    glyphError("a",passGlyph);
                    passAlert.textContent = "Password needs to be 6 character at least";
                    passAlert.style.display = "block";
                    error = true;
                } else {
                    feedbackError("r",passFeedback);
                    glyphError("r",passGlyph);
                    feedbackSuccess("a",passFeedback);
                    glyphSuccess("a",passGlyph);
                    passAlert.style.display = "none";
                    error = false;
                }
            };

            document.getElementById("myForm").onsubmit = function() {
                if (error == false)
                    return true;
                else
                    return false;
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