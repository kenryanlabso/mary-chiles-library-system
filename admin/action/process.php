<?php
	include("../db_con.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "borrow")
		{
			if(isset($_POST['barcode-id']) && isset($_POST['account-id']))
			{
				$holidays = array();
				$barcode_id = $_POST['barcode-id'];
				$account_id = $_POST['account-id'];
				$account_type = $_POST['account-type'];
				$borrow_date = date("Y-m-d H:i:s");

				$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
				$result_holidays = $con->query($query_holidays);
				while($row_holidays = $result_holidays->fetch_assoc())
				{
					array_push($holidays, $row_holidays['holiday_date']);
				}

				$query_days = "SELECT * FROM settings_tbl WHERE settings_id = 1";
				$result_days = $con->query($query_days);
				$row_days = $result_days->fetch_assoc();
				$days_student = $row_days['borrow_days_student'];
				$days_employee = $row_days['borrow_days_employee'];
				
				if($account_type == "Student")
				{
					$days = $days_student = $row_days['borrow_days_student'];
				}
				else
				{
					$days = $days_employee = $row_days['borrow_days_employee'];
				}

				for($i=1;$i<=$days;$i++)
				{
					$day_of_week = date("D", strtotime($borrow_date."+ ".$i." days"));
					$temp_dates = date("Y-m-d", strtotime($borrow_date."+ ".$i." days"));

					if($day_of_week == "Sun")
					{
						$days++;
					}
					else if(in_array($temp_dates, $holidays))
					{
						$days++;	
					}
				}

				$due_date = date("Y-m-d", strtotime($borrow_date."+ ".$days." days"));

				$query_book = "SELECT * FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
				if($result_book = $con->query($query_book))
				{
					$row_book = $result_book->fetch_assoc();
					$accession_number = $row_book['accession_number'];
					$book_id = $row_book['book_id'];

					$query_borrow = "INSERT INTO transaction_tbl (account_number, accession_number, borrow_date, due_date, transaction_status) VALUES ('$account_id', '$accession_number', '$borrow_date', '$due_date', 'Borrowed')";
					if($result_borrow = $con->query($query_borrow))
					{
						$query_status = "UPDATE acquisition_tbl SET book_status = 'Borrowed' WHERE accession_number = '$accession_number'";
						if($result_status = $con->query($query_status))
						{
							$query_reserve = "UPDATE reservation_tbl SET reserve_status = 'Claimed' WHERE book_id = '$book_id' AND account_number = '$account_id' AND reserve_status = 'Pending'";
							$result_reserve = $con->query($query_reserve);
						}
					}
				}
			}
		}
		else if($page == "return")
		{
			if(isset($_POST['barcode-id']))
			{
				$barcode_id = $_POST['barcode-id'];
				$return_date = date("Y-m-d H:i:s");

				$query_book = "SELECT accession_number FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
				if($result_book = $con->query($query_book))
				{
					$row_book = $result_book->fetch_assoc();
					$accession_number = $row_book['accession_number'];

					$query_return = "UPDATE transaction_tbl SET return_date = '$return_date', transaction_status = 'Returned' WHERE return_date = '0000-00-00 00:00:00' AND transaction_status = 'Borrowed' AND accession_number = '$accession_number'";
					if($result_return = $con->query($query_return))
					{
						$query_status = "UPDATE acquisition_tbl SET book_status = 'Available' WHERE accession_number = '$accession_number'";
						$result_status = $con->query($query_status);
					}
				}
			}
		}
		else if($page == "renew")
		{
			if(isset($_POST['barcode-id']))
			{
				$holidays = array();
				$barcode_id = $_POST['barcode-id'];
				$renew_date = date("Y-m-d H:i:s");

				$query_holidays = "SELECT * FROM holiday_tbl WHERE holiday_delete = 0";
				$result_holidays = $con->query($query_holidays);
				while($row_holidays = $result_holidays->fetch_assoc())
				{
					array_push($holidays, $row_holidays['holiday_date']);
				}

				$query_days = "SELECT * FROM settings_tbl WHERE settings_id = 1";
				$result_days = $con->query($query_days);
				$row_days = $result_days->fetch_assoc();
				$days_student = $row_days['borrow_days_student'];
				$days_employee = $row_days['borrow_days_employee'];

				$query_accession = "SELECT accession_number FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
				if($result_accession = $con->query($query_accession))
				{
					$row_accession = $result_accession->fetch_assoc();
					$accession_number = $row_accession['accession_number'];

					$query_account = "SELECT account_number FROM transaction_tbl WHERE transaction_status = 'Borrowed' AND return_date = '0000-00-00 00:00:00' AND accession_number = '$accession_number'";
					$result_account = $con->query($query_account);
					$row_account = $result_account->fetch_assoc();
					$account_number = $row_account['account_number'];

					$query_check_type = "SELECT COUNT(*) FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE account_tbl.account_number = '$account_number'";
					$result_check_type = $con->query($query_check_type);
					$row_check_type = $result_check_type->fetch_assoc();
					$student_true = $row_check_type['COUNT(*)'];

					if($student_true > 0)
					{
						$days = $days_student;
					}
					else
					{
						$days = $days_employee;
					}

					for($i=1;$i<=$days;$i++)
					{
						$day_of_week = date("D", strtotime($renew_date."+ ".$i." days"));
						$temp_dates = date("Y-m-d", strtotime($renew_date."+ ".$i." days"));

						if($day_of_week == "Sun")
						{
							$days++;
						}
						else if(in_array($temp_dates, $holidays))
						{
							$days++;	
						}
					}
					
					$due_date = date("Y-m-d", strtotime("+ ".$days." days"));

					$query_return = "UPDATE transaction_tbl SET due_date = '$due_date' WHERE return_date = '0000-00-00 00:00:00' AND transaction_status = 'Borrowed' AND accession_number = '$accession_number'";
					$result_return = $con->query($query_return);
				}
			}
		}
		else if($page == "guest-borrow")
		{
			$guest_id = $_POST['guest-id'];
			$barcode_id = $_POST['barcode-id'];

			$query_check = "SELECT COUNT(*) FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_found = $row_check['COUNT(*)'];

			if($result_found == 1)
			{
				$query_accession = "SELECT accession_number FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
				if($result_accession = $con->query($query_accession))
				{
					$row_accession = $result_accession->fetch_assoc();
					$accession_number = $row_accession['accession_number'];

					$query_status = "SELECT book_status FROM acquisition_tbl WHERE accession_number = '$accession_number'";
					$result_status = $con->query($query_status);
					$row_status = $result_status->fetch_assoc();
					$book_status = $row_status['book_status'];

					if($book_status == "Available")
					{
						$query_loan = "INSERT INTO guest_transaction_tbl (guest_id, accession_number, guest_trans_status) VALUES ('$guest_id', '$accession_number', 'Borrowed')";
						if($result_loan = $con->query($query_loan))
						{
							$query_book = "UPDATE acquisition_tbl SET book_status = 'Borrowed' WHERE accession_number = '$accession_number'";
							$result_book = $con->query($query_book);
							$response = "Book added!";
							echo json_encode($response);	
						}
					}
					else if($book_status == "Borrowed")
					{
						$response = "Book is already borrowed.";
						echo json_encode($response);
					}
				}
			}
			else
			{
				$response = "Book not found.";
				echo json_encode($response);
			}
		}
		else if($page == "guest-return")
		{
			$guest_id = $_POST['guest-id'];
			$barcode_id = $_POST['barcode-id'];

			$query_check = "SELECT COUNT(*) FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_found = $row_check['COUNT(*)'];

			if($result_found > 0)
			{
				$query_accession = "SELECT accession_number FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
				if($result_accession = $con->query($query_accession))
				{
					$row_accession = $result_accession->fetch_assoc();
					$accession_number = $row_accession['accession_number'];

					$query_status = "SELECT book_status FROM acquisition_tbl WHERE accession_number = '$accession_number'";
					$result_status = $con->query($query_status);
					$row_status = $result_status->fetch_assoc();
					$book_status = $row_status['book_status'];
					$date_today = date("Y-m-d");

					if($book_status == "Borrowed")
					{
						$query_check_trans = "SELECT COUNT(*) FROM guest_tbl INNER JOIN guest_transaction_tbl ON guest_tbl.guest_id = guest_transaction_tbl.guest_id WHERE guest_tbl.guest_id = '$guest_id' AND guest_tbl.date_visited = '$date_today' AND guest_transaction_tbl.guest_trans_status = 'Borrowed' AND guest_transaction_tbl.accession_number = '$accession_number' AND guest_transaction_tbl.guest_id = '$guest_id'";
						$result_check_trans = $con->query($query_check_trans);
						$row_check_trans = $result_check_trans->fetch_assoc();
						$trans_true = $row_check_trans['COUNT(*)'];

						if($trans_true > 0)
						{
							$query_return = "UPDATE guest_transaction_tbl SET guest_trans_status = 'Returned' WHERE guest_id = '$guest_id' AND accession_number = '$accession_number'";
							if($result_return = $con->query($query_return))
							{
								$query_book = "UPDATE acquisition_tbl SET book_status = 'Available' WHERE accession_number = '$accession_number'";
								$result_book = $con->query($query_book);

								$response = "Book returned!";
								echo json_encode($response);
							}
						}
						else
						{
							$response = "This book is borrowed by a different person.";
							echo json_encode($response);
						}
					}
					else
					{
						$response = "Book is already on-shelf.";
						echo json_encode($response);
					}
				}
			}
			else
			{
				$response = "Book not found.";
				echo json_encode($response);
			}
		}
	}
?>