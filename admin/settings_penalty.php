<?php
	include("db_con.php");

	$query_settings = "SELECT * FROM settings_tbl WHERE settings_id = 1";
	$result_settings = $con->query($query_settings);
	$row_settings = $result_settings->fetch_assoc();
	$penalty_student = $row_settings['fine_student'];
	$penalty_employee = $row_settings['fine_employee'];
?>
<div class="settings-form">
	<div class="settings-header">
		<span class="fa fa-dollar"></span>
			&nbsp;Penalty Amount
	</div>
	<div class="settings-fields">
		<table width="100%">
			<tr>
				<td>
					<label for="amount-student">Student:</label>
					<input type="text" id="amount-student" name="amount-student" class="form-control" value="<?php echo $penalty_student; ?>" ondblclick="enablePenaltyStudent()" maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-penalty-student" name="edit-penalty-student" class="btn btn-warning" onclick="enablePenaltyStudent()"title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
			<tr>
				<td>
					<label for="amount-employee">Employee:</label>
					<input type="text" id="amount-employee" name="amount-employee" class="form-control" value="<?php echo $penalty_employee; ?>" ondblclick="enablePenaltyEmployee()" maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-penalty-employee" name="edit-penalty-employee" class="btn btn-warning" onclick="enablePenaltyEmployee()"title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
		</table>
	</div>
	<div class="settings-footer">
		<button id="update-penalty" class="btn btn-primary" onclick="updatePenalty()" title="Update Settings" disabled>
			<tagname id="penalty-submit-text">Save</tagname>
			<div id="penalty-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>
		</button>
	</div>
</div>
