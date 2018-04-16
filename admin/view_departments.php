<?php
	include("session.php");
	include("db_con.php");
?>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<a href="#" id="show-add" onclick="showAddDepartment()" title="Click here to add new department">Add New Department</a><br><br>
<div class="table table-responsive">
	<table class="table table-striped table-hover" id="example">
		<thead>
			<th><center>Department Name</center></th>
			<th><center>Department Description</center></th>
			<th><center>Date Added</center></th>
			<th><center>Action</center></th>
		</thead>
		<tbody>
		<?php
			$query_view = "SELECT * FROM department_tbl WHERE department_delete = 0 ORDER BY department_name ASC";
			$result_view = $con->query($query_view);
			while($row_view = $result_view->fetch_assoc())
			{
				$department_id = $row_view['department_id'];
				$department_name = $row_view['department_name'];
				$department_description = $row_view['department_description'];
				$date_registered = $row_view['department_added'];
				$department_added = date("m/d/Y", strtotime($date_registered));
				?>
				<tr>
					<td><?php echo $department_name; ?></td>
					<td><?php echo $department_description; ?></td>
					<td><?php echo $department_added; ?></td>
					<td>
						<div class="actions-button">
							<button class="btn btn-warning btn-sm" onclick="editDepartmentModal(<?php echo $department_id; ?>)" title="Edit department information">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deleteDepartmentModal(<?php echo $department_id; ?>)" title="Delete department">
								<span class="fa fa-trash"></span>
							</button>
						</div>
					</td>
				</tr>
				<?php
			}
		?>
		</tbody>
	</table>
</div>