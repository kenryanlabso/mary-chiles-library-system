<?php
	include("db_con.php");

	$query_settings = "SELECT * FROM settings_tbl WHERE settings_id = 1";
	$result_settings = $con->query($query_settings);
	$row_settings = $result_settings->fetch_assoc();	
	$quantity_books_student = $row_settings['quantity_books_student'];
	$quantity_books_employee = $row_settings['quantity_books_employee'];
?>

<div class="settings-form">
	<div class="settings-header">
		<span class="fa fa-book"></span>
		&nbsp;Allowed Quantity of Books
	</div>
	<div class="settings-fields">
		<table width="100%">
			<tr>
				<td>
					<label for="quantity-student">Student:</label>
					<input type="text" id="quantity-student" name="quantity-student" class="form-control" value="<?php echo $quantity_books_student; ?>" ondblclick="enableQuantityStudent()"maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-quantity-student" name="edit-quantity-student" class="btn btn-warning" onclick="enableQuantityStudent()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
			<tr>
				<td>
					<label for="quantity-employee">Employee:</label>
					<input type="text" id="quantity-employee" name="quantity-employee" class="form-control" value="<?php echo $quantity_books_employee; ?>" ondblclick="enableQuantityEmployee()" maxlength="6" readonly/>
				</td>
				<td width="40">
					<button id="edit-quantity-employee" name="edit-quantity-employee" class="btn btn-warning" onclick="enableQuantityEmployee()" title="Edit">
						<span class="fa fa-pencil"></span>
					</button>
				</td>
			</tr>
		</table>
	</div>
	<div class="settings-footer">
		<button id="update-quantity" class="btn btn-primary" onclick="updateQuantityBooks()" title="Update Settings" disabled>
			<tagname id="quantity-submit-text">Save</tagname>
			<div id="quantity-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>
		</button>
	</div>
</div>