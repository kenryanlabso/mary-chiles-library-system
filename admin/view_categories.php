<?php
	include("db_con.php");
	include("session.php");
?>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<a href="#" id="show-add" onclick="showAddCategory()" title="Click here to add new course">Add New Category</a><br><br>
<div class="table table-responsive">
	<table class="table table-striped table-hover" id="example">
		<thead>
			<th><center>Class Name</center></th>
			<th><center>Date Added</center></th>
			<th><center>Action</center></th>
		</thead>
		<tbody>
		<?php
			$query_view = "SELECT * FROM category_tbl WHERE category_delete = 0 ORDER BY classname ASC";
			$result_view = $con->query($query_view);
			while($row_view = $result_view->fetch_assoc())
			{
				$category_id = $row_view['category_id'];
				$classname = $row_view['classname'];
				$added_category = $row_view['category_added'];
				$category_added = date("m/d/Y", strtotime($added_category));
				
				?>
				<tr>
					<td><?php echo $classname; ?></td>
					<td><?php echo $category_added; ?></td>
					<td>
						<div class="actions-button">
							<button class="btn btn-warning btn-sm" onclick="editCategoryModal(<?php echo $category_id; ?>)" title="Edit category information">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deleteCategoryModal(<?php echo $category_id; ?>)" title="Delete category">
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