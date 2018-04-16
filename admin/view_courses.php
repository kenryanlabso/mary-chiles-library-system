<?php
	include("session.php");
	include("db_con.php");
?>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<a href="#" id="show-add" onclick="showAddCourse()" title="Click here to add new course">Add New Course</a><br><br>
<div class="table table-responsive">
	<table class="table table-striped table-hover" id="example">
		<thead>
			<th><center>Course Name</center></th>
			<th><center>Course Description</center></th>
			<th><center>Date Added</center></th>
			<th><center>Action</center></th>
		</thead>
		<tbody>
		<?php
			$query_view = "SELECT * FROM course_tbl WHERE course_delete = 0 ORDER BY course_name ASC";
			$result_view = $con->query($query_view);
			while($row_view = $result_view->fetch_assoc())
			{
				$course_id = $row_view['course_id'];
				$course_name = $row_view['course_name'];
				$course_description = $row_view['course_description'];
				$date_registered = $row_view['course_added'];
				$course_registered = date("m/d/Y", strtotime($date_registered));
				?>
				<tr>
					<td><?php echo $course_name; ?></td>
					<td><?php echo $course_description; ?></td>
					<td><?php echo $course_registered; ?></td>
					<td>
						<div class="actions-button">
							<button class="btn btn-warning btn-sm" onclick="editCourseModal(<?php echo $course_id; ?>)" title="Edit course information">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deleteCourseModal(<?php echo $course_id; ?>)" title="Delete course">
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