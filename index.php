<?php require("header.php");

// pagination
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
};
require_once("config.php ");
$cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
$qry = "select count(title) as totalCount from questions";
$rslt = mysqli_query($cn, $qry);
$count = (int)mysqli_fetch_assoc($rslt)['totalCount'];
$limit = 3;
$pages_num = ceil($count / $limit);
$offset = ($page - 1) * $limit;
// function validatePage(int $page, int $pages_num): bool
// {
//     return ($page >= 1 and $page <= $pages_num);
// };
// if (!validatePage($page, $pages_num)) {
//     header("location:index.php");
// }
?>

<div class="container">
    <div class="bg-light min-h-full">
        <?php require("navbar.php");
        // MSGs
        if (!empty($_GET['ques']) &&  $_GET['ques'] == "done") {
            echo '<p class="text-success m-3">Your question is successfully added</p>';
        };
        if(!empty( $_GET["secure"]) &&  $_GET["secure"]=="page"){
            echo '<p class="text-danger m-3">Please Login First</p>';
        }
        ?>
        
        <p class="fs-30 d-flex m-4">Questions</p>

        <?php if (empty($_SESSION["user"])) { ?>
            <div class="w-full text-center">
                <a href="login.php" class="txt1 bo1">
                    Log In
                </a>
                <span class="txt1">
                    to add your Question
                </span>
            </div>
        <?php  } ?>

        <!-- select and view all questions -->
        <?php
        $qry = "SELECT q.id, q.title, q.body, q.created_by, q.created_at ,u.name user_name ,u.avatar FROM questions q join users u  on (u.id = q.created_by) order by q.created_at desc limit $limit OFFSET $offset";
        $rslt = mysqli_query($cn, $qry);
        if ($rslt->num_rows > 0) {
            while ($ques = mysqli_fetch_assoc($rslt)) {
            ?>
                <div class="media-body m-4">
                    <div class="card ">
                        <!-- title -->
                        <div class="card-header"> <a href="single_ques.php?ques_id=<?= $ques['id'] ?>" class="fs-20 text-primary">
                                <?= $ques['title'] ?></a>
                        </div>
                        <!-- body -->
                        <div class="card-body">
                            <p class="card-text"><?= $ques['body'] ?></p>
                        <!-- edit & delete buttons -->
                            <?php if (isset($user) && $user["id"] == $ques["created_by"]) { ?>
                                <div class="d-flex justify-content-end">
                                    <a href="ques_edit.php?ques_id=<?= $ques['id'] ?>" class="btn btn-sm btn-success mx-2">edit</a>
                                    <a href="ques_delete.php?ques_id=<?= $ques['id'] ?>" class="btn btn-sm btn-danger">delete</a>
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
                            <div class="d-flex justify-content-end">
                                <p class="text-danger">Asked by <?= $ques['user_name'] ?> at
                                    <?= $ques['created_at'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        mysqli_close($cn);

        // pagination
        ?>
        <nav aria-label="Page navigation example" class="d-flex justify-content-center ">
            <ul class="pagination mb-5">
                <li class="page-item <?php if ($page <= 1) echo "disabled" ?>"><a class="page-link" href="index.php?page=<?= $page - 1 ?>">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="index.php?page=<?= $page ?>"><?= $page ?></a></li>
                <?php if ($page + 1 <= $pages_num) { ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?= $page + 1 ?>"><?= $page + 1 ?></a></li>
                <?php }
                if ($page + 2 <= $pages_num) { ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=<?= $page + 2 ?>"><?= $page + 2 ?></a></li>
                <?php } ?>
                <li class="page-item <?php if ($page >= $pages_num) echo "disabled" ?>"><a class="page-link" href="index.php?page=<?= $page + 1 ?>">Next</a></li>
            </ul>
        </nav>
   <?php }else{ 
       ?><p class="fs-30 d-flex m-4">No Questions To show</p>
       <?php } ?>
    </div>
</div>
<?php require("footer.php"); ?>