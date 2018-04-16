<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<a href="#" id="show-add" onclick="showAddHoliday()" title="Click here to add holiday">Add New Holiday</a><br><br>
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th width="180"><center>Event Type</center></th>
				<th width="110"><center>Date of Event</center></th>
				<th width="200"><center>Event Name</center></th>
				<th><center>Description</center></th>
				<th width="110"><center>Date Added</center></th>
				<th><center>Action</center></th>
			</thead>
			<tbody>
			<?php
				$query_view = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
				$result_view = $con->query($query_view);
				while($row = $result_view->fetch_array())
				{
					$holiday_id = $row['holiday_id'];
					$date_holiday = $row['holiday_date'];
					$holiday_date = date("m/d/Y", strtotime($date_holiday));
					$holiday_name = $row['holiday_name'];
					$holiday_description = $row['holiday_description'];
					$holiday_type = $row['holiday_type'];

					$date_added = $row['holiday_added'];
					$holiday_added = date("m/d/Y", strtotime($date_added));
					?>
				<tr>
					<td>
					<?php 
						if($holiday_type == "regular")
						{
							echo "Regular Holiday";
						}
						else if($holiday_type == "special")
						{
							echo "Special Holiday";
						}
						else if($holiday_type == "suspension")
						{
							echo "Class Suspension";
						}
						else if($holiday_type == "school-event")
						{
							echo "School Event";
						}
						else if($holiday_type == "emergency")
						{
							echo "Emergency";
						}
					?>
					</td>
					<td><?php echo $holiday_date; ?></td>
					<td><?php echo $holiday_name; ?></td>
					<td><?php echo $holiday_description; ?></td>
					<td><?php echo $holiday_added; ?></td>
					<td>
						<div class="action-buttons">
							<button class="btn btn-warning btn-sm" onclick="editHolidayModal(<?php echo $holiday_id; ?>)" title="Edit Holiday">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deleteHolidayModal(<?php echo $holiday_id; ?>)" title="Delete Holiday">
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
		<div class="table-loader">
			<span class="fa fa-refresh fa-spin"></span>
		</div>
	</div>