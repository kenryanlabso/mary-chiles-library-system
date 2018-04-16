<?php
	include("../db_con.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "user")
		{
			$account_id = $_POST['user-id'];
			$image = $_FILES['user-image']['name'];
			$image_name= addslashes($_FILES['user-image']['name']);
			$size = $_FILES['user-image']['size'];
			$error = $_FILES['user-image']['error'];

			$query_check = "SELECT COUNT(*) FROM student_tbl WHERE student_id = '$account_id'";
			$result_check = $con->query($query_check);
			$row_check = $result_check->fetch_assoc();
			$result_true = $row_check['COUNT(*)'];

			if($result_true == 1)
			{
				if($size > 10000000)
				{
					die("Format is not allowed or file size is too big!");
				}
				else
				{
					move_uploaded_file($_FILES["user-image"]["tmp_name"],"../uploads/users/".$_FILES["user-image"]["name"]);
					$student_image = $_FILES['user-image']['name'];

					$query_student = "UPDATE student_tbl SET student_image = '$student_image' WHERE student_id = '$account_id'";
					$result_student = $con->query($query_student);
				}
			}
			else
			{
				if($size > 10000000)
				{
					die("Format is not allowed or file size is too big!");
				}
				else
				{
					move_uploaded_file($_FILES["user-image"]["tmp_name"],"../uploads/users/".$_FILES["user-image"]["name"]);
					$employee_image = $_FILES['user-image']['name'];

					$query_employee = "UPDATE employee_tbl SET employee_image = '$employee_image' WHERE employee_id = '$account_id'";
					$result_employee = $con->query($query_employee);
				}
			}
		}	
		else if($page == "book")
		{
			$book_id = $_POST['modal-book-id'];
			$image = $_FILES['book-image']['name'];
			$image_name= addslashes($_FILES['book-image']['name']);
			$size = $_FILES['book-image']['size'];
			$error = $_FILES['book-image']['error'];

			if($size > 10000000)
			{
				die("Format is not allowed or file size is too big!");
			}
			else
			{
				move_uploaded_file($_FILES["book-image"]["tmp_name"],"../uploads/books/".$_FILES["book-image"]["name"]);
				$book_image = $_FILES['book-image']['name'];

				$query_book = "UPDATE book_tbl SET book_image = '$book_image' WHERE book_id = '$book_id'";
				$result_book = $con->query($query_book);
			}
		}
	}
?>