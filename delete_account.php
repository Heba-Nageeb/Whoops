<?php
session_start();

if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $id = $user["id"];
    $qry = "delete from users where id=$id";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    session_unset();
    header("location:index.php");
    mysqli_connect($cn);
}