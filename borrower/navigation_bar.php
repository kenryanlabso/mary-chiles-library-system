<style>
.navbar-default .navbar-nav > li > a 
{
	color:white;
}
.navigation-bar
{
	font-size:16px;
}
.navbar
{
	background-color:#4CAF50;
	margin-bottom:0px;
	border:0px;
	border-radius:0px;
}
</style>
<div class="navigation-bar">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li>
						<img src="../images/logo.png" id="image" style="height:50px; border-radius:4px; border:0.5px solid #28791d;">
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="home.php" title="Home">
							<span class="fa fa-home"></span>&nbsp;Home
						</a>
					</li>
					<li>
						<a href="books.php?page=search" title="Search Books">
							<span class="fa fa-search"></span>&nbsp;Search Book
						</a>
					</li>
					<li>
						<a href="books.php?page=reserved" title="Reserved Books">
							<span class="fa fa-list"></span>&nbsp;Reservations
						</a>
					</li>
					<li class="dropdown" id="dropdownid">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Account">
						<span class="fa fa-user"></span>&nbsp;Account
						<span class="caret"></span>
							<ul class="dropdown-menu" id="dropdown_menu">
								<li id="subdrop">
									<a href="account_settings.php">Account Settings</a>
								</li>
								<li id="subdrop">
									<a href="change_password.php">Change Password</a>
								</li>
								<li id="subdrop">
									<a href="../logout.php">Logout</a>
								</li>
							</ul>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>