<?php
session_start();
if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    
    $errors = [];
    if (empty($_POST['editor'])) $errors["editor"] = "No answer to post";

    $ans=$_POST['editor'];
    $ques_id=$_POST['ques_id'];

    if (empty($errors)) {
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $qry = "insert into answers (answer,questions_id ,created_by ) values ('$ans','$ques_id' ,". $user['id']." )";
        $rslt = mysqli_query($cn , $qry);
        if ($rslt){
            header("location:single_ques.php?ques_id=$ques_id&ans=done");
        }
    } else {
        $_SESSION["errors"] = $errors;
        header("location:single_ques.php?ques_id=$ques_id");
    }
    mysqli_close($cn);
} else {
    header("location:index.php?secure=page");
} 