<?php require("header.php"); ?>

<div class="limiter">
	<?php require("navbar.php"); ?>
	<div class="container-login100">
		<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
			<form class="login100-form flex-sb flex-w" action="register_action.php" method="post" enctype="multipart/form-data">
				<span class="login100-form-title">
					Sign Up
				</span>

				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Username
					</span>
				</div>
				<div class="wrap-input100 validate-input
					<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['name'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['name'])) echo $_SESSION['errors']['name'] ?>">
					<input class="input100" type="text" name="name" value="<?php if (!empty($_SESSION["old_values"]["name"])) echo $_SESSION["old_values"]["name"] ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Email
					</span>
				</div>
				<div class="wrap-input100 validate-input
					<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['email'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['email'])) echo $_SESSION['errors']['email'] ?>">
					<input class="input100" type="text" name="email" value="<?php if (!empty($_SESSION["old_values"]["email"])) echo $_SESSION["old_values"]["email"] ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Password
					</span>
				</div>
				<div class="wrap-input100 validate-input
					<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['pass'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['pass'])) echo $_SESSION['errors']['pass'] ?>">
					<input class="input100" type="password" name="pass">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Confirm Password
					</span>
				</div>
				<div class="wrap-input100 validate-input
					<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['con-pass'])) echo ' alert-validate' ?>" data-validate="<?php if (!empty($_SESSION['errors']) &&  !empty($_SESSION['errors']['con-pass'])) echo $_SESSION['errors']['con-pass'] ?>">
					<input class="input100" type="password" name="con-pass">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Profile Picture
					</span>
					<span>(Optional)</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Password confirmation is required">
					<input type="file" name="image" multiple class="form-control">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn" type="submit">
						Sign Up
					</button>
				</div>

				<div class="w-full text-center p-t-55">
					<span class="txt2">
						Already a member?
					</span>
					<a href="login.php" class="txt2 bo1">
						Sign In now
					</a>
				</div>
				
			</form>
		</div>
	</div>
</div>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
require("footer.php");
?>