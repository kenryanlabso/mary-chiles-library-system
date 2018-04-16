<?php
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "administrator")
		{
			include("modal/edit_user_modal.php");
			include("modal/edit_user_image_modal.php");
			include("modal/remove_admin_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-users"></span>
						&nbsp;Administators
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!--Add Admin Form-->
					<div class="admin-form">
						<div class="form-closer">
							<button class="close" onclick="closeShowAdmin()" title="Close this form">&times;</button>
						</div>
							<form id="admin-add" method="POST" action="action/add_admin.php">
								<div class="admin-form-body">
									<label for="account-id">Account:</label>
									<select id="account-id" name="account-id" onchange="selectAccount()"class="select2_single form-control" style="width:100%;" required>
										<option></option>
										<?php
											$query_student = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
											$result_student = $con->query($query_student);
											while($row_student = $result_student->fetch_assoc())
											{
												$student_number = $row_student['student_id'];
												$student_name = $row_student['student_fname']." ".$row_student['student_mi'].". ".$row_student['student_lname'];
												?>
												<option value="<?php echo $student_number; ?>"><?php echo "(S) ".$student_number." - ".$student_name; ?></option>
												<?php
											}
												$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
												$result_employee = $con->query($query_employee);
												while($row_employee = $result_employee->fetch_assoc())
												{
													$employee_number = $row_employee['employee_id'];
													$employee_name = $row_employee['employee_fname']." ".$row_employee['employee_mi'].". ".$row_employee['employee_lname'];
													?>
													<option value="<?php echo $employee_number; ?>"><?php echo "(E) ".$employee_number." - ".$employee_name; ?></option>
													<?php
												}
											?>
									</select>
									<label for="admin-type">Priviledge:</label>
									<select id="admin-type" name="admin-type" class="form-control" disabled>
										<option></option>
										<option value="Staff">Staff</option>
										<option value="Admin">Admin</option>
									</select>
									<input type="hidden" id="account-priviledge" name="account-priviledge"/>

									
									<div class="admin-form-response">
										<span class="fa fa-check"></span>&nbsp;Successfully Added!
									</div>

									<div class="form-loader">
										<span class="fa fa-spinner fa-spin"></span>
									</div>
									

									<div class="form-buttons">
										<button type="reset" class="btn btn-default">Reset</button>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
					
					<!--/Add Admin Form-->
					<div class="administrators-view"></div>
				</div>
				<!--/Page Body-->
				<script type="text/javascript">
				$(document).ready(function () 
				{
					$("#account-id").select2(
					{
						placeholder: "Select account",
						allowClear: true
					});
				});
				</script>
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "borrower")
		{
			include("modal/edit_user_modal.php");
			include("modal/edit_user_image_modal.php");
			include("modal/deactivate_account_modal.php");
			
			$minimum_age = date("Y-m-d", strtotime("- 15 years"));
			$maximum_age = date("Y-m-d", strtotime("- 100 years"));
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-users"></span>
						&nbsp;Borrowers
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<div class="user-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddUser()" title="Close this form">&times;</button>
						</div>
						<form id="add-user-form" enctype="multipart/form-data" method="POST" action="action/add_user.php">
							<div class="user-form">
								<label for="account-class">Account Type:</label>
								<select id="account-class" name="account-class" onchange="userType()" class="select2 form-control" style="width:100%;" autofocus required>
									<option></option>
									<option value="Employee">Employee</option>
									<option value="Student">Student</option>
								</select>
								<div class="employee-number-class">
									<label for="employee-number">Employee Number:</label>
									<input type="text" id="employee-number" name="employee-number" onkeyup="checkEmployeeNumber()" class="form-control" maxlength="20"/>
									<span class="span-error" id="employee-number-error"></span>
								</div>

								<div class="student-number-class">
									<label for="student-number">Student Number:</label>
									<input type="text" id="student-number" name="student-number" onkeyup="checkStudentNumber()" class="form-control" maxlength="20"/>
									<span class="span-error" id="student-number-error"></span>
								</div>

								<label for="first-name">First Name:</label>
								<input type="text" id="first-name" name="first-name" class="form-control" maxlength="50" required/>

								<label for="middle-initial">Middle Initial:</label>
								<input type="text" id="middle-initial" name="middle-initial" class="form-control" maxlength="1" required/>

								<label for="last-name">Last Name:</label>
								<input type="text" id="last-name" name="last-name" class="form-control" maxlength="50" required/>

								<label for="birthday">Birthday:</label>
								<input type="date" id="birthday" name="birthday" class="form-control" max="<?php echo $minimum_age; ?>" min="<?php echo $maximum_age; ?>" required/>
								
								<label for="e-mail">E-mail Address:</label>
								<input type="email" id="e-mail" name="e-mail" class="form-control" maxlength="60"/>

								<label for="contact-number">Contact Number:</label>
								<input type="text" id="contact-number" name="contact-number" class="form-control" maxlength="15"/>

								<div class="department-id-class">
									<label for="departmen-id">Department:</label>
									<select id="department-id" name="department-id" class="select2 form-control" style="width:100%;">
										<option></option>
										<?php
											$query_department = "SELECT * FROM department_tbl";
											$result_department = $con->query($query_department);
											while($row_department = $result_department->fetch_assoc())
											{
												$department_id = $row_department['department_id'];
												$department_name = $row_department['department_name'];
												?>
												<option value="<?php echo $department_id; ?>">
													<?php echo $department_name; ?>
												</option>
												<?php
											}
										?>
									</select>
								</div>

								<div class="course-id-class">
									<label for="course-id">Course:</label>
									<select id="course-id" name="course-id" class="select2 form-control" style="width:100%;">
										<option></option>
										<?php
											$query_course = "SELECT * FROM course_tbl";
											$result_course = $con->query($query_course);
											while($row_course = $result_course->fetch_assoc())
											{
												$course_id = $row_course['course_id'];
												$course_name = $row_course['course_name'];
												?>
												<option value="<?php echo $course_id; ?>">
													<?php echo $course_name; ?>
												</option>

												<?php
											}
										?>
									</select>
								</div>

								<label for="user-image">Upload Image:</label>
								<input type="file" id="user-image" name="user-image" class="form-control"/>

								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>

								<div class="user-form-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>
									
								<div class="form-buttons">
									<button type="reset" id="reset-add-user" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-add-user" name="submit-add-user" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div class="users-view"></div>

				</div>
				<!--/Page Body-->
				<script type="text/javascript">
				$(document).ready(function () 
				{
					$("#account-class").select2(
					{
						placeholder: "Select Type",
						allowClear: true
					});
					$("#course-id").select2(
					{
						placeholder: "Select Course",
						allowClear: true
					});
					$("#department-id").select2(
					{
						placeholder: "Select Department",
						allowClear: true
					});
				});
				</script>
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "inactive")
		{
			include("modal/edit_user_image_modal.php");
			include("modal/activate_account_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-users"></span>
						&nbsp;Inactive Borrowers
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					
					<div class="inactives-view"></div>
				</div>
				<?php
			include("footer.php");
		}
		else
		{
			echo "<script>alert('Invalid URL!'); window.location='home.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('Page not found!'); window.location='home.php';</script>";
	}
?>