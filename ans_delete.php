<?php
session_start();

if (!empty($_GET['ans_id'])){
    $id = $_GET['ans_id'];
    $qry = "select * from answers where id=$id";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    $ans=mysqli_fetch_assoc($rslt);
    if (!empty($_SESSION["user"]) && ($_SESSION["user"]["id"] == $ans["created_by"])){
        $qry = "delete from answers where id=$id";
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $rslt = mysqli_query($cn, $qry);
        header("location:" .$_SERVER["HTTP_REFERER"]);
        mysqli_close($cn);
    }else {
        header("location:index.php");
} };