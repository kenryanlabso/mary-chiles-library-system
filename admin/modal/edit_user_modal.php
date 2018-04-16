<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Personal Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="account-number"/>
					<input type="hidden" id="account-type"/>
					<label for="edit-first-name">First Name:</label>
					<input type="text" id="edit-first-name" name="edit-first-name" class="form-control" maxlength="50" autofocus required/>
					<label for="edit-middle-initial">Middle Initial:</label>
					<input type="text" id="edit-middle-initial" name="edit-middle-initial" class="form-control" maxlength="1" required/>
					<label for="edit-last-name">Last Name:</label>
					<input type="text" id="edit-last-name" name="edit-last-name" class="form-control" maxlength="50" required/>
					<label for="edit-birthday">Birthday:</label>
					<input type="date" id="edit-birthday" name="edit-birthday" class="form-control"/>
					<label for="edit-email">E-mail Address:</label>
					<input type="email" id="edit-email" name="edit-email" class="form-control" maxlength="50"/>
					<label for="edit-contact-number">Contact Number:</label>
					<input type="text" id="edit-contact-number" name="edit-contact-number" class="form-control" maxlength="15"/>
					<div id="course-div">
						<label for="edit-course-id">Course:</label>
						<select id="edit-course-id" name="edit-course-id" class="form-control">
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
					<div id="department-div">
						<label for="edit-department-id">Department:</label>
						<select id="edit-department-id" name="edit-department-id" class="form-control">
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
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-user-response">
				<span class="fa fa-check"></span>&nbsp;Account Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success" id="update-user" onclick="updateUser()">Update</button>
			</div>

		</div>
	</div>
</div>