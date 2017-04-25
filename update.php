<?php
/**
 * Created by PhpStorm.
 * User: ichebbi
 * Date: 09/04/17
 * Time: 19:49
 */
require "db.class.php";
include  "config.php";
include "functions.php";
$dbName = "LOGIN";
$tableName ="USERS";

$db = new DB($host,$dbUser,$dbPass,$dbName);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Panel</title>
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
    select {
        margin: 10px 0 10px 0;
    }
    input[name="username"] {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        margin-bottom: -1px;
    }
    input[name="password"] {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
        margin-bottom: 10px;
    }
</style>
<body>
<div class="container well">
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $id = $_POST["id"];
        if ($_POST['action'] =="Delete") {

            if ($db->query("DELETE FROM ".$tableName." WHERE id=?",$data = array($id)) !== false) {
                echo "it works motherfucka";
            } else
                echo "Naaah";
            //$db->query("DELETE FROM ".$tableName." WHERE id=".$id);
        }
        else if (empty($username) && empty($password)) {
            echo "<div class='alert alert-danger'>Empty fields</div>";
        } else if ($_POST['action'] == "Update"){
            $db->query("UPDATE ".$tableName." SET username = '".$username."' , password = '".$password."' WHERE id = ".$id);
        }
    }
    ?>
    <form action="update.php" method="post" class="form-signin" autocomplete="off">
        <h2 class="form-signin-heading">Update Panel</h2>
        <input placeholder="Username" name="username" class="form-control input-lg" autofocus>
        <input placeholder="Password" type="password" name="password" class="form-control input-lg" >
        <select class="form-control" name="id">
            <?php
            populateSelectFromDB($db,"SELECT id FROM ".$tableName." ORDER BY id ASC","id");
            ?>
        </select>
        <input type="submit" name="action" value="Update" class="btn btn-lg btn-primary btn-block">
        <input type="submit" name="action" value="Delete" class="btn btn-lg btn-danger btn-block">
    </form>


</div>

</body>
</html>