<?php
	include("session.php");
	include("header.php");
	include("style.php");
	include("jscript.php");
	include("modal/user_info_modal.php");

	$minimum_age = date("Y-m-d", strtotime("- 15 years"));
	$maximum_age = date("Y-m-d", strtotime("- 100 years"));
	$account_number = $_SESSION['id'];

	$query_check = $con->query("SELECT * FROM student_tbl WHERE student_id = '$account_number'");
	if($query_check->num_rows == 1)
	{
		$row_student = $query_check->fetch_assoc();
		$birthday = $row_student['student_birthday'];
		$email = $row_student['student_email'];
		$contact_number = $row_student['student_contact'];
	}
	else
	{
		$query_employee = $con->query("SELECT * FROM employee_tbl WHERE employee_id = '$account_number'");
		$row_employee = $query_employee->fetch_assoc();
		$birthday = $row_employee['employee_birthday'];
		$email = $row_employee['employee_email'];
		$contact_number = $row_employee['employee_contact'];
	}
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

			<!--Account Settings-->
			<div class="account-settings">
				<div class="page-header">
					<span class="fa fa-cog"></span>
					&nbsp;Account Settings
					<div class="current-date">
						<span class="fa fa-calendar"></span>
						<?php
							$date_today = date("F d, Y | h:i A");
							echo "&nbsp;".$date_today;
						?>
					</div>
				</div>

				<form id="account-update" method="POST" action="action/update_account.php">
					<label for="birthday">Birthday:</label>
					<input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $birthday; ?>" max="<?php echo $minimum_age; ?>" min="<?php echo $maximum_age; ?>" required/>
					<label for="email">E-mail Address:</label>
					<input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" maxlength="60" required/>
					<label for="contact-number">Contact Number:</label>
					<input type="text" id="contact-number" name="contact-number" class="form-control" value="<?php echo $contact_number; ?>" minlength="5" maxlength="25" required/>
					<div class="form-loader">
						<span class="fa fa-spinner fa-spin"></span>
					</div>

					<div class="saved-changes-response">
						<p id="saved-response"></p>
					</div>

					<div class="form-buttons">
						<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
						<button type="button" id="submit-changes" onclick="userInfoModal()" class="btn btn-success">Save Changes</button>
					</div>
				</form>
			</div>
			<!--/Account Settings-->

		</div>
		<!--/Page Body-->
	<?php include("footer.php"); ?>