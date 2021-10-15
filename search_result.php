<?php require("header.php"); ?>
<div class="container">
    <div class="bg-light min-h-full">
    <?php
    if (!empty($_POST["search"])){
        require("navbar.php");
        $search = $_POST["search"]; 
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $qry = "select * from questions where (body like '%$search%') or (title like '%$search%')";
        $rslt = mysqli_query($cn, $qry);
        if ($rslt->num_rows > 0) {
            echo "<p class='fs-30 m-4'>Search Results for '$search'</p>";
            while ($ques = mysqli_fetch_assoc($rslt)) {
            ?>
            <div class="media-body m-4">
                <div class="card ">
                    <div class="card-header"> <a href="single_ques.php?ques_id=<?= $ques['id'] ?>"
                            class="fs-20 text-primary">
                            <?= $ques['title'] ?></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $ques['body'] ?></p>
                    </div>
                </div>
            </div>
            <?php }
            } else {
            ?>
            <div class="container-login100">
                <img src="images/icons/search.png" alt="" style="width:120px;height:120px;">
                <div>
                    <p class="fs-40 m-3 text-danger">We couldn't find anything for '<?= $search ?>'</p>
                </div>
            </div>
            <?php
            }
            mysqli_close($cn);
            require("footer.php");
    }else {
        header("location:index.php");
    } 
    ?>