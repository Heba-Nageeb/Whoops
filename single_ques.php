<?php require("header.php"); ?>

<div class="container">
    <div class="bg-light min-h-full">
        <?php require("navbar.php");
        // MSGs
        if (!empty($_GET['ans']) &&  $_GET['ans'] == "done") {
            echo '<p class="text-success m-3">Your answer is successfully added</p>';
        };
        if (!empty($_GET['ans_edit']) &&  $_GET['ans_edit'] == "done") {
            echo '<p class="text-success m-3">Your answer is successfully edited</p>';
        };
        if (!empty($_GET['ques']) &&  $_GET['ques'] == "done") {
            echo '<p class="text-success m-3">Your question is successfully edited</p>';
        };
        // Select question
        $ques_id  = $_GET["ques_id"];
        require_once("config.php");
        $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
        $qry = "SELECT q.id, q.title, q.body, q.created_by, q.created_at ,u.name user_name ,u.avatar   FROM questions q join users u  on (u.id = q.created_by) where q.id = $ques_id";
        $rslt = mysqli_query($cn, $qry);
        $ques = mysqli_fetch_assoc($rslt);
        ?>
        <!-- View question -->
        <div class="my-5">
            <div class="media row">
                <div class="col-1 ml-3">
                            <!-- profile pic of ques creator -->
                    <img src="<?php if (!empty($ques['avatar'])) {
                                    echo $ques['avatar'];
                                } else {
                                    echo "images/avatars/unnamed.png";
                                } ?>" alt="" style="width:80px;height:80px;">
                </div>
                            <!-- title -->
                <div class="media-body col-11 mx-3">
                    <div class="card ">
                        <div class="card-header"> <?= $ques['title'] ?></div>
                            <!-- body -->
                        <div class="card-body">
                            <p class="card-text"><?= $ques['body'] ?></p>
                            <!-- edit and delete -->
                            <?php if (isset($user) && $user["id"] == $ques["created_by"]) { ?>
                            <div class="d-flex justify-content-end mb-2">
                                <a href="ques_edit.php?ques_id=<?= $ques['id'] ?>"
                                    class="btn btn-sm btn-success mx-2">edit</a>
                                <a href="ques_delete.php?ques_id=<?= $ques['id'] ?>"
                                    class="btn btn-sm btn-danger">delete</a>
                            </div>
                            <?php } ?>
                            <!-- number of answers -->
                            <?php
                            $qry = "select count(answer) as count from answers WHERE questions_id= " . $ques['id'] . "";
                            $sum = mysqli_query($cn, $qry);
                            if ($sum) {
                                $count = (int)mysqli_fetch_assoc($sum)["count"];
                            } else {
                                $count = 0;
                            } ?>
                            <p class="txt2">Answers: <?= $count ?></p>
                            <!-- asked by -->
                            <div class="d-flex justify-content-start">
                                <p class="text-danger">Asked by <?= $ques['user_name'] ?> at
                                    <?= $ques['created_at'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <!-- Select answers  -->
                        <?php
                        $id = $ques['id'];
                        $qry = "SELECT a.id, a.answer, a.created_by, a.created_at, a.questions_id ,u.name user_name FROM answers a join users u  on (u.id = a.created_by) where a.questions_id = $id order by a.created_at desc";
                        $rslt = mysqli_query($cn, $qry);
                        if ($rslt->num_rows > 0) {
                            echo "<p class='fs-20 mt-3'>Answers:</p>";
                            while ($ans = mysqli_fetch_assoc($rslt)) {
                                // If edit answer
                                if (!empty($_GET['ans_id']) &&  $_GET['ans_id'] == $ans['id']) {
                                    if (isset($user) && $user["id"] == $ans["created_by"]) {
                                    ?>
                        <form action="ans_edit_action.php" method="POST">
                            <input type="hidden" name="ans_id" value="<?= $ans['id'] ?>">
                            <input type="hidden" name="ques_id" value="<?= $ans['questions_id'] ?>">
                            <label class="label my-3">Edit Your Answer :</label>
                            <textarea name="edit_ans" id="editor"
                                class="form-control m-1"><?= $ans['answer'] ?></textarea>
                            <button type="submit" class="btn btn-sm btn-primary my-3">Submit Your edit</button>
                            <button href="single_ques.php?ques_id=<?= $ans['questions_id'] ?>"
                                class="btn btn-sm btn-secondary my-3">Cancel</button>
                        </form>
                        <?php
                                }} else {
                                ?>
                        <!-- Votes  -->
                        <?php if (!empty($_SESSION["user"])) { ?>
                        <div class="d-flex bd-highlight my-4">
                            <form class="flex-shrink-1 bd-highlight mx-2 " action="vote_action.php" method="post">
                                <input type="hidden" name="ans_id" value="<?= $ans['id'] ?>">
                                <div class="d-flex align-items-start flex-column bd-highlight">
                                    <div class="bd-highlight">
                                        <button type="submit" name="upvote" value=1>
                                            <img src="images/icons/up.png" style="width:30px;height:30px"
                                                alt=""></button>
                                    </div>
                                    <div class="bd-highlight"> <?php
                                        $qry="select sum(num) as summ from votes WHERE answers_id= ".$ans['id']."";
                                        $sum = mysqli_query($cn, $qry);
                                        if($sum){
                                            $count = (int)mysqli_fetch_assoc($sum)["summ"];
                                        }else{
                                            $count = 0;
                                    }?>
                                    <p class="m-2 p-1"><?=$count?></p></div>
                                    <div class="bd-highlight">
                                        <button type="submit" name="downvote" value=1>
                                            <img src="images/icons/down.png" style="width:30px;height:30px"
                                                alt="SomeAlternateText"></button>
                                    </div>

                                </div>
                            </form>
                            <?php } ?>
                            <!-- View answers -->
                            <div class="w-100 bd-highlight">
                                <div class="card ">
                                    <div class="card-body">
                                        <p class="card-text"><?= $ans['answer'] ?></p>
                                        <?php if (isset($user) && $user["id"] == $ans["created_by"]) { ?>
                                        <div class="d-flex justify-content-end">
                                            <a href="single_ques.php?ques_id=<?= $ques_id ?>&ans_id=<?= $ans['id'] ?>"
                                                class="btn btn-sm btn-success mx-2">edit</a>
                                            <a href="ans_delete.php?ans_id=<?= $ans['id'] ?>"
                                                class="btn btn-sm btn-danger">delete</a>
                                        </div>
                                        <?php } ?>
                                        <div class="d-flex justify-content-start mt-4">
                                            <p class="text-danger">Answered by <?= $ans['user_name'] ?> at
                                                <?= $ans['created_at'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}}
                        mysqli_close($cn);
                        // Add answer
                        if (!empty($_SESSION["user"])) {
                            if (empty($_GET['ans_id'])) { // if there is no answer in edit action
                        ?>
                        <form action="create_ans_action.php" method="POST">
                            <input type="hidden" name="ques_id" value="<?= $ques['id'] ?>">
                            <label class="label my-3">Your Answer :</label>
                            <?php
                            if (!empty($_SESSION["errors"]) &&  !empty($_SESSION["errors"]["editor"]))
                                echo "<div class='alert alert-danger mt-2' role='alert'>" . $_SESSION["errors"]["editor"] . "</div>";
                            ?>
                            <textarea name="editor" id="editor" class="form-control m-1"></textarea>
                            <button type="submit" class="login100-form-btn my-3">Submit Your Answer</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
        </div>
    </div>
</div>

<div class="w-full text-center p-t-20">
    <a href="login.php" class="txt1 bo1">
        Log In
    </a>
    <span class="txt1">
        to add your answer
    </span>
</div>
<?php } ?>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
require("footer.php"); ?>