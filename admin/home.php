<?php
	include("session.php");
	include("db_con.php");
	include("header.php");
	include("style.php");
?>
<body>
	<?php include("navigation_bar.php"); ?>
	<!--Page Body-->
	<div class="page-body">
		<!--Form Header-->
		<div class="page-header">
			<span class="fa fa-dashboard"></span>
			&nbsp;Dashboard
			<div class="current-date">
				<span class="fa fa-calendar"></span>
				<?php
					$date_today = date("F d, Y | h:i A");
					echo "&nbsp;".$date_today;
				?>
			</div>
		</div>
		<!--/Form Header-->

		<div class="dashboard">

			<div class="dash-row-1">

				<a href="users.php?page=borrower" title="View borrowers">
					<div class="dash-users">
						<span class="fa fa-users"></span>
						&nbsp;Borrowers
						<?php
							$query_users = "SELECT COUNT(*) FROM account_tbl WHERE account_type = 'Regular'";
							$result_users = $con->query($query_users);
							$row_users = $result_users->fetch_assoc();
							$total_users = $row_users['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_users; ?></p>
					</div>
				</a>
				

				<a href="users.php?page=administrator" title="View staffs">
					<div class="dash-staff">
						<span class="fa fa-user"></span>
						&nbsp;Assistants
						<?php
							$query_staff = "SELECT COUNT(*) FROM account_tbl WHERE account_type = 'Staff'";
							$result_staff = $con->query($query_staff);
							$row_staff = $result_staff->fetch_assoc();
							$total_staffs = $row_staff['COUNT(*)'];
						?>
						<p class="total-count"><?php echo $total_staffs; ?></p>
					</div>
				</a>


				<a href="users.php?page=administrator" title="View administrators">
					<div class="dash-admin">
						<span class="fa fa-user"></span>
						&nbsp;Admin
						<?php
							$query_admin = "SELECT COUNT(*) FROM account_tbl WHERE account_type = 'Admin'";
							$result_admin = $con->query($query_admin);
							$row_admin = $result_admin->fetch_assoc();
							$total_admins = $row_admin['COUNT(*)'];
						?>
						<p class="total-count"><?php echo $total_admins; ?></p>
					</div>
				</a>
			</div>
			
			<div class="dash-row-2">
				<a href="books.php?page=reserved" title="View reservations of book">
					<div class="dash-reservations">
						<span class="fa fa-list"></span>
						&nbsp;Reserved Books
						<?php
							$query_reserve = "SELECT COUNT(*) FROM reservation_tbl WHERE reserve_status = 'Pending'";
							$result_reserve = $con->query($query_reserve);
							$row_reserve = $result_reserve->fetch_assoc();
							$total_reservations = $row_reserve['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_reservations; ?></p>
					</div>
				</a>

				<a href="books.php?page=borrowed" title="View borrowed books">
					<div class="dash-borrowed">
						<span class="fa fa-list-alt"></span>
						&nbsp;Check-outs
						<?php
							$query_borrowed = "SELECT COUNT(*) FROM transaction_tbl WHERE transaction_status = 'Borrowed'";
							$result_borrowed = $con->query($query_borrowed);
							$row_borrowed = $result_borrowed->fetch_assoc();
							$total_borrowed = $row_borrowed['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_borrowed; ?></p>
					</div>
				</a>


				<a href="books.php?page=view-books" title="View all books">
					<div class="dash-holdings">
						<span class="fa fa-book"></span>
						&nbsp;Books
						<?php
							$query_books = "SELECT COUNT(*) FROM acquisition_tbl";
							$result_books = $con->query($query_books);
							$row_books = $result_books->fetch_assoc();
							$total_books = $row_books['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_books; ?></p>

					</div>
				</a>
			</div>

			<div class="dash-row-3">
				<a href="transaction.php?page=guest" title="View guests today">
					<div class="dash-guests">
						<span class="fa fa-users"></span>
						&nbsp;Guests
						<?php
							$query_guest = "SELECT COUNT(*) FROM guest_tbl WHERE date_visited = '$current_date' AND check_out = '00:00:00'";
							$result_guest = $con->query($query_guest);
							$row_guest = $result_guest->fetch_assoc();
							$total_guest = $row_guest['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_guest; ?></p>
					</div>
				</a>

				<a href="penalty.php?page=unpaid" title="View unpaid fines">
					<div class="dash-unpaids">
						<span class="fa fa-dollar"></span>
						&nbsp;Unpaid Fines
						<?php
							$query_unpaid = "SELECT COUNT(*) FROM penalty_tbl WHERE payment_status = 'Pending'";
							$result_unpaid = $con->query($query_unpaid);
							$row_unpaid = $result_unpaid->fetch_assoc();
							$total_unpaid = $row_unpaid['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_unpaid; ?></p>
					</div>
				</a>

				<a href="transaction.php?page=user-log" title="View online users">
					<div class="dash-online-users">
						<span class="fa fa-desktop"></span>
						&nbsp;Online Users
						<?php
							$query_user_log = "SELECT COUNT(*) FROM userlog_tbl WHERE logout_time = '00:00:00'";
							$result_user_log = $con->query($query_user_log);
							$row_user_log = $result_user_log->fetch_assoc();
							$total_online_users = $row_user_log['COUNT(*)'];
						?>
							<p class="total-count"><?php echo $total_online_users; ?></p>
					</div>
				</a>
			</div>

			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<p id="school-name">MARY CHILES COLLEGE LIBRARY</p>
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="item active">
					  <img src="../images/libpic1.jpg">
					</div>
					<div class="item">
					  <img src="../images/libpic2.jpg">
					</div>
					<div class="item">
					  <img src="../images/libpic3.jpg">
					</div>
					<!-- <div class="item">
					  <img src="../images/lib3.jpg">
					</div> -->
				</div>
			</div>



		</div>
		<!--/Page Body-->
	</div>
</body>
<?php include("footer.php"); ?>