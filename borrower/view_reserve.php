<?php 
	include("session.php");
	include("db_con.php");
	$account_number = $_SESSION['id'];
?>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>	
	<div class="table table-responsive">
		<table class="table table-bordered table-hover" id="example">
			<thead>
				<th><center>Image</center></th>
				<th><center>Call No.</center></th>
				<th><center>Book Title</center></th>
				<th><center>Authors</center></th>
				<th><center>Year</center></th>
				<th><center>Edition</center></th>
				<th><center>Volume</center></th>
				<th><center>Date Reserved</center></th>
				<th><center>Expiration Date</center></th>
				<th><center>Action</center></th>
			</thead>
			<tbody>
			<?php
				$query_view = "SELECT book_tbl.*, reservation_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ', (author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN account_tbl ON reservation_tbl.account_number = account_tbl.account_number WHERE reservation_tbl.account_number = '$account_number' AND reservation_tbl.reserve_status = 'Pending' GROUP BY book_tbl.book_id";
				$result_view = $con->query($query_view);
				while($row_view = $result_view->fetch_assoc())
				{
					$book_image = $row_view['book_image'];
					$book_id = $row_view['book_id'];
					$call_number = $row_view['call_number'];
					$book_title = $row_view['book_title'];
					$authors_name = $row_view['authors_name'];
					$copyright_year = $row_view['copyright_year'];
					$edition = $row_view['edition'];
					$volume = $row_view['volume'];
					$date_reserved = $row_view['reserve_date'];
					$reserve_date = date("m/d/Y", strtotime($date_reserved));
					$date_expired = $row_view['expiration_date'];
					$expiration_date = date("m/d/Y", strtotime($date_expired));
							
					$query_count = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
					$result_count = $con->query($query_count);
					$row_count = $result_count->fetch_assoc();
					$copies = $row_count['COUNT(*)'];
					?>
					<tr>
						<td>
						<?php 
							if($book_image != "")
							{
								?>
								<img src="../admin/uploads/books/<?php echo $book_image; ?>" class="table-images"/>
								<?php
							}
							else
							{
								?>
								<img src="../admin/uploads/books/default.jpg" class="table-images"/>
								<?php 
							}
						?>
							<center>
								<a href="#" onclick="bookImageModal(<?php echo $book_id; ?>)" title="View book image">View Photo</a>
							</center>
						</td>
						<td><?php echo $call_number; ?></td>
						<td><?php echo $book_title; ?></td>
						<td><?php echo $authors_name; ?></td>
						<td><?php echo $copyright_year; ?></td>
						<td><?php echo $edition; ?></td>
						<td>
						<?php
						 	if($volume != 0)
						 	{
						 		echo $volume;
						 	}
						 ?>
						</td>
						<td><?php echo $reserve_date; ?></td>
						<td><?php echo $expiration_date; ?></td>
						<td>
							<center>
								<button class="btn btn-danger btn-sm" id="remove-modal-<?php echo $book_id; ?>" onclick="removeReserveModal(<?php echo $book_id; ?>)" title="Remove Reservation">
									<span class="fa fa-remove"></span>
								</button>
							</center>
						</td>
					</tr>
					<?php
				}
			?>
			</tbody>
		</table>
	</div>