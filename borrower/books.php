<?php
	include("session.php");
	include("db_con.php");
	include("../admin/header.php");
	include("../admin/style.php");
	include("jscript.php");
	
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "reserved")
		{

			include("modal/book_image_modal.php");
			include("modal/remove_reserve_modal.php");
			?>
			<head>
				<title>Reserved Books</title>
			</head>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-list-alt"></span>
							&nbsp;Reserved Books
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!--/Form Header-->
					<div class="reserve-view"></div>
				</div>
				<!--/Page Body-->
			</body>
			<?php 
				include("../admin/footer.php");
		}
		else
		{
			$account_number = $_SESSION['id'];

			$query_expiration = "SELECT reserve_days_student, reserve_days_employee FROM settings_tbl WHERE settings_id = 1";
			$result_expiration = $con->query($query_expiration);
			$row_expiration = $result_expiration->fetch_assoc();

			$reserve_days_student = $row_expiration['reserve_days_student'];
			$reserve_days_employee = $row_expiration['reserve_days_employee'];

			$query_check = "SELECT * FROM student_tbl WHERE student_id = '$account_number'";
			$result_check = $con->query($query_check);
			if($result_check->num_rows > 0)
			{
				$allowable_days = $reserve_days_student;
			}
			else
			{
				$allowable_days = $reserve_days_employee;
			}

			include("modal/book_image_modal.php");
			include("modal/reserve_book_modal.php");
			?>
			<head>
				<title>Online Public Access Catalog</title>
			</head>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-search"></span>
							&nbsp;Online Public Access Catalog
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!--/Form Header-->
					<div class="books-view"></div>
				</div>
				<!--/Page Body-->
			</body>
			<?php 
				include("../admin/footer.php");
		}
	}
	else
	{
		echo "<script>window.location='books.php?page=search';</script>";
	}
?>


