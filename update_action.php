<?php
session_start();
$errors = [];
require_once("config.php");
$cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
$id = $_SESSION["user"]["id"];

//change PP ,Usename $ Email
    //select old photo
    $qry = "select avatar from users where id=$id ";
    $rslt = mysqli_query($cn, $qry);
    if ($row = mysqli_fetch_assoc($rslt)) {
        $file_name  = $row["avatar"];
    }
    //replace old photo with the new one
    if (!empty($_FILES["new-image"]["name"])) {
        $file_name = "images/avatars/" . date("YmdHis") . "." . pathinfo($_FILES["new-image"]["name"], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["new-image"]["tmp_name"], $file_name);
        unlink($_SESSION["user"]["avatar"]);
    }
    //name and email filteration
    $name = filter_var(trim($_REQUEST['new-name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_REQUEST['new-email']), FILTER_SANITIZE_EMAIL);
    //email errors
    $qry = "select email from users where email='$email'";
    $rslt = mysqli_query($cn, $qry);
    if (($row = mysqli_fetch_assoc($rslt)) && ($row['email'] != $_SESSION["user"]["email"])) {
        $errors["email"] = "Email is already registered";
        $email = $_SESSION["user"]["email"];
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid Email";
        $email = $_SESSION["user"]["email"];
    }
    //update new values in DB
    $qry = "update users set name='$name', email='$email', avatar='$file_name' where id=$id";
    $rslt = mysqli_query($cn, $qry);
    if ($rslt) {
        $_SESSION["user"]["avatar"] = $file_name;
        $_SESSION["user"]["name"] = $name;
        $_SESSION["user"]["email"] = $email;
    }
// change password
if (!empty($_REQUEST['new-pass'])) {
    $pw = md5(htmlspecialchars($_POST['new-pass']));
    if (empty($_REQUEST['new-con-pass'])) {
        $errors["con-pass"] = "Password confirmation is Required";
    } else if ($_REQUEST['new-con-pass'] != $_REQUEST['new-pass']) {
        $errors["con-pass"] = "Password and Confirm Password are not matched";
    } else {
        $qry = "update users set password='$pw' where id=$id";
        $rslt = mysqli_query($cn, $qry);
    }
}

$_SESSION["errors"] = $errors;
mysqli_close($cn);

header("location:update.php");
