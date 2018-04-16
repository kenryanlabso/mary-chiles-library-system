<?php
	include("db_con.php");
	
	if(isset($_GET['filter']))
	{
		$filter = $_GET['filter'];
		if($filter == "specific")
		{
			$book_id = $_GET['book-id'];
			if(isset($_GET['info']))
			{
				$query_info = "SELECT book_tbl.*, acquisition_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id LEFT JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE book_tbl.book_id = '$book_id'";
				$result_info = $con->query($query_info);
				$row_info = $result_info->fetch_assoc();


				$call_number = $row_info['call_number'];
				$book_title = $row_info['book_title'];
				$book_image = $row_info['book_image'];
				$authors_name = $row_info['authors_name'];
				$copyright_year = $row_info['copyright_year'];
				$edition = $row_info['edition'];
				$volume = $row_info['volume'];
				$category = $row_info['classname'];
				$isbn = $row_info['isbn'];
				$pages = $row_info['pages'];
				$publisher_name = $row_info['publisher_name'];

				?>
				<div class="book-image">
					<label>Image:</label>
					<?php
						if($book_image != "")
						{
							echo "<img src='uploads/books/".$book_image."'/>";
						}
						else
						{
							echo "<img src='uploads/books/default.jpg'/>";	
						}
					?>
				</div>
				<div class="book-information">
					<h4><b><u>Book Information</u></b></h4>
					<table>
						<tr>
							<td><strong>Call No:</strong>
							<td><?php echo $call_number; ?></td>
						</tr>
						<tr>
							<td><strong>Title:</strong></td>
							<td><?php echo $book_title; ?></td>
						</tr>
						<tr>
							<td><strong>Authors:</strong></td>
							<td><?php echo $authors_name; ?></td>
						</tr>
						<tr>
							<td><strong> Year:</strong></td>
							<td><?php echo "c".$copyright_year; ?></td>
						</tr>
						<tr>
							<td><strong>Category:</strong></td>
							<td><?php echo $category; ?></td>
						</tr>
						<tr>
							<td><strong>Publisher:</strong></td>
							<td><?php echo $publisher_name; ?></td>
						</tr>
						<tr>
							<td><strong>ISBN:</strong></td>
							<td><?php echo $isbn; ?></td>
						</tr>
						<tr>
							<td><strong>Pages:</strong></td>
							<td><?php echo $pages; ?></td>
						</tr>
					</table>
				</div>
				<?php
			}
			else
			{
				?>
				<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
				<div class="form-buttons">
					<button class="btn btn-danger pull-right">
						<span class="fa fa-trash"></span>
						&nbsp;Archive
					</button>
				</div>

				<button id="return-page-book" class="btn btn-success" onclick="returnPageBook()" title="Back">
					<span class="fa fa-arrow-left"></span>
				</button>

				<div style="font-size:22px; font-weight:bold;">Records:</div>
				<div class="table table-responsive">
					<table class="table table-striped table-hover" id="example">
						<thead>
							<th><center>Accession</center></th>
							<th><center>Source</center></th>
							<th><center>Date Added</center></th>
							<th><center>Book Status</center></th>
							<th><center>Barcode</center></th>
						</thead>
						<tbody>
						<?php
							$query_view = "SELECT book_tbl.*, acquisition_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id LEFT JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE book_tbl.book_id = '$book_id' AND acquisition_tbl.book_status != 'Archived' GROUP BY acquisition_tbl.accession_number";
							$result_view = $con->query($query_view);
							while($row_view = $result_view->fetch_assoc())
							{
								$accession_no = $row_view['accession_number'];
								$date_added = $row_view['date_acquired'];
								$date_acquired = date("m/d/Y", strtotime($date_added));
								$book_id = $row_view['book_id'];
								$call_number = $row_view['call_number'];
								$book_title = $row_view['book_title'];
								$authors_name = $row_view['authors_name'];
								$copyright_year = $row_view['copyright_year'];
								$edition = $row_view['edition'];
								$volume = $row_view['volume'];
								$category = $row_view['classname'];
								$isbn = $row_view['isbn'];
								$pages = $row_view['pages'];
								$publisher_name = $row_view['publisher_name'];
								$fund_source = $row_view['fund_source'];
								$book_image = $row_view['book_image'];
								$book_status = $row_view['book_status'];
								
								$query_count = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
								$result_count = $con->query($query_count);
								$row_count = $result_count->fetch_assoc();
								$copies = $row_count['COUNT(*)'];
								?>
								<tr>
									<td>
									<?php 
										$accession_length = strlen($accession_no);
										for($i=$accession_length;$i<6;$i++)
										{
											if($i != 0)
											{
												echo 0;
											}
										}
										echo $accession_no;
									?>
									</td>
									<td><?php echo $fund_source; ?></td>
									<td><?php echo $date_acquired; ?></td>
									<td><?php echo $book_status; ?></td>
									<td>
										<div class="action-buttons">
											<button class="btn btn-warning btn-sm" onclick="editBookByIdModal(<?php echo $accession_no; ?>)" title="Update book information">
												<span class="fa fa-pencil"></span>
											</button>
											<button class="btn btn-info btn-sm" onclick="bookBarcodeModal(<?php echo $accession_no; ?>)" title="View book barcode">
												<span class="fa fa-barcode"></span>
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
				<?php
			}
		}
		else if($filter == "accession")
		{
			?>
			<div class="filter-menu">
				<button class="btn btn-info" title="Filter by book title" onclick="filterTitle()">Book Title</button>
				<button class="btn btn-info active" title="Filter by accession" onclick="filterAccession()" disabled>Accession No.</button>
			</div>

			<button class="btn btn-info pull-right" onclick="printBarcodesModal()" title="Click here to print barcodes">
				<span class="fa fa-print"></span>
				&nbsp;Barcode
			</button>

			<button class="btn btn-success pull-right" onclick="showAddBookCopy()" title="Click here to copy of existing book"style="margin-right:3px;">
			&nbsp;<span class="fa fa-copy"></span>
			Add Copy
			</button>

			<button class="btn btn-primary pull-right" onclick="window.location='books.php?page=add-book';" title="Click here to add new book" style="margin-right:3px;">
				<span class="fa fa-plus"></span>
			&nbsp;Add New Book</button>


			<button id="return-page-book" class="btn btn-success" onclick="returnPageBook()" title="Back">
				<span class="fa fa-arrow-left"></span>
			</button>

			<div style="font-size:22px; font-weight:bold;">Records:</div>
			<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
			<div class="table table-responsive">
				<table class="table table-striped table-hover" id="example">
					<thead>
						<th><center>Accession</center></th>
						<th><center>Call No.</center></th>
						<th><center>Book Title</center></th>
						<th><center>Authors</center></th>
						<th><center>Year</center></th>
						<th><center>Edition</center></th>
						<th><center>Volume</center></th>
						<th><center>Publisher</center></th>
						<th><center>ISBN</center></th>
						<th><center>Source</center></th>
						<th><center>Added</center></th>
						<th><center>Status</center></th>
						<th><center>Action</center></th>
					</thead>
					<tbody>
					<?php
						$query_view = "SELECT book_tbl.*, acquisition_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE acquisition_tbl.book_status != 'Archived' GROUP BY acquisition_tbl.accession_number";
						$result_view = $con->query($query_view);
						while($row_view = $result_view->fetch_assoc())
						{
							$accession_no = $row_view['accession_number'];
							$date_added = $row_view['date_acquired'];
							$date_acquired = date("m/d/Y", strtotime($date_added));
							$book_id = $row_view['book_id'];
							$call_number = $row_view['call_number'];
							$book_title = $row_view['book_title'];
							$authors_name = $row_view['authors_name'];
							$copyright_year = $row_view['copyright_year'];
							$edition = $row_view['edition'];
							$volume = $row_view['volume'];
							$category = $row_view['classname'];
							$isbn = $row_view['isbn'];
							$pages = $row_view['pages'];
							$publisher_name = $row_view['publisher_name'];
							$fund_source = $row_view['fund_source'];
							$book_image = $row_view['book_image'];
							$book_status = $row_view['book_status'];
							
							$query_count = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id'";
							$result_count = $con->query($query_count);
							$row_count = $result_count->fetch_assoc();
							$copies = $row_count['COUNT(*)'];
							?>
							<tr>
								<td>
								<?php 
									$accession_length = strlen($accession_no);
									for($i=$accession_length;$i<6;$i++)
									{
										if($i != 0)
										{
											echo 0;
										}
									}
									echo $accession_no;
								?>
								</td>
								<td><?php echo $call_number; ?></td>
								<td><?php echo $book_title; ?></td>
								<td><?php echo $authors_name; ?></td>
								<td><?php echo "c".$copyright_year; ?></td>
								<td><?php echo $edition; ?></td>
								<td>
								<?php
								 	if($volume != 0)
								 	{
								 		echo $volume;
								 	}
								 ?>
								</td>
								<td><?php echo $publisher_name; ?></td>
								<td><?php echo $isbn; ?></td>
								<td><?php echo $fund_source; ?></td>
								<td><?php echo $date_acquired; ?></td>
								<td><?php echo $book_status; ?></td>
								<td>
									<center>
										<div style="width:80px; margrin:auto; margin-bottom:3px;">
											<button class="btn btn-warning btn-sm" onclick="editBookByIdModal(<?php echo $accession_no; ?>)" title="Update book information">
												<span class="fa fa-pencil"></span>
											</button>
											<?php
												if($book_status == "Available")
												{
													?>
													<button class="btn btn-danger btn-sm" onclick="deleteBookModal(<?php echo $accession_no; ?>)" title="Delete book">
														<span class="fa fa-trash"></span>
													</button>
													<?php
												}
												else
												{
													?>
													<button class="btn btn-danger btn-sm" onclick="deleteBookModal(<?php echo $accession_no; ?>)" title="Delete book" disabled>
														<span class="fa fa-trash"></span>
													</button>
													<?php
												}

											?>
											
										</div>

										<div style="width:80px; margrin:auto;">
											<button class="btn btn-default btn-sm" onclick="bookBarcodeModal(<?php echo $accession_no; ?>)" title="View book barcode">
												<span class="fa fa-barcode"></span>
											</button>

											<button class="btn btn-info btn-sm" onclick="viewBookImageModal(<?php echo $book_id; ?>)" title="View book image">
												<span class="fa fa-photo"></span>
											</button>
										</div>
									</center>									
								</td>
							</tr>
							<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="filter-menu">
				<button class="btn btn-info active" title="Filter by book title" disabled>Book Title</button>
				<button class="btn btn-info" title="Filter by accession" onclick="filterAccession()">Accession No.</button>
			</div>

			<button class="btn btn-success pull-right" onclick="showAddBookCopy()" title="Click here to copy of existing book"style="margin-right:3px; margin-bottom:15px;">
			&nbsp;<span class="fa fa-copy"></span>
			Add Copy
			</button>

			<a class="btn btn-primary pull-right" href="books.php?page=add-book" title="Click here to add new book" style="margin-right:3px; margin-bottom:15px;">
				<span class="fa fa-plus"></span>
				&nbsp;Add New Book
			</a>
			
			<div style="font-size:22px; font-weight:bold;">Records:</div>
			<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
			<div class="table table-responsive">
				<table class="table table-striped table-hover" id="example">
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
						<th><center>ISBN</center></th>
						<th><center>Pages</center></th>
						<th><center>Price</center></th>
						<th><center>Copies</center></th>
						<th><center>Action</center></th>
					</thead>
					<tbody>
					<?php
						$query_view = "SELECT book_tbl.*, acquisition_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS authors_name FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id LEFT JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id GROUP BY book_tbl.book_id";
						$result_view = $con->query($query_view);
						while($row_view = $result_view->fetch_assoc())
						{
							$accession_no = $row_view['accession_number'];
							$date_added = $row_view['date_acquired'];
							$date_acquired = date("m/d/Y", strtotime($date_added));
							$book_id = $row_view['book_id'];
							$call_number = $row_view['call_number'];
							$book_title = $row_view['book_title'];
							$authors_name = $row_view['authors_name'];
							$copyright_year = $row_view['copyright_year'];
							$edition = $row_view['edition'];
							$volume = $row_view['volume'];
							$category = $row_view['classname'];
							$isbn = $row_view['isbn'];
							$pages = $row_view['pages'];
							$publisher_name = $row_view['publisher_name'];
							$fund_source = $row_view['fund_source'];
							$book_price = $row_view['book_price'];
							$book_image = $row_view['book_image'];
							
							$query_count = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON book_tbl.book_id = acquisition_tbl.book_id WHERE book_tbl.book_id = '$book_id' AND acquisition_tbl.book_status != 'Archived'";
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
										<img src="uploads/books/<?php echo $book_image; ?>" class="table-images"/>
										<?php
									}
									else
									{
										?>
										<img src="uploads/books/default.jpg" class="table-images"/>
										<?php 
									}
								?>

									<center>
										<a href="#" onclick="bookImageModal(<?php echo $book_id; ?>)" title="Update book image">Edit Photo</a>
									</center>
								</td>
								<td><?php echo $call_number; ?></td>
								<td><?php echo $book_title; ?></td>
								<td><?php echo $authors_name; ?></td>
								<td><?php echo "c".$copyright_year; ?></td>
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
								<td><?php echo $isbn; ?></td>
								<td>
								<?php 
									if($pages != 0)
									{
										echo $pages;
									}
								?>
								</td>
								<td><?php echo $book_price; ?></td>
								<td><?php echo $copies; ?></td>
								<td>
									<div class="action-buttons">
										<button class="btn btn-warning btn-sm" onclick="editBookModal(<?php echo $book_id; ?>)" title="Edit book information">
											<span class="fa fa-pencil"></span>
										</button>
										<button class="btn btn-primary btn-sm" onclick="filterSpecificBook(<?php echo $book_id; ?>)" title="View all copies">
											<span class="fa fa-search"></span>
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
			<?php
		}
	}
?>
