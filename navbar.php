<nav class="border navbar navbar-expand-lg navbar-light bg-white sticky-top">

    <a class="navbar-brand" href="index.php">
        <img src="images/icons/question-mark.png" alt="" width="35" height="35">
        <div class="navbar-brand">Whoops</div>
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <form class="d-flex" action="search_result.php" method="POST">
                <input class="form-control mx-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
            <!-- for users -->
            <?php
            if (!empty($_SESSION["user"])) {
                $user = $_SESSION["user"];
            ?>
                </ul>
                <a href="create_ques.php" class="btn btn-outline-info">Ask Question</a>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $user["name"] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="user_ques.php">My Questions</a>
                        <a class="dropdown-item" href="update.php">Update Account</a>
                        <a class="dropdown-item" href="delete_account.php">Delete account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout_action.php">Logout</a>
                    </div>
                </div>

                <div class="navbar-brand">
                    <img src="<?php if (!empty($user['avatar'])) {
                                    echo $user['avatar'];
                                } else {
                                    echo "images/avatars/unnamed.png";
                                } ?>" alt="" width="40" height="40">
                </div>
            <!-- for visitors -->
            <?php
            } else { ?>
                </ul>
                <a href="login.php" class="btn btn-sm btn-primary px-3 m-r-5">Log in</a>
                <a href="register.php" class="btn btn-sm btn-secondary">Sign Up</a>
            <?php } ?>
    </div>
</nav>