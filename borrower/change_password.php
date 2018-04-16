<?php
	include("session.php");
	include("../admin/header.php");
	include("../admin/style.php");
	include("jscript.php")
?>
	<style>
	.page-body
	{
		height:550px;
	}
	</style>
	<body>
		<?php include("navigation_bar.php"); ?>
		<!--Page Body-->
		<div class="page-body">

			<!--Change Password-->
			<div class="password-change">
				<div class="page-header">
					<span class="fa fa-user"></span>
					&nbsp;Change Password
					<div class="current-date">
						<span class="fa fa-calendar"></span>
						<?php
							$date_today = date("F d, Y | h:i A");
							echo "&nbsp;".$date_today;
						?>
					</div>
				</div>

				<form id="password-update" method="POST" action="action/update_password.php">
					<label for="old-password">Old Password:</label>
					<input type="password" id="old-password" name="old-password" class="form-control" minlength="5" maxlength="25" autofocus required/>
					<label for="new-password">New Password:</label>
					<input type="password" id="new-password" name="new-password" class="form-control" minlength="5" maxlength="25" required/>
					<label for="confirm-password">Confirm New Password:</label>
					<input type="password" id="confirm-password" name="confirm-password" onchange="checkPassword()" class="form-control" minlength="5" maxlength="25" required/>
					<p id="password-matched-error">The password you entered does not matched.</p>
					<div class="form-loader">
						<span class="fa fa-spinner fa-spin"></span>
					</div>

					<div class="form-password-response">
						<p id="password-response"></p>
					</div>

					<div class="form-buttons">
						<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
						<button type="submit" id="submit-password" class="btn btn-success">Submit</button>
					</div>
				</form>
			</div>
			<!--/Change Password-->

		</div>
		<!--/Page Body-->
	</body>
	<?php include("../admin/footer.php"); ?>