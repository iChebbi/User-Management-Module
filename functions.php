<?php
/**
 * Created by PhpStorm.
 * User: ichebbi
 * Date: 10/04/17
 * Time: 21:27
 * @param $db
 * @param $sql
 * @param $tag
 */

function populateSelectFromDB($db,$sql,$tag) {

    $query = $db->query($sql);

    foreach ($query as $key => $value) {
        $idValue = $value[$tag];
        echo "<option value='$idValue'>$idValue</option>";
    }
}

function verifyCredential($db, $username, $password) {
    $userQuery = $db->query("SELECT username FROM USERS WHERE username='$username'");
    $passQuery = $db->query("SELECT password FROM USERS WHERE password='$password'");
    if ($userQuery[0]["username"] == $username && $passQuery[0]["password"] == $password) {
        echo "<div class='alert alert-success'>Login success</div>";
    } else
        echo"<div class='alert alert-danger'>Login failed</div>";
}

function insertCredential($db, $username, $password) {
    if ($db->query("INSERT INTO USERS (username,password) VALUES ('$username','$password')") !== false) {
        echo "<div class='alert alert-success'>Sign Up Successfully</div>";
    }
}

function cookieLoader($key) {
    if (isset($_COOKIE["$key"])) {
        echo $_COOKIE["$key"];
    } else;
}