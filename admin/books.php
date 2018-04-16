<?php
	include("session.php");
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "add-book")
		{
			include("modal/add_author_modal.php");
			include("modal/add_publisher_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-book"></span>
						&nbsp;Books
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<!--Add Book-->
					<div class="book-add">
						<div class="form-closer">
							<button class="close" onclick="window.location='books.php';" title="Close this form">&times;</button>
						</div>
						<form id="add-book" enctype="multipart/form-data" method="POST" action="action/add_book.php">

							<div class="book-form">

								<div class="add-book-column-1">

									<label for="book-image">Book Image:</label>
									<input type="file" name="book-image" id="book-image" class="form-control" />

									<label for="accession-number">Accession Number:</label>
									<!--Accession Number-->
									<div class="accession-div"></div>
									<!--/Accession Number-->

									<label for="call-number">Call Number:</label>
									<input type="text" id="call-number" name="call-number" class="form-control" maxlength="15" autofocus required/>

									<label for="book-title">Book Title:</label>
									<input type="text" id="book-title" name="book-title" class="form-control" maxlength="100" required/>

									<button id="view-add-sub-author" class="btn btn-danger btn-xs pull-right" title="Click here to add sub-authors" onclick="subAuthorModal()" style="margin-left:5px;">
										<span class="fa fa-group"></span>
									</button>
									<a class="btn btn-primary btn-xs pull-right" title="Click here to add new author" onclick="addAuthorModal()">
										<span class="fa fa-plus"></span>
									</a>
									<label for="author-id">Author:</label><br/>
									<!--Author Choices-->
									<div class="authors-dropdown"></div>
									<!--/Author Choices-->

									<!--Sub Authors-->
									<div class="sub-authors-class">
										<label for="sub-authors">Contributors:</label>
										<textarea id="sub-authors" class="form-control" disabled></textarea>
									</div>
									<!--Sub Authors-->

									<label for="copyright-year">Copyright Year:</label>
									<input type="text" id="copyright-year" name="copyright-year" class="form-control" maxlength="4" required/>
									
									<label for="edition">Edition:</label>
									<input type="text" id="edition" name="edition" class="form-control" maxlength="20"/>

									<label for="volume">Volume:</label>
									<input type="text" id="volume" name="volume" class="form-control" maxlength="3"/>

								</div>	

								<div class="add-book-column-2">

									<label for="category-id">Category:</label><br/>
									<!--Category Choices-->
									<div class="categories-dropdown"></div>
									<!--/Category Choices-->

									<a class="btn btn-primary btn-xs pull-right" title="Click here to add new publisher" onclick="addPublisherModal()">
										<span class="fa fa-plus"></span>
									</a>
									<label for="publisher-id">Publisher:</label><br/>
									<!--Publisher Choices-->
									<div class="publishers-dropdown"></div>
									<!--/Publisher Choices-->

									<label for="isbn">ISBN:</label>
									<input type="text" id="isbn" name="isbn" class="form-control" maxlength="20" required>

									<label for="pages">Pages:</label>
									<input type="number" id="pages" name="pages" class="form-control" maxlength="5" required/>

									<label for="book-price">Price:</label>
									<input type="text" id="book-price" name="book-price" class="form-control" min="1" max="8"/>
									
									<label for="acquisition-type">Source:</label>
									<select id="acquisition-type" name="acquisition-type" class="form-control" required>
										<option></option>
										<option value="Purchased">Purchased</option>
										<option value="Complementary">Complementary</option>
										<option value="Donated">Donated</option>
									</select>

									<label for="copies">Copies:</label>
									<input type="number" id="copies" name="copies" class="form-control" min="1" max="50" required/>

									<input type="hidden" id="total-sub-authors" name="total-sub-authors" value="0"/>

									<div class="form-buttons">
										<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
										<button type="submit" id="submit-book" name="submit-book" class="btn btn-primary">Submit</button>
									</div>

									<div class="book-form-response">
										<span class="fa fa-check"></span>&nbsp;Successfully Added!
									</div>
									
									<div class="form-loader">
										<span class="fa fa-spinner fa-spin"></span>
									</div>
								</div>
								<?php include("modal/sub_author_modal.php"); ?>
							</div>
						</form>
					</div>
					<!--/Add Book-->
				</div>

			</body>
			<?php
			include("footer.php");
		}
		else if($page == "view-books")
		{
			include("modal/add_author_modal.php");
			include("modal/edit_book_author_modal.php");
			include("modal/edit_book_modal.php");
			include("modal/edit_book_image_modal.php");
			include("modal/edit_book_byid_modal.php");
			include("modal/book_barcode_modal.php");
			include("modal/delete_book_modal.php");
			include("modal/view_book_image_modal.php");
			include("modal/print_barcodes_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-book"></span>
						&nbsp;Books
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<!--Add Copy-->
					<div class="add-book-copy">
						<div class="form-closer">
							<button class="close" onclick="closeAddBookCopy()" title="Close this form">&times;</button>
						</div>

						<form id="add-copy-form" method="POST" action="action/add_copies.php">
							<label for="add-call-number">Call Number:</label>
							<select id="add-call-number" name="add-call-number" class="form-control" style="width:100%;" required>
								<option></option>
								<?php
									$query_call_number = "SELECT * FROM book_tbl";
									$result_call_number = $con->query($query_call_number);
									while($row_call_number = $result_call_number->fetch_assoc())
									{
										$book_id = $row_call_number['book_id'];
										$call_number = $row_call_number['call_number'];
										$book_title = $row_call_number['book_title'];
										?>
										<option value="<?php echo $book_id; ?>">
											<?php echo $call_number." (".$book_title.")"; ?>
										</option>
										<?php
									}
								?>
							</select>

							<label for="add-copies">Copies:</label>
							<input type="number" id="add-copies" name="add-copies" class="form-control" min="1" max="50" required/>

							<label for="add-source">Source of Fund:</label>
							<select id="add-source" name="add-source" class="form-control" style="width:100%;" required>
								<option></option>
								<option value="Purchased">Purchased</option>
								<option value="Donated">Donated</option>
								<option value="Complementary">Complementary</option>
							</select>

							<div id="add-copy-response">
								<span class="fa fa-check"></span>&nbsp;Added successfully.
							</div>

							<div class="form-buttons">
								<button type="submit" id="submit-copy" name="submit-copy" class="btn btn-primary" style="width:60px;" title="Submit">
									<tagname id="form-response">Add</tagname>
									<div id="form-loader">
										<span class="fa fa-spinner fa-spin"></span>
									</div>
								</button>
							</div>

							
						</form>
					</div>
					<!--/Add Copy-->
					<div class="book-infos"></div>
					<div class="books-view"></div>
				</div>
				<!--/Page Body-->
			</div>
				<!--/Page Body-->
				<script type="text/javascript">
				$(document).ready(function () 
				{
					$("#add-call-number").select2(
					{
						placeholder: "Select Book",
						allowClear: true
					});

					$("#add-source").select2(
					{
						placeholder: "Select Source",
						allowClear: true
					});
				});
				</script>
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "archived")
		{
			include("modal/restore_book_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-trash"></span>
						&nbsp;Archived Books
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<div class="archives-view"></div>
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "reserved")
		{
			include("modal/remove_reserve_modal.php");
			?>
				<body>
					<?php include("navigation_bar.php"); ?>
					<!---Page Body-->
					<div class="page-body">
						<!--Form Header-->
						<div class="page-header">
							<span class="fa fa-folder-open"></span>
							&nbsp;Reserved Books
							<div class="current-date">
								<span class="fa fa-calendar"></span>
								<?php
									$date_today = date("F d, Y | h:i A");
									echo "&nbsp;".$date_today;
								?>
							</div>
						</div>
						<div class="reservations-view"></div>
					</div>
					<!--/Page Body-->
				</body>
			<?php
			include("footer.php");
		}
		else if($page == "borrowed")
		{
			//include("modal/return_book_modal.php");
			?>
				<body>
					<?php include("navigation_bar.php"); ?>
					<!---Page Body-->
					<div class="page-body">
						<!--Form Header-->
						<div class="page-header">
							<span class="fa fa-folder-open"></span>
							&nbsp;Borrowed Books
							<div class="current-date">
								<span class="fa fa-calendar"></span>
								<?php
									$date_today = date("F d, Y | h:i A");
									echo "&nbsp;".$date_today;
								?>
							</div>
						</div>
						<div class="borrowed-view"></div>
					</div>
					<!--/Page Body-->
				</body>
			<?php
			include("footer.php");
		}
	}
	else
	{
		echo "<script>window.location='books.php?page=view-books';</script>";
	}
?>