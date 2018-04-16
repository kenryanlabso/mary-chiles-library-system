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
						<img src="../images/logo.png" id="image" height="50px">
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" title="Search">
						<span class="fa fa-search"></span>&nbsp;Search
						</a>
					</li>
					<li>
						<a href="../admin/users.php?page=borrower" title="Users">
						<span class="fa fa-users"></span>&nbsp;Users
						</a>
					</li>
					<li class="dropdown" id="dropdownid">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Books">
						<span class="fa fa-book"></span>&nbsp;Books
						<span class="caret"></span>
							<ul class="dropdown-menu" id="dropdown_menu">
								<li id="subdrop">
									<a href="books.php">Collections</a>
								</li>
								<li id="subdrop">
									<a href="#">Borrowed Books</a>
								</li>
								<li id="subdrop">
									<a href="#">Reserved Books</a>
								</li>
							</ul>
						</a>
					</li>
					<li class="dropdown" id="dropdownid">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Transactions">
						<span class="fa fa-refresh"></span>&nbsp;Transactions
						<span class="caret"></span>
							<ul class="dropdown-menu" id="dropdown_menu">
								<li id="subdrop">
									<a href="transaction.php?page=borrow">Borrow Book</a>
								</li>
								<li id="subdrop">
									<a href="transaction.php?page=return">Return Book</a>
								</li>
								<li id="subdrop">
									<a href="transaction.php?page=renew">Renew Book</a>
								</li>
								<li id="subdrop">
									<a href="transaction.php?page=reserved">Reserved Book</a>
								</li>
								<li id="subdrop">
									<a href="transaction.php?page=visitor">Manage Visitor</a>
								</li>
							</ul>
						</a>
					</li>
					<li>
						<a href="#" title="Penalty">
							<span class="fa fa-warning"></span>&nbsp;Penalty
						</a>
					</li>
					<li class="dropdown" id="dropdownid">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Account">
						<span class="fa fa-user"></span>&nbsp;Account
						<span class="caret"></span>
							<ul class="dropdown-menu" id="dropdown_menu">
								<li id="subdrop"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;My Profile</a></li>
								<li id="subdrop"><a href="settings.php?page=account"><span class="glyphicon glyphicon-cog"></span>&nbsp;Account Settings</a></li>
								<li id="subdrop"><a href="settings.php?page=security"><span class="glyphicon glyphicon-lock"></span>&nbsp;Security Settings</a></li>
								<li id="subdrop"><a href="activity.php?page=logs&view=all"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Activity Log</a></li>
								<li id="subdrop"><a href="help.php"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
								<li id="subdrop"><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
							</ul>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>