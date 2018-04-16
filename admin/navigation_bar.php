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
					<li class="dropdown" id="dropdownid">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Users">
						<span class="fa fa-users"></span>&nbsp;Users
						<span class="caret"></span>
							<ul class="dropdown-menu" id="dropdown_menu">
								<li id="subdrop">
									<a href="users.php?page=administrator">Administrator</a>
								</li>
								<li id="subdrop">
									<a href="users.php?page=borrower">Borrowers</a>
								</li>
								<li id="subdrop">
									<a href="users.php?page=inactive">Inactive</a>
								</li>
							</ul>
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
									<a href="books.php?page=borrowed">Borrowed Books</a>
								</li>
								<li id="subdrop">
									<a href="books.php?page=reserved">Reserved Books</a>
								</li>
								<li id="subdrop">
									<a href="books.php?page=archived">Archived Books</a>
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
									<a href="transaction.php?page=user-log">User Logs</a>
								</li>
								<li id="subdrop">
									<a href="transaction.php?page=guest">Manage Guest</a>
								</li>
							</ul>
						</a>
					</li>
					<li>
						<a href="reports.php" title="Reports">
							<span class="fa fa-folder-open"></span>&nbsp;Reports
						</a>
					</li>
					<li>
						<a href="penalty.php" title="Penalty">
							<span class="fa fa-warning"></span>&nbsp;Penalty
						</a>
					</li>
					<li>
						<a href="maintenance.php" title="Maintenance">
							<span class="fa fa-list-alt"></span>&nbsp;Maintenance
						</a>
					</li>
					<li>
						<a href="settings.php" title="Settings">
							<span class="fa fa-cog"></span>&nbsp;Settings
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