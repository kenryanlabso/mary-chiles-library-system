<?php
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");
	include("modal/clear_penalty_modal.php");
	include("modal/edit_payment_modal.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "unpaid")
		{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-dollar"></span>
						&nbsp;Pending Fines
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<div class="penalties-unpaid-view"></div>
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "paid")
		{
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-dollar"></span>
						&nbsp;Paid Fines
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>

					<div class="penalties-paid-view"></div>
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else
		{
			echo "<script>window.location='penalty.php?page=unpaid'; </script>";
		}
	}
	else
	{
		echo "<script>window.location='penalty.php?page=unpaid'; </script>";
	}
?>
