<?php
	include("../db_con.php");
	include("../session.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];

		if($page == "penalty")
		{
			$penalty_student = $_POST['penalty-student'];
			$penalty_employee = $_POST['penalty-employee'];

			$query_penalty = "UPDATE settings_tbl SET fine_student = '$penalty_student', fine_employee = '$penalty_employee' WHERE settings_id = 1";
			$result_penalty = $con->query($query_penalty);
		}
		else if($page == "allowed-days")
		{
			$type = $_GET['type'];
			if($type == "borrow")
			{
				$days_student = $_POST['days-student'];
				$days_employee = $_POST['days-employee'];

				$query_borrow_days = "UPDATE settings_tbl SET borrow_days_student = '$days_student', borrow_days_employee = '$days_employee' WHERE settings_id = 1";
				$result_borrow_days = $con->query($query_borrow_days);
			}
			else if($type == "reserve")
			{
				$days_student = $_POST['days-student'];
				$days_employee = $_POST['days-employee'];

				$query_reserve_days = "UPDATE settings_tbl SET reserve_days_student = '$days_student', reserve_days_employee = '$days_employee' WHERE settings_id = 1";
				$result_reserve_days = $con->query($query_reserve_days);
			}
		}
		else if($page == "quantity-books")
		{
			$quantity_student = $_POST['quantity-student'];
			$quantity_employee = $_POST['quantity-employee'];

			$query_quantity = "UPDATE settings_tbl SET quantity_books_student = '$quantity_student', quantity_books_employee = '$quantity_employee' WHERE settings_id = 1";
			$result_quantity = $con->query($query_quantity);
		}
	}
?>