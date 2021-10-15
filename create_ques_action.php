<?php
session_start();
if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $errors = [];
    $old_values = ["title" => null, "editor" => null];

    if (empty($_POST['title'])) $errors["title"] = "Question title is Required";
    else $title=$old_values["title"] = $_REQUEST['title'];

    if (empty($_REQUEST["editor"])) $errors["editor"] = "Question body is Required";
    else $body=$old_values["editor"] = $_REQUEST["editor"];

    if (empty($errors)) {
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $qry = "insert into questions (title ,body  ,created_by ) values ('$title' ,'$body'  ,". $user['id']." )";

        $rslt = mysqli_query($cn , $qry);
        if ($rslt){
            header("location:index.php?ques=done");
        }
    } else {
        $_SESSION["errors"] = $errors;
        $_SESSION["old_values"] = $old_values;
        header("location:create_ques.php");
    }       
    mysqli_close($cn);
} else {
    header("location:index.php?secure=page");
}