<?php
session_start();
$errors = [];
$old_values = ["name" => null, "email" => null];

if (empty($_POST['name'])) $errors["name"] = "Username is Required";
else $old_values["name"] = $_REQUEST['name'];

if (empty($_REQUEST['email'])) $errors["email"] = "Email is Required";
else $old_values["email"] = $_REQUEST['email'];

if (empty($_REQUEST['pass'])) $errors["pass"] = "Password is Required";

if (empty($_REQUEST['con-pass'])) $errors["con-pass"] = "Password confirmation is Required";
else if ($_REQUEST['con-pass'] != $_REQUEST['pass']) {
    $errors["con-pass"] = "Password and Confirm Password are not matched";
}

$name = filter_var(trim($_REQUEST['name']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
$pw = md5(htmlspecialchars($_POST['pass']));

require_once("config.php");

$cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
$qry = "select email from users where email='$email'";
$rslt = mysqli_query($cn, $qry);
if ($row = mysqli_fetch_assoc($rslt)) {
    $errors["email"] = "Email is already registered";
}

if (empty($errors["email"]) &&  !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Invalid Email";

if (!empty($_FILES['image']["name"])) {
    $file_name = "images/avatars/" . date("YmdHis") . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["image"]["tmp_name"], $file_name);
};

if (empty($errors)) {
    $qry = "insert into users(email, name, password, avatar) values ('$email', '$name', '$pw','$file_name')";
    $rslt = mysqli_query($cn, $qry);
    mysqli_close($cn);
    if ($rslt) {
        header("location:login.php?register=done");
    }
} else {
    $_SESSION["errors"] = $errors;
    $_SESSION["old_values"] = $old_values;
    header("location:register.php");
    mysqli_close($cn);
}
