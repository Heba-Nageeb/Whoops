<?php
require("header.php");

if (!empty($_GET['ques_id'])){
    $id = $_GET['ques_id'];
    $qry = "select * from questions where id=$id";
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    $rslt = mysqli_query($cn, $qry);
    $ques=mysqli_fetch_assoc($rslt);
    mysqli_close($cn);
    if (!empty($_SESSION["user"]) && ($_SESSION["user"]["id"] == $ques["created_by"])){
        ?>
        <div class="container">
            <div class="bg-light min-h-full">
                <?php require("navbar.php"); ?>
                
                <h2 class="text-center mt-5">Edit your Question</h2>
                <div class="d-flex justify-content-center">
                    <form class="col-8" action="ques_edit_action.php" method="POST">
                        
                        <input type="hidden" name="ques_id" value="<?=$ques['id']?>">
                        <label class="label my-3">Question Title :</label>
                        <input type="text" name="title" class="form-control m-1" value="<?= $ques['title'] ?>">

                        <label class="label my-3">Question Body :</label>
                        <textarea name="editor" id="editor" class="form-control m-1"><?= $ques['body']?></textarea>
                        
                        <button type="submit" class="login100-form-btn mt-3">Submit Your edit</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        require("footer.php");
    }else {
        header("location:index.php");
    } };
    ?>