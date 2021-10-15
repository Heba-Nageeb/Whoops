<?php require("header.php"); 
if (!empty($_SESSION["user"])) {?>

    <div class="container">
        <div class="bg-light min-h-full">
            <?php require("navbar.php"); ?>
            <form action="update_action.php" method="post" enctype="multipart/form-data">
                <div class="justify-content-center my-3">
                    <div class="media row">

                        <!-- change profile picture -->
                        <div class="text-center mx-3 col-3 ">
                            <img src="<?php if (!empty($_SESSION["user"]["avatar"])) {
                                            echo $_SESSION["user"]["avatar"];
                                        } else {
                                            echo "images\avatars\unnamed.png";
                                        } ?>" alt="" style="width:200px;height:200px;">
                            <p>Profile Picture</p>
                        </div>
                        <div class="media-body col mr-5">
                            <div class="card mb-1">
                                <div class="card-header">
                                    Update Profile Picture
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="label">Profile Picture :</label>
                                        <input type="file" name="new-image" multiple class="form-control" value="
                                        <?php if (!empty($_SESSION["user"]["avatar"])) {
                                            echo $_SESSION["user"]["avatar"];
                                        } else {
                                            echo "images\avatars\unnamed.png";
                                        } ?>">
                                    </div>
                                </div>
                            </div>

                        <!-- change username and email -->
                            <div class="card mb-1">
                                <div class="card-header">
                                    Update Profile Info
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="label">Username :
                                            <?php echo $_SESSION["user"]["name"] ?></label>
                                        <input type="text" name="new-name" class="form-control" placeholder="New Username" value="<?php echo $_SESSION["user"]["name"] ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="label">Email :
                                            <?php echo $_SESSION["user"]["email"] ?></label>
                                        <input type="text" name="new-email" class="form-control" placeholder="New Email" value="<?php echo $_SESSION["user"]["email"] ?>">
                                        <?php
                                        if (!empty($_SESSION["errors"]) &&  !empty($_SESSION["errors"]["email"]))
                                            echo "<div class='alert alert-danger mt-2' role='alert'>" . $_SESSION["errors"]["email"] . "</div>";
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- change password-->
                            <div class="card mb-1">
                                <div class="card-header">
                                    Update Password
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="label">Password :</label>
                                        <input type="password" name="new-pass" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label">Confirm Password :</label>
                                        <input type="password" name="new-con-pass" class="form-control" placeholder="Confirm New Password">
                                        <?php
                                        if (!empty($_SESSION["errors"]) &&  !empty($_SESSION["errors"]["con-pass"]))
                                            echo "<div class='alert alert-danger mt-2' role='alert'>" . $_SESSION["errors"]["con-pass"] . "</div>";
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="container-login100-form-btn m-t-17">
                                <button type="submit" class="login100-form-btn">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
    require("footer.php");
}else {
    header("location:index.php?secure=page");}
?>