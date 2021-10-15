<?php
require("header.php"); 
if (!empty($_SESSION["user"])) {
    ?>
    <div class="container">
        <div class="bg-light min-h-full">
            <?php require("navbar.php"); ?>
            <h2 class="text-center mt-5">Ask A Question</h2>
            <div class="d-flex justify-content-center">
                <form class="col-8" action="create_ques_action.php" method="POST">

                    <label class="label my-3">Question Title :</label>
                    <?php
                    if (!empty($_SESSION["errors"]) &&  !empty($_SESSION["errors"]["title"]))
                        echo "<div class='alert alert-danger mt-2' role='alert'>" . $_SESSION["errors"]["title"] . "</div>";
                    ?>
                    <input type="text" name="title" class="form-control m-1" value="<?php if (!empty($_SESSION["old_values"]["title"])) echo $_SESSION["old_values"]["title"] ?>">
                
                    <label class="label my-3">Question Body :</label>
                    <?php
                    if (!empty($_SESSION["errors"]) &&  !empty($_SESSION["errors"]["editor"]))
                        echo "<div class='alert alert-danger mt-2' role='alert'>" . $_SESSION["errors"]["editor"] . "</div>";
                    ?>
                    <textarea name="editor" id="editor" class="form-control m-1"> <?php if (!empty($_SESSION["old_values"]["editor"])) echo $_SESSION["old_values"]["editor"] ?></textarea>
                    
                    <button type="submit" class="login100-form-btn mt-3">Submit Your Question</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
    if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
    require("footer.php");
} else {
    header("location:index.php?secure=page");
}
?>