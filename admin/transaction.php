<?php
	include("session.php");
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");
	include("modal/remove_cart_modal.php");
	include("modal/confirm_borrow_print_modal.php");
	include("modal/confirm_return_print_modal.php");
	include("modal/empty_borrow_cart_modal.php");
	include("modal/empty_return_cart_modal.php");

	if(isset($_GET['page']))
	{
		$page =$_GET['page'];
		if($page == "borrow") 
		{
			if(isset($_GET['print']))
			{
				$borrower_id = $_GET['print'];
				$today_date = date("Y-m-d H:i:s");
				$time_stamp = date("Y-m-d H:i:s", strtotime($today_date."- 2 minutes"));

				$query_check = "SELECT COUNT(*) FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
				$result_check = $con->query($query_check);
				$row_check = $result_check->fetch_assoc();
				$check_result = $row_check['COUNT(*)'];

				if($check_result > 0)
				{
					$query_info = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
					$result_info = $con->query($query_info);
					$row_info = $result_info->fetch_assoc();

					$borrower_name = $row_info['student_fname']." ".$row_info['student_mi'].". ".$row_info['student_lname'];
				}
				else
				{
					$query_info = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
					$result_info = $con->query($query_info);
					$row_info = $result_info->fetch_assoc();

					$borrower_name = $row_info['employee_fname']." ".$row_info['employee_mi'].". ".$row_info['employee_lname'];
				}
				?>

				<button class="btn btn-default" onclick="window.print();" title="Print receipt">
					<span class="fa fa-print">&nbsp;
					</span>Print
				</button>
				<div class="borrow-receipt">
					<div class="receipt-header">
						<center>
							<b>MARY CHILES COLLEGE</b><br/>
							667 Dalupan Street,
							<p>Sampaloc, Metro Manila</p>
							<b>CHECK-OUT RECEIPT</b>
						</center>
					</div>
					<table>
						<tr>
							<td><strong>NAME:&nbsp;</strong></td>
							<td><?php echo strtoupper($borrower_name); ?></td>
						</tr>
						<tr>
							<td><strong>ID:&nbsp;</strong></td>
							<td><?php echo $borrower_id; ?></td>
						</tr>
						<tr>
							<td><strong>DATE:&nbsp;</strong></td>
							<td><?php echo $today_date; ?></td>
						</tr>
					</table>
					<table class="transaction-table">
						<thead>
							<th><center>CALL NO.</center></th>
							<th><center>BOOK TITLE</center></th>
							<th><center>DUE DATE</center></th>
						</thead class="transaction-table-header">
						<tbody>
							<?php
								$query_borrow = "SELECT * FROM transaction_tbl INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.return_date = '0000-00-00' AND transaction_tbl.borrow_date > '$time_stamp' AND transaction_tbl.account_number = '$borrower_id'";
								$result_borrow = $con->query($query_borrow);
								while($row_borrow = $result_borrow->fetch_assoc())
								{
									$call_number = $row_borrow['call_number'];
									$book_title = strtoupper($row_borrow['book_title']);
									$due_date = $row_borrow['due_date'];
									?>
									<tr>
										<td><?php echo strtoupper($call_number); ?></td>
										<td><?php echo substr($book_title, 0, 10)."..."; ?></td>
										<td><?php echo strtoupper($due_date); ?></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
					<p style="margin-top:10px; margin-left:25%;"><b>SERVED BY: _______________</b></p>
					<div class="receipt-footer">
						<center>
							Have a productive day.<br>
							Keep Learning! :)<br>
						</center>
					</div>
				</div>
				<?php
				echo "<script>window.print();</script>";
			}
			else
			{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-user"></span>
						&nbsp;Borrow
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("D | F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<!--Borrow Cart-->
					<div class="borrow-cart">
						<div class="borrower-info">
							<table>
								<thead><h4><b><u>Transaction Details:</u></b></h4>
								</thead>
								<tbody>
									<tr>
										<td><b>Account No:</b></td>
										<td id="borrower-id"></td>
									</tr>
									<tr>
										<td><b>Name:</b></td>
										<td id="borrower-name"></td>
									</tr>
									<tr>
										<td><b>Type:</b></td>
										<td id="borrower-type"></td>
									</tr>
									<tr>
										<td><b>Borrow Date:</b></td>
										<td id="borrow-date"><?php echo "&nbsp;".date("F d, Y"); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<table class="table table-bordered table-hover borrow-table">
							<thead>
								<th>Call No.</th>
								<th>Book Title</th>
								<th>Authors</th>
								<th>Year</th>
								<th>Edition</th>
								<th>Volume</th>
								<th>Due Date</th>
								<th width="72">Remove</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="transaction-loader">
							<span class="fa fa-spinner fa-spin" style="font-size:25px;"></span>
							&nbsp;Processing...
						</div>
						<div class="pull-right">
							<input type="hidden" id="sum-rows-borrow"/>
							<button id="borrow-empty-cart" class="btn btn-warning" onclick="emptyBorrowCartModal()">Empty Cart</button>
							<button id="borrow-submit-print" class="btn btn-default" onclick="processBorrow(1)">Print</button>
							<button id="borrow-submit" class="btn btn-primary" onclick="confirmBorrowPrintModal()">Done</button>
						</div>
					</div>
					<!--/Borrow Cart-->

					<!--Borrow Form-->
					<div class="borrow-form">
						<label for="account-number">Account Number:</label>
						<select id="account-number" name="account-number" style="width:100%;">
							<option></option>
							<?php
								$query_student = "SELECT * FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_student = $con->query($query_student);
								while($row_student = $result_student->fetch_assoc())
								{
									$student_number = $row_student['student_id'];
									$student_name = $row_student['student_fname']." ".$row_student['student_mi'].". ".$row_student['student_lname'];
									?>
									<option value="<?php echo $student_number; ?>"><?php echo "(S) ".$student_number." - ".$student_name; ?></option>
									<?php
								}
								$query_employee = "SELECT * FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number WHERE account_tbl.account_type = 'Regular' AND account_tbl.account_status = 'Active'";
								$result_employee = $con->query($query_employee);
								while($row_employee = $result_employee->fetch_assoc())
								{
									$employee_number = $row_employee['employee_id'];
									$employee_name = $row_employee['employee_fname']." ".$row_employee['employee_mi'].". ".$row_employee['employee_lname'];
									?>
									<option value="<?php echo $employee_number; ?>"><?php echo "(E) ".$employee_number." - ".$employee_name; ?></option>
									<?php
								}
							?>
						</select>

					<form>
						<label for="barcode-number">Barcode Number:</label>
						<input type="text" id="barcode-number" name="barcode-number" class="form-control" maxlength="20"/>

						<div class="form-loader">
							<span class="fa fa-spinner fa-spin"></span>
						</div>

						<p id="transaction-error"></p>

						<div class="form-buttons">
							<button id="check-borrow" class="btn btn-primary">Check</button>
						</div>
					</form>

					</div>
					<!--/Borrow Form-->

					<!--Book Details-->
					<div class="book-details">
						<h3><u><b>Book Details:</b></u></h3>
						<input type="hidden" id="book-id"/>
						<strong>Call Number:</strong>
						<p id="call-number" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Book Title:</strong>
						<p id="book-title" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Copyright Year:</strong>
						<p id="copyright-year" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Edition:</strong>
						<p id="edition" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Volume:</strong>
						<p id="volume" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Authors:</strong>
						<p id="book-authors" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Category:</strong>
						<p id="category" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Publisher:</strong>
						<p id="publisher" style="margin-left:20px; margin-bottom:5px;" ></p>
						<strong>ISBN:</strong>
						<p id="isbn" style="margin-left:20px; margin-bottom:5px;"></p>
					</div>
					<!--/Book Details-->
				</div>
				<!--/Page Body-->
				<script type="text/javascript">
				$(document).ready(function () 
				{
				   $("#account-number").select2(
				    {
				       placeholder: "Select account",
				       allowClear: true
				   });
				});
				</script>
			</body>
			<?php
				include("footer.php");
			}
		}
		else if($page == "return")
		{
			if(isset($_GET['print']))
			{
				$borrower_id = $_GET['print'];
				$today_date = date("Y-m-d H:i:s");
				$time_stamp = date("Y-m-d H:i:s", strtotime($today_date."- 2 minutes"));

				$query_check = "SELECT COUNT(*) FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
				$result_check = $con->query($query_check);
				$row_check = $result_check->fetch_assoc();
				$check_result = $row_check['COUNT(*)'];

				if($check_result > 0)
				{
					$query_info = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
					$result_info = $con->query($query_info);
					$row_info = $result_info->fetch_assoc();

					$borrower_name = $row_info['student_fname']." ".$row_info['student_mi'].". ".$row_info['student_lname'];
				}
				else
				{
					$query_info = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number WHERE account_tbl.account_number = '$borrower_id'";
					$result_info = $con->query($query_info);
					$row_info = $result_info->fetch_assoc();

					$borrower_name = $row_info['employee_fname']." ".$row_info['employee_mi'].". ".$row_info['employee_lname'];
				}
				?>

				<button class="btn btn-default" onclick="window.print();" title="Print receipt">
					<span class="fa fa-print">&nbsp;
					</span>Print
				</button>
				<div class="borrow-receipt">
					<div class="receipt-header">
						<center>
							<b>MARY CHILES COLLEGE</b><br/>
							667 Dalupan Street,
							<p>Sampaloc, Metro Manila</p>
							<b>RETURN BOOK RECEIPT</b>
						</center>
					</div>
					<table>
						<tr>
							<td><strong>NAME:&nbsp;</strong></td>
							<td><?php echo strtoupper($borrower_name); ?></td>
						</tr>
						<tr>
							<td><strong>ID:&nbsp;</strong></td>
							<td><?php echo $borrower_id; ?></td>
						</tr>
						<tr>
							<td><strong>DATE:&nbsp;</strong></td>
							<td><?php echo $today_date; ?></td>
						</tr>
					</table>
					<table class="transaction-table">
						<thead>
							<th><center>CALL NO.</center></th>
							<th><center>BOOK TITLE</center></th>
							<th><center>DUE DATE</center></th>
						</thead class="transaction-table-header">
						<tbody>
							<?php
								$query_return = "SELECT * FROM transaction_tbl INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.return_date != '0000-00-00' AND transaction_tbl.return_date > '$time_stamp' AND transaction_tbl.account_number = '$borrower_id'";
								$result_return = $con->query($query_return);
								while($row_return = $result_return->fetch_assoc())
								{
									$call_number = $row_return['call_number'];
									$book_title = strtoupper($row_return['book_title']);
									$due_date = $row_return['due_date'];
									?>
									<tr>
										<td><?php echo strtoupper($call_number); ?></td>
										<td><?php echo substr($book_title, 0, 10)."..."; ?></td>
										<td><?php echo strtoupper($due_date); ?></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
					<?php
						$query_check_penalty = "SELECT * FROM penalty_tbl INNER JOIN transaction_tbl ON transaction_tbl.transaction_id = penalty_tbl.transaction_id WHERE penalty_tbl.payment_status = 'Pending' AND transaction_tbl.return_date != '0000-00-00 00:00:00' AND transaction_tbl.transaction_status = 'Returned' AND transaction_tbl.account_number = '$borrower_id'";
						$result_check_penalty = $con->query($query_check_penalty);
						$penalty_found = $result_check_penalty->num_rows;
						if($penalty_found > 0)
						{
							$penalty_amount = 0;
							while($row_penalty_amount = $result_check_penalty->fetch_assoc())
							{
								$penalty_amount = $penalty_amount + $row_penalty_amount['amount_receivable'];
							}
							
							?>
							<b>NOTE: </b>There is a corresponding penalty charge(s) of <?php echo $penalty_amount.".00"; ?> pesos found in your transaction records for not returning the book(s) on or before its due date. Please pay in the cashier then show the receipt to the librarian for the clearance of your penalty charge(s).<br/>
							<?php
						}
					?>	
					<p style="margin-top:10px; margin-left:25%;"><b>SERVED BY: _______________</b></p>
					<div class="receipt-footer">
						<center>
							Have a productive day.<br>
							Keep Learning! :)<br>
						</center>
					</div>
				</div>
				<?php
				echo "<script>window.print();</script>";
			}
			else
			{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-user"></span>
						&nbsp;Return
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("D | F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!--/Form Header-->

					<!--Return Cart-->
					<div class="return-cart">
						<div class="borrower-info">
							<table>
								<thead><h4><b><u>Transaction Details:</u></b></h4>
								</thead>
								<tbody>
									<tr>
										<td><b>Account No:</b></td>
										<td id="borrower-id"></td>
									</tr>
									<tr>
										<td><b>Name:</b></td>
										<td id="borrower-name"></td>
									</tr>
									<tr>
										<td><b>Return Date:</b></td>
										<td id="return-date"><?php echo "&nbsp;".date("F d, Y"); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<table class="table table-bordered table-hover return-table">
							<thead>
								<th>Call No.</th>
								<th>Book Title</th>
								<th>Due Date</th>
								<th>Days Exceed</th>
								<th>Rate</th>
								<th>Charge</th>
								<th>Remarks</th>
								<th width="72">Remove</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="transaction-loader">
							<span class="fa fa-spinner fa-spin" style="font-size:25px;"></span>
							&nbsp;Processing...
						</div>

						<div class="pull-right">
							<input type="hidden" id="sum-rows-borrow"/>
							<button id="borrow-empty-cart" class="btn btn-warning" onclick="emptyReturnCartModal()">Empty Cart</button>
							<button id="borrow-submit-print" class="btn btn-default" onclick="processReturn(1)">Print</button>
							<button id="borrow-submit" class="btn btn-primary" onclick="confirmReturnPrintModal()">Return</button>
						</div>
					</div>
					<!--/Return Cart-->

					<!--Return Form-->
					<form>
						<div class="return-form">
							<label for="barcode-number">Barcode Number:</label>
							<input type="text" id="barcode-number" name="barcode-number" class="form-control" maxlength="20" autofocus/>

							<div class="form-loader">
								<span class="fa fa-spinner fa-spin"></span>
							</div>

							<p id="transaction-error"></p>

							<div class="form-buttons">
								<button id="check-return" class="btn btn-primary">Check</button>
							</div>
						</div>
					</form>
					<!--/Return Form-->

					<!--Book Details-->
					<div class="book-details">
						<h3><u><b>Book Details:</b></u></h3>
						<strong>Call Number:</strong>
						<p id="call-number" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Book Title:</strong>
						<p id="book-title" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Copyright Year:</strong>
						<p id="copyright-year" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Edition:</strong>
						<p id="edition" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Volume:</strong>
						<p id="volume" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Authors:</strong>
						<p id="book-authors" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Category:</strong>
						<p id="category" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Publisher:</strong>
						<p id="publisher" style="margin-left:20px; margin-bottom:5px;" ></p>
						<strong>ISBN:</strong>
						<p id="isbn" style="margin-left:20px; margin-bottom:5px;"></p>
					</div>
					<!--/Book Details-->
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
			}
		}
		else if($page == "renew")
		{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-retweet"></span>
						&nbsp;Renew
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("D | F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!--/Form Header-->

					<!--Renew Cart-->
					<div class="renew-cart">
						<div class="borrower-info">
							<table>
								<thead><h4><b><u>Transaction Details:</u></b></h4>
								</thead>
								<tbody>
									<tr>
										<td><b>Account No:</b></td>
										<td id="borrower-id"></td>
									</tr>
									<tr>
										<td><b>Name:</b></td>
										<td id="borrower-name"></td>
									</tr>									
									<tr>
										<td><b>Renew Date:</b></td>
										<td id="return-date"><?php echo "&nbsp;".date("F d, Y"); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<table class="table table-bordered table-hover return-table">
							<thead>
								<th>Call No.</th>
								<th>Book Title</th>
								<th>Due Date</th>
								<th>Days Exceed</th>
								<th>Rate</th>
								<th>Charge</th>
								<th>Remarks</th>
								<th width="72">Remove</th>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="transaction-loader">
							<span class="fa fa-spinner fa-spin" style="font-size:25px;"></span>
							&nbsp;Processing...
						</div>


						<div class="pull-right">
							<input type="hidden" id="sum-rows-borrow"/>
							<button class="btn btn-default">Cancel</button>
							<button id="borrow-submit" class="btn btn-primary" onclick="processRenew()">Renew</button>
						</div>
					</div>
					<!--/Renew Cart-->

					<!--Renew Form-->
					<form>
						<div class="renew-form">
							<label for="barcode-number">Barcode Number:</label>
							<input type="text" id="barcode-number" name="barcode-number" class="form-control" maxlength="20" autofocus/>

							<div class="form-loader">
								<span class="fa fa-spinner fa-spin"></span>
							</div>

							<p id="transaction-error"></p>

							<div class="form-buttons">
								<button id="check-renew" class="btn btn-primary">Check</button>
							</div>
						</div>
					</form>
					<!--/Renew Form-->

					<!--Book Details-->
					<div class="book-details">
						<h3><u><b>Book Details:</b></u></h3>
						<strong>Call Number:</strong>
						<p id="call-number" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Book Title:</strong>
						<p id="book-title" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Copyright Year:</strong>
						<p id="copyright-year" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Edition:</strong>
						<p id="edition" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Volume:</strong>
						<p id="volume" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Authors:</strong>
						<p id="book-authors" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Category:</strong>
						<p id="category" style="margin-left:20px; margin-bottom:5px;"></p>
						<strong>Publisher:</strong>
						<p id="publisher" style="margin-left:20px; margin-bottom:5px;" ></p>
						<strong>ISBN:</strong>
						<p id="isbn" style="margin-left:20px; margin-bottom:5px;"></p>
					</div>
					<!--/Book Details-->
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "guest")
		{
			include("modal/borrow_guest_modal.php");
			include("modal/return_guest_modal.php");
			include("modal/logout_guest_modal.php");
			include("modal/relog_guest_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">

					<div class="page-header">
						<span class="fa fa-users"></span>
						&nbsp;Manage Guest
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<!--Add Guest-->
					<div class="guest-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddGuest()" title="Close this form">&times;</button>
						</div>
						<form id="add-guest" method="POST" action="action/add_guest.php">
							<div class="author-form">
								<label for="receipt-number">Receipt Number:</label>
								<input type="text" id="receipt-number" name="receipt-number" class="form-control" maxlength="10" autofocus required/>
								<label for="guest-name">Guest Name:</label>
								<input type="text" id="guest-name" name="guest-name" class="form-control" maxlength="100" required/>
								<label for="school-company">School/Company:</label>
								<textarea id="school-company" name="school-company" class="form-control" maxlength="100" required></textarea>
								<label for="contact-number">Contact Number:</label>
								<input type="text" id="contact-number" name="contact-number" class="form-control" maxlength="15" required/>
								
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>

								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>

								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-guest" name="submit-guest" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<!--/Add Guest-->

					<!--View Authors-->
					<div class="guests-view"></div>

				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "user-log")
		{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">

					<div class="page-header">
						<span class="fa fa-file"></span>
						&nbsp;User Logs
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<div class="logs-view"></div>
				</div>
			</body>
			<?php
		}
		else
		{
			echo "<script>alert('Page not found!'); window.location='home.php'; </script>";
		}
	}
	else
	{
		echo "<script>alert('Page not found!'); window.location='home.php'; </script>";
	}

?>