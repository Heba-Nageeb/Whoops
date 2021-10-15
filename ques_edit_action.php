<?php
session_start();

if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $id = $_POST['ques_id'];
    $title  = $_POST["title"];
    $body  = $_POST["editor"];

    $qry = "update questions set title='$title', body='$body' where id=$id and created_by = ".$user['id'];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    if($rslt){
        header("location:single_ques.php?ques=done&ques_id=$id");
    };
    mysqli_close($cn);
} else {
    header("location:index.php?secure=page");
}