<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<a href="#" id="show-add" onclick="showAddAuthor()" title="Click here to add new author">Add New Author</a><br><br>
	
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th><center>First Name</center></th>
				<th width="2"><center>MI</center></th>
				<th><center>Last Name</center></th>
				<th><center>Authored Books</center></th>
				<th width="100"><center>Date Added</center></th>
				<th width="100"><center>Action</center></th>
			</thead>
			<tbody>
			<?php
				$query_view = "SELECT author_tbl.*, GROUP_CONCAT(book_tbl.book_title) AS authored_books FROM author_tbl LEFT JOIN book_author_tbl ON author_tbl.author_id = book_author_tbl.author_id LEFT JOIN book_tbl ON book_author_tbl.book_id = book_tbl.book_id WHERE author_tbl.author_delete = 0 GROUP BY author_tbl.author_id";
				$result_view = $con->query($query_view);
				while($row = $result_view->fetch_array())
				{
					$author_id = $row['author_id'];
					$first_name = $row['author_fname'];
					$middle_initial = $row['author_mi'];
					$last_name = $row['author_lname'];
					$authored_books = $row['authored_books'];
					$date_registered = $row['author_registered'];
					$date_added = date("m/d/Y", strtotime($date_registered));
					?>
				<tr>
					<td><?php echo $first_name; ?></td>
					<td>
					<?php
						if($middle_initial == "")
						{
							echo "";
						}
						else
						{
							echo $middle_initial."."; 
						}
					 ?>
					</td>
					<td><?php echo $last_name; ?></td>
					<td><?php echo $authored_books; ?></td>
					<td><?php echo $date_added; ?></td>
					<td>
						<div class="action-buttons">
							<button class="btn btn-warning btn-sm" onclick="editAuthorModal(<?php echo $author_id; ?>)" title="Edit Author">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deleteAuthorModal(<?php echo $author_id; ?>)" title="Delete Author">
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