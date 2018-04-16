<?php
	include("db_con.php");
	
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "borrow")
		{
			if(isset($_GET['link']))
			{		
				$link = $_GET['link'];
				if($link == "details")
				{
					$account_id = $_POST['account_id'];
					$barcode_id = $_POST['barcode_id'];

					$query_check = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_found = $row_check['COUNT(*)'];

					if($result_found < 1)
					{
						$query_check2 = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.book_status != 'Archived' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_check2 = $con->query($query_check2);
						$row_check2 = $result_check2->fetch_assoc();
						$result_found2 = $row_check2['COUNT(*)'];

						if($result_found2 == 1)
						{

							$query_allowed_books = "SELECT quantity_books_student, quantity_books_employee FROM settings_tbl WHERE settings_id = 1";
							$result_allowed_books = $con->query($query_allowed_books);
							$row_allowed_books = $result_allowed_books->fetch_assoc();
							$quantity_books_student = $row_allowed_books['quantity_books_student'];
							$quantity_books_employee = $row_allowed_books['quantity_books_employee'];

							$query_check_user = "SELECT COUNT(*) FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE student_id = '$account_id'";
							$result_check_user = $con->query($query_check_user);
							$row_check_user = $result_check_user->fetch_assoc();
							$user_result = $row_check_user['COUNT(*)'];

							if($user_result > 0 )
							{
								$allowed_books = $quantity_books_student;
							}
							else
							{
								$allowed_books = $quantity_books_employee;	
							}

							$query_total_borrowed = "SELECT COUNT(*) FROM transaction_tbl WHERE transaction_status = 'Borrowed' AND return_date = '0000-00-00 00:00:00' AND account_number = '$account_id'";
							$result_total_borrowed = $con->query($query_total_borrowed);
							$row_total_borrowed = $result_total_borrowed->fetch_assoc();
							$total_borrowed = $row_total_borrowed['COUNT(*)'];

							$query_total_reserved = "SELECT COUNT(*) FROM reservation_tbl WHERE reserve_status = 'Pending' AND account_number = '$account_id'";
							$result_total_reserved = $con->query($query_total_reserved);
							$row_total_reserved = $result_total_reserved->fetch_assoc();
							$total_reserved = $row_total_reserved['COUNT(*)'];

							$total_loads = $total_borrowed + $total_reserved;

							if($total_loads < $allowed_books)
							{
								$query_check_book = "SELECT book_id FROM acquisition_tbl WHERE barcode_id = '$barcode_id'";
								$result_check_book = $con->query($query_check_book);
								$row_check_book = $result_check_book->fetch_assoc();
								$book_id = $row_check_book['book_id'];

								$query_check_borrowed = "SELECT COUNT(*) FROM transaction_tbl INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.account_number = '$account_id' AND book_tbl.book_id = '$book_id' AND transaction_tbl.transaction_status = 'Borrowed'";
								$result_check_borrowed = $con->query($query_check_borrowed);
								$row_check_borrowed = $result_check_borrowed->fetch_assoc();
								$borrowed_copy = $row_check_borrowed['COUNT(*)'];

								if($borrowed_copy > 0)
								{
									$response = "The user already borrowed a copy of this book.";
									echo json_encode($response);
								}
								else
								{
									$query_total_reserved_copies = "SELECT COUNT(*) FROM reservation_tbl WHERE book_id = '$book_id' AND reserve_status = 'Pending'";
									$result_total_reserved_copies = $con->query($query_total_reserved_copies);
									$row_total_reserved_copies = $result_total_reserved_copies->fetch_assoc();
									$total_reserved_copies = $row_total_reserved_copies['COUNT(*)'];

									$query_total_available_copies = "SELECT COUNT(*) FROM acquisition_tbl WHERE book_id = '$book_id' AND book_status = 'Available'"; 	
									$result_total_available_copies = $con->query($query_total_available_copies);
									$row_total_available_copies = $result_total_available_copies->fetch_assoc();
									$total_available_copies = $row_total_available_copies['COUNT(*)'];

									if($total_reserved_copies < $total_available_copies)
									{
										$response = array();

										$query_book = "SELECT book_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS book_authors FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE acquisition_tbl.barcode_id = '$barcode_id'";
										$result_book = $con->query($query_book);
										$row_book = $result_book->fetch_assoc();
									
										$response = $row_book;
										echo json_encode($response);
									}
									else
									{
										$query_check_reserve = "SELECT COUNT(*) FROM reservation_tbl WHERE account_number = '$account_id' AND book_id = '$book_id' AND reserve_status = 'Pending'";
										$result_check_reserve = $con->query($query_check_reserve);
										$row_check_reservve = $result_check_reserve->fetch_assoc();
										$reservation_found = $row_check_reservve['COUNT(*)'];

										if($reservation_found > 0)
										{
											$response = array();
											$query_book = "SELECT book_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS book_authors FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id WHERE acquisition_tbl.barcode_id = '$barcode_id'";
											$result_book = $con->query($query_book);
											$row_book = $result_book->fetch_assoc();
										
											$response = $row_book;
											echo json_encode($response);
										}
										else
										{
											$response = "Book is already reserved by someone.";
											echo json_encode($response);
										}
									}
								}
							}
							else
							{
								$response = "You already reach the maximum loads.";
								echo json_encode($response);
							}
						}
						else
						{
							$response = "Book not found.";
							echo json_encode($response);
						}
					}
					else
					{
						$response = "Book is already borrowed.";
						echo json_encode($response);
					}
				}
				else if($link == "user")
				{
					$account_id = $_POST['account_id'];
					$response = array();

					$query_check = "SELECT COUNT(*) FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE student_id = '$account_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_value = $row_check['COUNT(*)'];

					if($result_value == 1)
					{
						$query_student = "SELECT student_tbl.*, GROUP_CONCAT((student_tbl.student_fname), ' ', (student_tbl.student_lname)) AS user_name, course_tbl.*  FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id WHERE student_id = '$account_id'";
						$result_student = $con->query($query_student);
						$row_student = $result_student->fetch_assoc();
						$response = $row_student;

						echo json_encode($response);
					}
					else
					{
						$query_employee = "SELECT employee_tbl.*, GROUP_CONCAT((employee_tbl.employee_fname), ' ', (employee_tbl.employee_lname)) AS user_name, department_tbl.* FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id WHERE employee_id = '$account_id'";
						$result_employee = $con->query($query_employee);
						$row_employee = $result_employee->fetch_assoc();
						$response = $row_employee;

						echo json_encode($response);
					}
				}
			}
		}
		else if($page == "return")
		{
			if(isset($_GET['link']))
			{
				$link = $_GET['link'];
				if($link == "details")
				{
					$barcode_id = $_POST['barcode_id'];

					$query_check = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_found = $row_check['COUNT(*)'];

					if($result_found > 0)
					{
						$response = array();

						$query_book = "SELECT book_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS book_authors FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_book = $con->query($query_book);
						$row_book = $result_book->fetch_assoc();
						
						$response = $row_book;
						echo json_encode($response);
					}
					else
					{
						$query_check2 = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.book_status = 'Available' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_check2 = $con->query($query_check2);
						$row_check2 = $result_check2->fetch_assoc();
						$result_found2 = $row_check2['COUNT(*)'];

						if($result_found2 == 1)
						{
							$response = "Book is already on-shelf.";

							echo json_encode($response);
						}
						else
						{	
							$response = "Book is not found.";

							echo json_encode($response);
						}
					}
				}
				else if($link == "user")
				{
					$barcode_id = $_POST['barcode_id'];
					$response = array();

					$query_check = "SELECT COUNT(*) FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_value = $row_check['COUNT(*)'];

					if($result_value > 0)
					{
						$query_student = "SELECT student_tbl.*, GROUP_CONCAT((student_tbl.student_fname), ' ', (student_tbl.student_lname)) AS user_name, course_tbl.*  FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_student = $con->query($query_student);
						$row_student = $result_student->fetch_assoc();
						$response = $row_student;

						echo json_encode($response);
					}
					else
					{
						$query_employee = "SELECT employee_tbl.*, GROUP_CONCAT((employee_tbl.employee_fname), ' ', (employee_tbl.employee_lname)) AS user_name, department_tbl.*  FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_employee = $con->query($query_employee);
						$row_employee = $result_employee->fetch_assoc();
						$response = $row_employee;

						echo json_encode($response);
					}
				}
			}
		}
		else if($page == "renew")
		{
			if(isset($_GET['link']))
			{
				$link = $_GET['link'];
				if($link == "details")
				{
					$barcode_id = $_POST['barcode_id'];

					$query_check = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_found = $row_check['COUNT(*)'];

					if($result_found > 0)
					{
						$query_book = "SELECT transaction_tbl.*, book_tbl.*, publisher_tbl.*, category_tbl.*, GROUP_CONCAT(DISTINCT(author_tbl.author_fname), ' ',(author_tbl.author_lname)) AS book_authors FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id INNER JOIN publisher_tbl ON book_tbl.publisher_id = publisher_tbl.publisher_id INNER JOIN book_author_tbl ON book_tbl.book_id = book_author_tbl.book_id INNER JOIN author_tbl ON book_author_tbl.author_id = author_tbl.author_id INNER JOIN category_tbl ON book_tbl.category_id = category_tbl.category_id INNER JOIN transaction_tbl ON acquisition_tbl.accession_number = transaction_tbl.accession_number WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_book = $con->query($query_book);
						$row_book = $result_book->fetch_assoc();
						$today_date = date("Y-m-d");
						$due_date = date($row_book['due_date']);

						if(strtotime($today_date) < strtotime($due_date))
						{
							$response = array();
							$response = $row_book;
							echo json_encode($response);
						}
						else
						{
							$response = "Book is already over-due.";
							echo json_encode($response);	
						}
					}
					else
					{
						$query_check2 = "SELECT COUNT(*) FROM book_tbl INNER JOIN acquisition_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.book_status = 'Available' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_check2 = $con->query($query_check2);
						$row_check2 = $result_check2->fetch_assoc();
						$result_found2 = $row_check2['COUNT(*)'];

						if($result_found2 == 1)
						{
							$response = "Book is already on-shelf.";

							echo json_encode($response);
						}
						else
						{	
							$response = "Book is not found.";

							echo json_encode($response);
						}
					}
				}
				else if($link == "user")
				{
					$barcode_id = $_POST['barcode_id'];
					$response = array();

					$query_check = "SELECT COUNT(*) FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
					$result_check = $con->query($query_check);
					$row_check = $result_check->fetch_assoc();
					$result_value = $row_check['COUNT(*)'];

					if($result_value > 0)
					{
						$query_student = "SELECT student_tbl.*, GROUP_CONCAT((student_tbl.student_fname), ' ', (student_tbl.student_lname)) AS user_name, course_tbl.*  FROM student_tbl INNER JOIN account_tbl ON student_tbl.account_number = account_tbl.account_number INNER JOIN course_tbl ON student_tbl.course_id = course_tbl.course_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_student = $con->query($query_student);
						$row_student = $result_student->fetch_assoc();
						$response = $row_student;

						echo json_encode($response);
					}
					else
					{
						$query_employee = "SELECT employee_tbl.*, GROUP_CONCAT((employee_tbl.employee_fname), ' ', (employee_tbl.employee_lname)) AS user_name, department_tbl.*  FROM employee_tbl INNER JOIN account_tbl ON employee_tbl.account_number = account_tbl.account_number INNER JOIN department_tbl ON employee_tbl.department_id = department_tbl.department_id INNER JOIN transaction_tbl ON account_tbl.account_number = transaction_tbl.account_number INNER JOIN acquisition_tbl ON transaction_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE transaction_tbl.transaction_status = 'Borrowed' AND transaction_tbl.return_date = '0000-00-00 00:00:00' AND acquisition_tbl.barcode_id = '$barcode_id'";
						$result_employee = $con->query($query_employee);
						$row_employee = $result_employee->fetch_assoc();
						$response = $row_employee;

						echo json_encode($response);
					}					
				}
			}
		}
	}
?>