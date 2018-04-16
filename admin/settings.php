<?php
	include("session.php");
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");
?>
<body>
	<?php include("navigation_bar.php"); ?>
	<!--Page Body-->
	<div class="page-body">
		<!--Form Header-->
		<div class="page-header">
			<span class="fa fa-cog"></span>
			&nbsp;Settings
			<div class="current-date">
				<span class="fa fa-calendar"></span>
				<?php
					$date_today = date("F d, Y | h:i A");
					echo "&nbsp;".$date_today;
				?>
			</div>
		</div>
		<!--/Form Header-->
		
		<div class="settings-borrow-days"></div>
		<div class="settings-reserve-days"></div>
		<div class="settings-penalty"></div>
		<div class="settings-quantity-books"></div>
		
		<!--/Page Body-->
	</div>

</body>
<?php include("footer.php"); ?>