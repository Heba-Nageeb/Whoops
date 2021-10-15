<?php
session_start();

if (!empty($_GET['ques_id'])){
    $id = $_GET['ques_id'];
    $qry = "select * from questions where id=$id";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    $ques=mysqli_fetch_assoc($rslt);
    if (!empty($_SESSION["user"]) && ($_SESSION["user"]["id"] == $ques["created_by"])){
        $qry = "delete from questions where id=$id";
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $rslt = mysqli_query($cn, $qry);
        if($rslt){
            if($_SERVER["HTTP_REFERER"]="single_ques.php"){
                header("location:index.php");
            }else{
                header("location:" .$_SERVER["HTTP_REFERER"]);
            }
        };
        mysqli_close($cn);
    }else {
        header("location:index.php");
} };