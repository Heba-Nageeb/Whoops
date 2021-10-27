<?php
session_start();

if (!empty($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $ans_id = $_POST['ans_id'];

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $qry="select * from votes WHERE answers_id= $ans_id AND created_by=".$user['id']." ";
    $rslt = mysqli_query($cn, $qry);

    if ($rslt->num_rows > 0) {
        if (!empty($_POST['upvote'])) {
            $qry = "delete from votes where num = -1 AND answers_id= '$ans_id' AND created_by= ". $user['id']." ";

        } else if (!empty($_POST['downvote'])) {
            $qry = "delete from votes where num = 1 AND answers_id= '$ans_id' AND created_by= ". $user['id']." ";
        }
    } else {
        if (!empty($_POST['upvote'])) {
            $qry="insert into votes (num, answers_id, created_by) values (1,'$ans_id' ,". $user['id']." )";
        } else if (!empty($_POST['downvote'])) {
            $qry="insert into votes (num, answers_id, created_by) values (-1,'$ans_id' ,". $user['id'].")";
        }
    }
    $rslt = mysqli_query($cn, $qry);

    header("location:" .$_SERVER["HTTP_REFERER"]);

    mysqli_close($cn);
}else {
    header("location:index.php?secure=page");
}