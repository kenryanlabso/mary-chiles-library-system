<?php 
	include("session.php");
	include("db_con.php");
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
				<th><center>Category</center></th>
				<th><center>Publisher</center></th>
				<th><center>Available</center></th>
				<th><center>Reserve</center></th>
			</thead>
			<tbody>
			<?php
				//View Books
				$query_view = "SELECT book_tbl.*, acquisition_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id LEFT JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id GROUP BY book_tbl.book_id";
				$result_view = $con->query($query_view);
				while($row_view = $result_view->fetch_assoc())
				{
					$account_number = $_SESSION['id'];
					$date_added = $row_view['date_acquired'];
					$book_id = $row_view['book_id'];
					$call_number = $row_view['call_number'];
					$book_title = $row_view['book_title'];
					$authors_name = $row_view['authors_name'];
					$copyright_year = $row_view['copyright_year'];
					$edition = $row_view['edition'];
					$volume = $row_view['volume'];
					$category = $row_view['classname'];
					$publisher_name = $row_view['publisher_name'];
					$book_image = $row_view['book_image'];
					
					//Total copies available		
					$query_count = "SELECT COUNT(*) FROM book_tbl INNER JOIN reservation_tbl ON book_tbl.book_id = reservation_tbl.book_id WHERE book_tbl.book_id = '$book_id' AND reservation_tbl.reserve_status = 'Pending'";
					$result_count = $con->query($query_count);
					$row_count = $result_count->fetch_assoc();
					$copies_reserve = $row_count['COUNT(*)'];

					//Total copies per title
					$query_total= "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
					$result_total = $con->query($query_total);
					$row_total = $result_total->fetch_assoc();
					$total_copies = $row_total['COUNT(*)'];
					$available_copies = $total_copies - $copies_reserve;

					//Validate if reserved already same title
					$query_check = "SELECT COUNT(*) FROM reservation_tbl WHERE book_id = '$book_id' AND account_number = '$account_number' AND reserve_status = 'Pending'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$reserve_count = $row_check['COUNT(*)'];
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
						<td><?php echo $category; ?></td>
						<td><?php echo $publisher_name; ?></td>
						<td><?php echo $available_copies."/".$total_copies; ?></td>
						<td>
							<center>
								<?php
									if($reserve_count == 1)
									{
										?>
										<button class="btn btn-primary btn-sm" id="call-modal-<?php echo $book_id; ?>" onclick="reserveBookModal(<?php echo $book_id; ?>)" title="Reserved already" disabled>
											<span class="fa fa-check"></span>
										</button>
										<?php
									}
									else
									{
										if($available_copies < 1)
										{
											?>
											<button class="btn btn-primary btn-sm" id="call-modal-<?php echo $book_id; ?>" onclick="reserveBookModal(<?php echo $book_id; ?>)" title="No more available copies of this book" disabled>
												<span class="fa fa-check"></span>
											</button>
											<?php
										}
										else
										{
											?>
											<button class="btn btn-primary btn-sm" id="call-modal-<?php echo $book_id; ?>" onclick="reserveBookModal(<?php echo $book_id; ?>)" title="Reserve Book">
												<span class="fa fa-check"></span>
											</button>
										<?php
										}
									}
								?>
							</center>
						</td>
					</tr>
					<?php
				}
			?>
			</tbody>
		</table>
	</div>