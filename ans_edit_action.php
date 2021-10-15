<?php
session_start();

if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $ans_id = $_POST['ans_id'];
    $ques_id = $_POST['ques_id'];
    $ans = $_POST["edit_ans"];
    $qry = "update answers set answer='$ans' where id=$ans_id and created_by = " . $user['id'];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    if ($rslt) {
        header("location:single_ques.php?ans_edit=done&ques_id=$ques_id");
    };
    mysqli_close($cn);
} else {
    header("location:index.php?secure=page");
}
