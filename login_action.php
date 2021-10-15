<?php
    session_start();
    $errors =[];
    
    if (empty($_REQUEST['email'])) $errors["email"] = "Email is Required";
    if (empty($_REQUEST['pass'])) $errors["pass"] = "Password is Required";

    if(empty($errors)){
        $email =filter_var( $_POST["email"] ,FILTER_SANITIZE_EMAIL);
        $pw =md5(htmlspecialchars( $_POST["pass"]));

        $qry ="select id, name, email, avatar, created_at from users where email='$email' and password='$pw'";

        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME ,DB_USER_NAME ,DB_PW ,DB_NAME ,DB_PORT);
        $rslt =mysqli_query($cn , $qry);

        if ($row = mysqli_fetch_assoc($rslt)){   
            $_SESSION["user"] =$row;        
            header("location:index.php");
        }else {
            $errors["invalid_login"] ="Invalid Email or Password";
            $_SESSION["errors"] =$errors;
            header("location:login.php?email=$email" );
        }
    } else {
        $_SESSION["errors"] =$errors;
        header("location:login.php" );
    }
    mysqli_close($cn);







    







