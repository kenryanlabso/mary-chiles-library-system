<?php
	include("session.php");
	include("db_con.php");
	include("../admin/header.php");
	include("../admin/style.php");
	include("jscript.php");
	$account_number = $_SESSION['id'];

	$query_user = "SELECT * FROM account_tbl INNER JOIN student_tbl ON account_tbl.account_number = student_tbl.account_number WHERE student_tbl.account_number = '$account_number'";
	$result_user = $con->query($query_user);
	if($result_user->num_rows > 0)
	{
		$row_user = $result_user->fetch_assoc();
		$first_name = $row_user['student_fname'];
	}
	else
	{
		$query_user = "SELECT * FROM account_tbl INNER JOIN employee_tbl ON account_tbl.account_number = employee_tbl.account_number WHERE employee_tbl.account_number = '$account_number'";
		$result_user = $con->query($query_user); 
		$row_user = $result_user->fetch_assoc();
		$first_name = $row_user['employee_fname'];

	}
?>
	<body>
		<?php include("navigation_bar.php"); ?>
		<!--Page Body-->
		<div class="page-body">
			<!--Form Header-->
			<div class="page-header">
				<span class="fa fa-thumbs-up"></span>
				<?php echo "&nbsp;Welcome, ".$first_name; ?>
				<div class="current-date">
					<span class="fa fa-calendar"></span>
					<?php
						$date_today = date("F d, Y | h:i A");
						echo "&nbsp;".$date_today;
					?>
				</div>
			</div>
			<!--/Form Header-->
			<div class="home-body">
				<div class="college-info">
					<h2>MARY CHILES COLLEGE LIBRARY</h2>
					<h3>Mission</h3>
   					<p>Mary Chiles College library supports learning and teaching, research, creation of knowledge and intellectual growth by providing information resources services and facilities.</p>
					<h3>Vision</h3>
				   <p>We envision a library dedicated to developing health professionals through its rich resources and genuinely callaborative work environment; a learning center which is inviting, accesible and receptive to the need of its users.</p>
				</div>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
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
						  <img src="../images/libpic4.jpg">
						</div> -->
					</div>
				</div>
			</div>
		</div>
			<!--/Page Body-->
		<script>
		$('.carousel').carousel(
		{
			interval: 3000
		})
		</script>
	</body>
</html>
<?php include("../admin/footer.php"); ?>