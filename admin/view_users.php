<?php
	include("db_con.php");
	include("session.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "admin")
		{
			if(isset($_GET['view']))
			{
				$view = $_GET['view'];
				if($view == "all")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					<div class="filter-menu">
						<button id="filter-admin-staff" class="btn btn-info" onclick="filterAdminStaff()" title="Filter all" disabled>All</button>
						<button id="filter-admin-user"class="btn btn-info" onclick="filterAdminUser()" title="Filter administrators">Administrator</button>
						<button id="filter-staff-user" class="btn btn-info" onclick="filterStaffUser()" title="Filter staffs">Staff</button>
					</div>
					
					<a id="show-add-admin" href="#" onclick="showAddAdmin()" style="float:right;"title="Click here to add new staff">Add New Staff</a>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>User Image</center></th>
								<th><center>Account Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course/Department</center></th>
								<th><center>Position</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_admin = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Admin'";
								$result_admin = $con->query($query_admin);
								$row_count_admin = 0;
								while($row_admin = $result_admin->fetch_assoc())
								{
									$row_count_admin++;
									$admin_id = $row_admin['employee_id'];
									$admin_firstname = $row_admin['employee_fname'];
									$admin_mi = $row_admin['employee_mi'];
									$admin_lastname = $row_admin['employee_lname'];
									$admin_birthday = $row_admin['employee_birthday'];
									$admin_email = $row_admin['employee_email'];
									$admin_contact = $row_admin['employee_contact'];
									$admin_image = $row_admin['employee_image'];
									$date_registered = $row_admin['account_registered'];
									$admin_registered = date("m/d/Y", strtotime($date_registered));
									$department_id = $row_admin['department_id'];
									$department_name = $row_admin['department_name'];

									?>
									<tr>
										<td>
										<?php 
											if($admin_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $admin_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_admin; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $admin_id; ?></td>
										<td><?php echo $admin_firstname; ?></td>
										<td><?php echo $admin_mi; ?></td>
										<td><?php echo $admin_lastname; ?></td>
										<td><?php echo $admin_birthday; ?></td>
										<td><?php echo $admin_email; ?></td>
										<td><?php echo $admin_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td>Admin</td>
										<td><?php echo $admin_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_admin; ?>" value="<?php echo $admin_id; ?>" />
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editEmployeeModal(<?php echo $row_count_admin; ?>)"title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<?php
													if($admin_id == $_SESSION['id'])
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_admin; ?>)" title="Remove admin" disabled>
															<span class="fa fa-remove"></span>
														</button>
														<?php
													}
													else
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_admin; ?>)" title="Remove admin">
															<span class="fa fa-remove"></span>
														</button>
														<?php

													}
												?>
											</div>
										</td>
									</tr>
									<?php
								}
								$query_staff = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Staff'";
								$result_staff = $con->query($query_staff);
								$row_count_student = $row_count_admin;
								while($row_staff = $result_staff->fetch_assoc())
								{
									$row_count_student++;
									$staff_id = $row_staff['student_id'];
									$staff_firstname = $row_staff['student_fname'];
									$staff_mi = $row_staff['student_mi'];
									$staff_lastname = $row_staff['student_lname'];
									$staff_birthday = $row_staff['student_birthday'];
									$staff_email = $row_staff['student_email'];
									$staff_contact = $row_staff['student_contact'];
									$staff_image = $row_staff['student_image'];
									$date_registered = $row_staff['account_registered'];
									$staff_registered = date("m/d/Y", strtotime($date_registered));
									$course_id = $row_staff['course_id'];
									$course_name = $row_staff['course_name'];
									?>
									<tr>
										<td>
										<?php 
											if($staff_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $staff_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $staff_id; ?></td>
										<td><?php echo $staff_firstname; ?></td>
										<td><?php echo $staff_mi; ?></td>
										<td><?php echo $staff_lastname; ?></td>
										<td><?php echo $staff_birthday; ?></td>
										<td><?php echo $staff_email; ?></td>
										<td><?php echo $staff_contact; ?></td>
										<td><?php echo $course_name; ?></td>
										<td>Staff</td>
										<td><?php echo $staff_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $staff_id; ?>" />
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editStudentModal(<?php echo $row_count_student; ?>)"title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<?php
													if($staff_id == $_SESSION['id'])
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_student; ?>)" title="Remove staff" disabled>
															<span class="fa fa-remove"></span>
														</button>
														<?php
													}
													else
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_student; ?>)" title="Remove staff">
															<span class="fa fa-remove"></span>
														</button>
														<?php

													}
												?>
											</div>
										</td>
									</tr>
									<?php
								}
							?>
							</tbody>
						</table>
					<?php	
				}
				else if($view == "admin")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					<div class="filter-menu">
						<button id="filter-admin-staff" class="btn btn-info" onclick="filterAdminStaff()" title="Filter all">All</button>
						<button id="filter-admin-user"class="btn btn-info" onclick="filterAdminUser()" title="Filter administrators" disabled>Administrator</button>
						<button id="filter-staff-user" class="btn btn-info" onclick="filterStaffUser()" title="Filter staffs">Staff</button>
					</div>
					<a id="show-add-admin" href="#" onclick="showAddAdmin()" style="float:right;"title="Click here to add new staff">Add New Staff</a>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Employee Image</center></th>
								<th><center>Employee Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Department</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_admin = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Admin'";
								$result_admin = $con->query($query_admin);
								$row_count_admin = 0;
								while($row_admin = $result_admin->fetch_assoc())
								{
									$row_count_admin++;
									$admin_id = $row_admin['employee_id'];
									$admin_firstname = $row_admin['employee_fname'];
									$admin_mi = $row_admin['employee_mi'];
									$admin_lastname = $row_admin['employee_lname'];
									$admin_birthday = $row_admin['employee_birthday'];
									$admin_email = $row_admin['employee_email'];
									$admin_contact = $row_admin['employee_contact'];
									$admin_image = $row_admin['employee_image'];
									$date_registered = $row_admin['account_registered'];
									$admin_registered = date("m/d/Y", strtotime($date_registered));
									$department_id = $row_admin['department_id'];
									$department_name = $row_admin['department_name'];
									?>
									<tr>
										<td>
										<?php 
											if($admin_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $admin_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_admin; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $admin_id; ?></td>
										<td><?php echo $admin_firstname; ?></td>
										<td><?php echo $admin_mi; ?></td>
										<td><?php echo $admin_lastname; ?></td>
										<td><?php echo $admin_birthday; ?></td>
										<td><?php echo $admin_email; ?></td>
										<td><?php echo $admin_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td><?php echo $admin_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_admin; ?>" value="<?php echo $admin_id; ?>"/>
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editEmployeeModal(<?php echo $row_count_admin; ?>)"title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<?php
													if($admin_id == $_SESSION['id'])
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_admin; ?>)" title="Remove admin" disabled>
															<span class="fa fa-remove"></span>
														</button>
														<?php
													}
													else
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_admin; ?>)" title="Remove admin">
															<span class="fa fa-remove"></span>
														</button>
														<?php

													}
												?>
											</div>
										</td>
									</tr>
								<?php
								}
							?>
							</tbody>
						</table>
					<?php
				}
				else if($view == "staff")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					<div class="filter-menu">
						<button id="filter-admin-staff" class="btn btn-info" onclick="filterAdminStaff()" title="Filter all">All</button>
						<button id="filter-admin-user"class="btn btn-info" onclick="filterAdminUser()" title="Filter administrators">Administrator</button>
						<button id="filter-staff-user" class="btn btn-info" onclick="filterStaffUser()" title="Filter staffs" disabled>Staff</button>
					</div>
					
					<a id="show-add-admin" href="#" onclick="showAddAdmin()" style="float:right;"title="Click here to add new staff">Add New Staff</a>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Student Image</center></th>
								<th><center>Student Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_staff = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Staff'";
								$result_staff = $con->query($query_staff);
								$row_count_student = 0;
								while($row_staff = $result_staff->fetch_assoc())
								{
									$row_count_student++;
									$staff_id = $row_staff['student_id'];
									$staff_firstname = $row_staff['student_fname'];
									$staff_mi = $row_staff['student_mi'];
									$staff_lastname = $row_staff['student_lname'];
									$staff_birthday = $row_staff['student_birthday'];
									$staff_email = $row_staff['student_email'];
									$staff_contact = $row_staff['student_contact'];
									$staff_image = $row_staff['student_image'];
									$date_registered = $row_staff['account_registered'];
									$staff_registered = date("m/d/Y", strtotime($date_registered));
									$course_id = $row_staff['course_id'];
									$course_name = $row_staff['course_name'];
									?>
									<tr>
										<td>
										<?php 
											if($staff_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $staff_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $staff_id; ?></td>
										<td><?php echo $staff_firstname; ?></td>
										<td><?php echo $staff_mi; ?></td>
										<td><?php echo $staff_lastname; ?></td>
										<td><?php echo $staff_birthday; ?></td>
										<td><?php echo $staff_email; ?></td>
										<td><?php echo $staff_contact; ?></td>
										<td><?php echo $course_name; ?></td>
										<td><?php echo $staff_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $staff_id; ?>"/>
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editStudentModal(<?php echo $row_count_student; ?>)"title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<?php
													if($staff_id == $_SESSION['id'])
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_student; ?>)" title="Remove staff" disabled>
															<span class="fa fa-remove"></span>
														</button>
														<?php
													}
													else
													{
														?>
														<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="removeAdminModal(<?php echo $row_count_student; ?>)" title="Remove staff">
															<span class="fa fa-remove"></span>
														</button>
														<?php

													}
												?>
											</div>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					<?php
				}
			}				
		}
		else if($page == "borrower")
		{
			if(isset($_GET['view']))
			{
				$view = $_GET['view'];
				if($view == "all")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllBorrower()" title="Filter all" disabled>All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterEmployeeBorrower()" title="Filter employees">Employee</button>
						<button id="filter-student-borrower"class="btn btn-info" onclick="filterStudentBorrower()" title="Filter students">Student</button>
					</div>
					
					<a style="font-size:16px; float:right; margin:10px; margin-bottom:20px;"href="#" onclick="showAddUser()" title="Click here to add new user">Add New User</a><br><br>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>User Image</center></th>
								<th><center>Account Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course/Department</center></th>
								<th><center>Account Type</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_borrower = "SELECT * FROM student_tbl LEFT JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number LEFT JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_borrower = $con->query($query_borrower);
								$row_count_student = 0;
								while($row_borrower = $result_borrower->fetch_assoc())
								{
									$row_count_student++;
									$account_number = $row_borrower['account_number'];
									$student_number = $row_borrower['student_id'];
									$student_fname = $row_borrower['student_fname'];
									$student_mi = $row_borrower['student_mi'];
									$student_lname = $row_borrower['student_lname'];
									$student_birthday = $row_borrower['student_birthday'];
									$student_email = $row_borrower['student_email'];
									$student_contact = $row_borrower['student_contact'];
									$student_image = $row_borrower['student_image'];
									$date_registered = $row_borrower['account_registered'];
									$student_registered = date("m/d/Y", strtotime($date_registered));
									$course_name = $row_borrower['course_name'];
									?>
									<tr>
										<td>
										<?php 
											if($student_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $student_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $student_number; ?></td>
										<td><?php echo $student_fname; ?></td>
										<td><?php echo $student_mi; ?></td>
										<td><?php echo $student_lname; ?></td>
										<td><?php echo $student_birthday; ?></td>
										<td><?php echo $student_email; ?></td>
										<td><?php echo $student_contact; ?></td>
										<td><?php echo $course_name; ?></td>
										<td><?php echo "Student"; ?></td>
										<td><?php echo $student_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $student_number; ?>"/>
												<input type="hidden" id="account-type" value="student"/>
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editStudentModal(<?php echo $row_count_student; ?>)"title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="deactivateAccountModal(<?php echo $row_count_student; ?>)" title="Deactivate account">
													<span class="fa fa-remove"></span>
												</button>
											</div>
										</td>
									</tr>
									<?php
								}
								$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_employee = $con->query($query_employee);
								$row_count_employee = $row_count_student;
								while($row_employee = $result_employee->fetch_assoc())
								{
									$row_count_employee++;
									$employee_number = $row_employee['employee_id'];
									$employee_fname = $row_employee['employee_fname'];
									$employee_mi = $row_employee['employee_mi'];
									$employee_lname = $row_employee['employee_lname'];
									$employee_birthday = $row_employee['employee_birthday'];
									$employee_email = $row_employee['employee_email'];
									$employee_contact = $row_employee['employee_contact'];
									$employee_image = $row_employee['employee_image'];
									$date_registered = $row_employee['account_registered'];
									$employee_registered = date("m/d/Y", strtotime($date_registered));
									$department_name = $row_employee['department_name'];
									?>
									<tr>
										<td>
										<?php 
											if($employee_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $employee_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
											<a href="#" onclick="userImageModal(<?php echo $row_count_employee; ?>)" title="Update user image">
												Edit Photo
											</a>
										</center>
										</td>
										<td><?php echo $employee_number; ?></td>
										<td><?php echo $employee_fname; ?></td>
										<td><?php echo $employee_mi; ?></td>
										<td><?php echo $employee_lname; ?></td>
										<td><?php echo $employee_birthday; ?></td>
										<td><?php echo $employee_email; ?></td>
										<td><?php echo $employee_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td><?php echo "Employee"; ?></td>
										<td><?php echo $employee_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_employee; ?>" value="<?php echo $employee_number; ?>"/>
												<input type="hidden" id="account-type" value="employee"/>
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editEmployeeModal(<?php echo $row_count_employee; ?>)" title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="deactivateAccountModal(<?php echo $row_count_employee; ?>)" title="Deactivate account">
													<span class="fa fa-remove"></span>
												</button>
											</div>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
								<?php
				}
				else if($view == "student")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllBorrower()" title="Filter all">All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterEmployeeBorrower()" title="Filter employees">Employee</button>
						<button id="filter-student-borrower" onclick="filterStudentBorrower()" class="btn btn-info" title="Filter students" disabled>Student</button>
					</div>
					
					<a style="font-size:16px; float:right; margin:10px; margin-bottom:20px;"href="users.php?page=add-user" title="Click here to add new user">Add New User</a><br><br>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Student Image</center></th>
								<th><center>Student Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_student = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_student = $con->query($query_student);
								$row_count_student = 0;
								while($row_student = $result_student->fetch_assoc())
								{
									$row_count_student++;
									$student_number = $row_student['student_id'];
									$student_fname = $row_student['student_fname'];
									$student_mi = $row_student['student_mi'];
									$student_lname = $row_student['student_lname'];
									$student_birthday = $row_student['student_birthday'];
									$student_email = $row_student['student_email'];
									$student_contact = $row_student['student_contact'];
									$student_image = $row_student['student_image'];
									$date_registered = $row_student['account_registered'];
									$student_registered = date("m/d/Y", strtotime($date_registered));
									$course_name = $row_student['course_name'];
									?>
								<tr>
									<td>
										<?php 
											if($student_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $student_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
										<center>
											<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
												Edit Photo
											</a>
										</center>
									</td>
									<td><?php echo $student_number; ?></td>
									<td><?php echo $student_fname; ?></td>
									<td><?php echo $student_mi; ?></td>
									<td><?php echo $student_lname; ?></td>
									<td><?php echo $student_birthday; ?></td>
									<td><?php echo $student_email; ?></td>
									<td><?php echo $student_contact; ?></td>
									<td><?php echo $course_name; ?></td>
									<td><?php echo $student_registered; ?></td>
									<td>
										<div class="action-buttons">
											<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $student_number; ?>"/>
											<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editStudentModal(<?php echo $row_count_student; ?>)" title="Edit account">
												<span class="fa fa-pencil"></span>
											</button>
											<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="deactivateAccountModal(<?php echo $row_count_student; ?>)" title="Deactivate account">
												<span class="fa fa-remove"></span>
											</button>
										</div>
									</td>
								</tr>
									<?php
								}
							?>
							</tbody>
						</table>
							<?php
				}
				else if($view == "employee")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllBorrower()" title="Filter all">All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterEmployeeBorrower()" title="Filter employees" disabled>Employee</button>
						<button id="filter-student-borrower" onclick="filterStudentBorrower()" class="btn btn-info" title="Filter students">Student</button>
					</div>
					
					<a style="font-size:16px; float:right; margin:10px; margin-bottom:20px;"href="users.php?page=add-user" title="Click here to add new user">Add New User</a><br><br>
					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Employee Image</center></th>
								<th><center>Employee Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Department</center></th>
								<th><center>Date Registered</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_employee = $con->query($query_employee);
								$row_count_employee = 0;
								while($row_employee = $result_employee->fetch_assoc())
								{
									$row_count_employee++;
									$employee_number = $row_employee['employee_id'];
									$employee_fname = $row_employee['employee_fname'];
									$employee_mi = $row_employee['employee_mi'];
									$employee_lname = $row_employee['employee_lname'];
									$employee_birthday = $row_employee['employee_birthday'];
									$employee_email = $row_employee['employee_email'];
									$employee_contact = $row_employee['employee_contact'];
									$employee_image = $row_employee['employee_image'];
									$date_registered = $row_employee['account_registered'];
									$employee_registered = date("m/d/Y", strtotime($date_registered));
									$department_name = $row_employee['department_name'];
									?>
									<tr>
										<td>
										<?php 
											if($employee_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $employee_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" id="edit-user-image" onclick="userImageModal(<?php echo $row_count_employee; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $employee_number; ?></td>
										<td><?php echo $employee_fname; ?></td>
										<td><?php echo $employee_mi; ?></td>
										<td><?php echo $employee_lname; ?></td>
										<td><?php echo $employee_birthday; ?></td>
										<td><?php echo $employee_email; ?></td>
										<td><?php echo $employee_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td><?php echo $employee_registered; ?></td>
										<td>
											<div class="action-buttons">
												<input type="hidden" id="account-id-<?php echo $row_count_employee; ?>" value="<?php echo $employee_number; ?>"/>
												<button id="edit-user-modal" class="btn btn-warning btn-sm" onclick="editEmployeeModal(<?php echo $row_count_employee; ?>)" title="Edit account">
													<span class="fa fa-pencil"></span>
												</button>
												<button id="delete-user-modal" class="btn btn-danger btn-sm" onclick="deactivateAccountModal(<?php echo $row_count_employee; ?>)" title="Deactivate account">
													<span class="fa fa-remove"></span>
												</button>
											</div>
										</td>
									</tr>
								<?php
								}
							?>
					<?php
				}
				else
				{
					echo "<script>alert('Invalid URL!'); window.location='users.php?page=borrower&view=all';</script>";
				}
			}
		}
		else if($page == "inactive")
		{
			if(isset($_GET['view']))
			{
				$view = $_GET['view'];
				if($view == "all")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllInactiveBorrower()" title="Filter all" disabled>All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterInactiveEmployees()" title="Filter employees">Employee</button>
						<button id="filter-student-borrower"class="btn btn-info" onclick="filterInactiveStudents()" title="Filter students">Student</button>
					</div>
					<br><br>

					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>User Image</center></th>
								<th><center>Account Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course/Department</center></th>
								<th><center>Account Type</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_borrower = "SELECT * FROM student_tbl LEFT JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number LEFT JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status != 'Active'";
								$result_borrower = $con->query($query_borrower);
								$row_count_student = 0;
								while($row_borrower = $result_borrower->fetch_assoc())
								{
									$row_count_student++;
									$account_number = $row_borrower['account_number'];
									$student_number = $row_borrower['student_id'];
									$student_fname = $row_borrower['student_fname'];
									$student_mi = $row_borrower['student_mi'];
									$student_lname = $row_borrower['student_lname'];
									$student_birthday = $row_borrower['student_birthday'];
									$student_email = $row_borrower['student_email'];
									$student_contact = $row_borrower['student_contact'];
									$student_image = $row_borrower['student_image'];
									$date_registered = $row_borrower['account_registered'];
									$student_registered = date("m/d/Y", strtotime($date_registered));
									$course_name = $row_borrower['course_name'];
									?>
									<tr>
										<td>
										<?php 
											if($student_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $student_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $student_number; ?></td>
										<td><?php echo $student_fname; ?></td>
										<td><?php echo $student_mi; ?></td>
										<td><?php echo $student_lname; ?></td>
										<td><?php echo $student_birthday; ?></td>
										<td><?php echo $student_email; ?></td>
										<td><?php echo $student_contact; ?></td>
										<td><?php echo $course_name; ?></td>
										<td><center>Student</center></td>
										<td>
											<center>
												<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $student_number; ?>"/>
												<button class="btn btn-success btn-sm" onclick="activateAccountModal(<?php echo $row_count_student; ?>)"title="Activate Account">
													<span class="fa fa-check"></span>
												</button>
											</center>
										</td>
									</tr>
									<?php
								}
								$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status != 'Active'";
								$result_employee = $con->query($query_employee);
								$row_count_employee = $row_count_student;
								while($row_employee = $result_employee->fetch_assoc())
								{
									$row_count_employee++;
									$employee_number = $row_employee['employee_id'];
									$employee_fname = $row_employee['employee_fname'];
									$employee_mi = $row_employee['employee_mi'];
									$employee_lname = $row_employee['employee_lname'];
									$employee_birthday = $row_employee['employee_birthday'];
									$employee_email = $row_employee['employee_email'];
									$employee_contact = $row_employee['employee_contact'];
									$employee_image = $row_employee['employee_image'];
									$date_registered = $row_employee['account_registered'];
									$employee_registered = date("m/d/Y", strtotime($date_registered));
									$department_name = $row_employee['department_name'];
									?>
									<tr>
										<td>
										<?php 
											if($employee_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $employee_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
											<a href="#" onclick="userImageModal(<?php echo $row_count_employee; ?>)" title="Update user image">
												Edit Photo
											</a>
										</center>
										</td>
										<td><?php echo $employee_number; ?></td>
										<td><?php echo $employee_fname; ?></td>
										<td><?php echo $employee_mi; ?></td>
										<td><?php echo $employee_lname; ?></td>
										<td><?php echo $employee_birthday; ?></td>
										<td><?php echo $employee_email; ?></td>
										<td><?php echo $employee_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td><center>Employee</center></td>
										<td>
											<center>
												<input type="hidden" id="account-id-<?php echo $row_count_employee; ?>" value="<?php echo $employee_number; ?>"/>
												<button class="btn btn-success btn-sm" onclick="activateAccountModal(<?php echo $row_count_employee; ?>)"title="Activate Account">
													<span class="fa fa-check"></span>
												</button>
											</center>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
								<?php
				}
				else if($view == "student")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllInactiveBorrower()" title="Filter all">All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterInactiveEmployees()" title="Filter employees">Employee</button>
						<button id="filter-student-borrower"class="btn btn-info" onclick="filterInactiveStudents()" title="Filter students" disabled>Student</button>
					</div>
					<br><br>

					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Student Image</center></th>
								<th><center>Student Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Course</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_student = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status != 'Active'";
								$result_student = $con->query($query_student);
								$row_count_student = 0;
								while($row_student = $result_student->fetch_assoc())
								{
									$row_count_student++;
									$student_number = $row_student['student_id'];
									$student_fname = $row_student['student_fname'];
									$student_mi = $row_student['student_mi'];
									$student_lname = $row_student['student_lname'];
									$student_birthday = $row_student['student_birthday'];
									$student_email = $row_student['student_email'];
									$student_contact = $row_student['student_contact'];
									$student_image = $row_student['student_image'];
									$date_registered = $row_student['account_registered'];
									$student_registered = date("m/d/Y", strtotime($date_registered));
									$course_name = $row_student['course_name'];
									?>
								<tr>
									<td>
										<?php 
											if($student_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $student_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
										<center>
											<a href="#" onclick="userImageModal(<?php echo $row_count_student; ?>)" title="Update user image">
												Edit Photo
											</a>
										</center>
									</td>
									<td><?php echo $student_number; ?></td>
									<td><?php echo $student_fname; ?></td>
									<td><?php echo $student_mi; ?></td>
									<td><?php echo $student_lname; ?></td>
									<td><?php echo $student_birthday; ?></td>
									<td><?php echo $student_email; ?></td>
									<td><?php echo $student_contact; ?></td>
									<td><?php echo $course_name; ?></td>
									<td>
										<center>
											<input type="hidden" id="account-id-<?php echo $row_count_student; ?>" value="<?php echo $student_number; ?>"/>
											<button class="btn btn-success btn-sm" onclick="activateAccountModal(<?php echo $row_count_student; ?>)"title="Activate Account">
												<span class="fa fa-check"></span>
											</button>
										</center>
									</td>
								</tr>
									<?php
								}
							?>
							</tbody>
						</table>
							<?php
				}
				else if($view == "employee")
				{
					?>
					<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
					
					<div class="filter-menu">
						<button id="filter-all-borrower" class="btn btn-info" onclick="filterAllInactiveBorrower()" title="Filter all">All</button>
						<button id="filter-employee-borrower" class="btn btn-info" onclick="filterInactiveEmployees()" title="Filter employees" disabled>Employee</button>
						<button id="filter-student-borrower"class="btn btn-info" onclick="filterInactiveStudents()" title="Filter students">Student</button>
					</div>
					<br><br>

					<div class="table table-responsive">
						<table class="table table-striped table-hover" id="example">
							<thead>
								<th><center>Employee Image</center></th>
								<th><center>Employee Number</center></th>
								<th><center>First Name</center></th>
								<th><center>MI</center></th>
								<th><center>Last Name</center></th>
								<th><center>Birthday</center></th>
								<th><center>E-mail Address</center></th>
								<th><center>Contact Number</center></th>
								<th><center>Department</center></th>
								<th><center>Action</center></th>
							</thead>
							<tbody>
							<?php
								$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status != 'Active'";
								$result_employee = $con->query($query_employee);
								$row_count_employee = 0;
								while($row_employee = $result_employee->fetch_assoc())
								{
									$row_count_employee++;
									$employee_number = $row_employee['employee_id'];
									$employee_fname = $row_employee['employee_fname'];
									$employee_mi = $row_employee['employee_mi'];
									$employee_lname = $row_employee['employee_lname'];
									$employee_birthday = $row_employee['employee_birthday'];
									$employee_email = $row_employee['employee_email'];
									$employee_contact = $row_employee['employee_contact'];
									$employee_image = $row_employee['employee_image'];
									$date_registered = $row_employee['account_registered'];
									$employee_registered = date("m/d/Y", strtotime($date_registered));
									$department_name = $row_employee['department_name'];
									?>
									<tr>
										<td>
										<?php 
											if($employee_image != "")
											{
												?>
												<img src="uploads/users/<?php echo $employee_image; ?>" class="table-images"/>
												<?php
											}
											else
											{
												?>
												<img src="uploads/users/default.png" class="table-images"/>
												<?php 
											}
										?>
											<center>
												<a href="#" id="edit-user-image" onclick="userImageModal(<?php echo $row_count_employee; ?>)" title="Update user image">
													Edit Photo
												</a>
											</center>
										</td>
										<td><?php echo $employee_number; ?></td>
										<td><?php echo $employee_fname; ?></td>
										<td><?php echo $employee_mi; ?></td>
										<td><?php echo $employee_lname; ?></td>
										<td><?php echo $employee_birthday; ?></td>
										<td><?php echo $employee_email; ?></td>
										<td><?php echo $employee_contact; ?></td>
										<td><?php echo $department_name; ?></td>
										<td>
											<center>
												<input type="hidden" id="account-id-<?php echo $row_count_employee; ?>" value="<?php echo $employee_number; ?>"/>
												<button class="btn btn-success btn-sm" onclick="activateAccountModal(<?php echo $row_count_employee; ?>)"title="Activate Account">
													<span class="fa fa-check"></span>
												</button>
											</center>
										</td>
									</tr>
								<?php
								}
							?>
					<?php
				}
				else
				{
					echo "<script>alert('Invalid URL!'); window.location='users.php?page=borrower&view=all';</script>";
				}
			}
		}
	}
?>