<?php require("header.php"); ?>

<div class="limiter">
	<?php require("navbar.php"); ?>
	<div class="container-login100">
		<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
			<form class="login100-form flex-sb flex-w" action="login_action.php" method="POST">

				<?php
				if (!empty($_GET['register']) &&  $_GET['register'] == "done") {
					echo '<p class="text-success p-b-10">You are successfully registered</p>';
				}
				if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["invalid_login"])) {
					echo "<p class='text-danger p-b-10'>" . $_SESSION["errors"]["invalid_login"] . "</p>";
				}
				?>

				<span class="login100-form-title">
					Sign In
				</span>

				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Email
					</span>
				</div>
				<div class="wrap-input100 validate-input<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['email'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['email'])) echo $_SESSION['errors']['email'] ?>">
					<input class="input100" type="text" name="email" value="<?php if (!empty($_GET['email']))  echo $_GET['email']; ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Password
					</span>
				</div>
				<div class="wrap-input100 validate-input<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['pass'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['pass'])) echo $_SESSION['errors']['pass'] ?>">
					<input class="input100" type="password" name="pass">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn" type="submit">
						Sign In
					</button>
				</div>

				<div class="w-full text-center p-t-55">
					<span class="txt2">
						Not a member?
					</span>
					<a href="register.php" class="txt2 bo1">
						Sign up now
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
require("footer.php");
?>