<?php
	include("db_con.php");

	$query_settings = "SELECT * FROM settings_tbl WHERE settings_id = 1";
	$result_settings = $con->query($query_settings);
	$row_settings = $result_settings->fetch_assoc();	
	$borrow_days_student = $row_settings['borrow_days_student'];
	$borrow_days_employee = $row_settings['borrow_days_employee'];
?>
<div class="settings-form">
	<div class="settings-header">
		<span class="fa fa-calendar"></span>
		&nbsp;Allowed Days - Borrow
	</div>
	<div class="settings-fields">
		<table width="100%">
			<tr>
				<td>
					<label for="borrow-student">Student:</label>
					<input type="text" id="borrow-student" name="borrow-student" class="form-control" value="<?php echo $borrow_days_student; ?>" ondblclick="enableBorrowDaysStudent()"maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-borrow-student" name="edit-borrow-student" class="btn btn-warning" onclick="enableBorrowDaysStudent()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
			<tr>
				<td>
					<label for="borrow-employee">Employee:</label>
					<input type="text" id="borrow-employee" name="borrow-employee" class="form-control" value="<?php echo $borrow_days_employee; ?>" ondblclick="enableBorrowDaysEmployee()" maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-borrow-employee" name="edit-borrow-employee" class="btn btn-warning" onclick="enableBorrowDaysEmployee()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
		</table>
	</div>
	<div class="settings-footer">
		<button id="update-borrow-days" class="btn btn-primary" onclick="updateBorrowDays()" title="Update Settings" disabled>
			<tagname id="borrow-submit-text">Save</tagname>
			<div id="borrow-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>
		</button>
	</div>
</div>