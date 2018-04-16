<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<a href="#" id="show-add" onclick="showAddPublisher()">Add New Publisher</a><br><br>
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th><center>Publisher Name</center></th>
				<th><center>Address</center></th>
				<th><center>Contact Number</center></th>
				<th><center>E-mail Address</center></th>
				<th><center>Books Published</th>
				<th><center>Date Added</center></th>
				<th><center>Action</center></th>
			</thead>
			<tbody>
			<?php
				$query_view = "SELECT publisher_tbl.*, GROUP_CONCAT(DISTINCT(book_tbl.book_title)) AS books_published FROM publisher_tbl LEFT JOIN book_tbl ON publisher_tbl.publisher_id = book_tbl.publisher_id WHERE publisher_delete = 0 GROUP BY publisher_tbl.publisher_id";
				$result_view = $con->query($query_view);
				while($row = $result_view->fetch_array())
				{
					$publisher_id = $row['publisher_id'];
					$publisher_name = $row['publisher_name'];
					$publisher_address = $row['publisher_address'];
					$publisher_contact = $row['publisher_contact'];
					$publisher_email = $row['publisher_email'];
					$books_published = $row['books_published'];
					$date_registered = $row['publisher_registered'];
					$publisher_registered = date("m/d/Y", strtotime($date_registered));
			?>
				<tr>
					<td><?php echo $publisher_name; ?></td>
					<td><?php echo $publisher_address; ?></td>
					<td><?php echo $publisher_contact; ?></td>
					<td><?php echo $publisher_email; ?></td>
					<td><?php echo $books_published; ?></td>
					<td><?php echo $publisher_registered; ?></td>
					<td>
						<div class="action-buttons">
							<button class="btn btn-warning btn-sm" onclick="editPublisherModal(<?php echo $publisher_id; ?>)" title="Edit Publisher">
								<span class="fa fa-pencil"></span>
							</button>
							<button class="btn btn-danger btn-sm" onclick="deletePublisherModal(<?php echo $publisher_id; ?>)" title="Delete Publisher">
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