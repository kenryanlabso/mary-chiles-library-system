<?php
	include("session.php");
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");

	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
		if($page == "authors")
		{
			include("modal/edit_author_modal.php");
			include("modal/delete_author_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">

					<div class="page-header">
						<span class="fa fa-user"></span>
						&nbsp;Authors
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default active" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>

					<!--Add Author-->
					<div class="author-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddAuthor()" title="Close this form">&times;</button>
						</div>
						<form id="add-author" method="POST" action="action/add_author.php">
							<div class="author-form">
								<label for="first-name">First Name:</label>
								<input type="text" id="first-name" name="first-name" class="form-control" maxlength="50" autofocus required/>
								<label for="middle-initial">Middle Initial:</label>
								<input type="text" id="middle-initial" name="middle-initial" class="form-control" maxlength="1"/>
								<label for="last-name">Last Name:</label>
								<input type="text" id="last-name" name="last-name" class="form-control" maxlength="50" required/>
								
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>

								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>

								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-author" name="submit-author" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
					</div>
					<!--/Add Author-->

					<!--View Authors-->
					<div class="authors-view">
					<!--/View Authors-->
					</div>
				</div>
				<!--/Page Body-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "publishers")
		{
			include("modal/edit_publisher_modal.php");
			include("modal/delete_publisher_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-user"></span>
						&nbsp;Publishers
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!---->
					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default active"href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>
					
					<!--Add Publisher-->
					<div class="publisher-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddPublisher()" title="Close this form">&times;</button>
						</div>
						<form id="add-publisher" method="POST" action="action/add_publisher.php">
							<div class="publisher-form">
								<label for="publisher-name">Publisher Name:</label>
								<input type="text" id="publisher-name" name="publisher-name" class="form-control" maxlength="100" autofocus required/>
								<label for="publisher-address">Address:</label>
								<textarea id="publisher-address" name="publisher-address" class="form-control" maxlength="150"></textarea>
								<label for="publisher-contact">Contact Number:</label>
								<input type="text" id="publisher-contact" name="publisher-contact" class="form-control" maxlength="15"/>
								<label for="publisher-email">E-mail Address:</label>
								<input type="text" id="publisher-email" name="publisher-email" class="form-control" maxlength="50"/>
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>
								
								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>
								
								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-publisher" name="submit-publisher" class="btn btn-success">Submit</button>
								</div>

							</div>
						</form>
					</div>
					<!--/Add Publisher-->

					<!--View Publishers-->
					<div class="publishers-view">
					<!--/View Publishers-->
					</div>
				</div>
				<!--/Page-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "categories")
		{
			include("modal/edit_category_modal.php");
			include("modal/delete_category_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-list"></span>
						&nbsp;Categories
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!---->
					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default  active" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default"href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>

					<!--Add Category-->
					<div class="category-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddCategory()" title="Close this form">&times;</button>
						</div>
						<form id="add-category" method="POST" action="action/add_category.php">
							<div class="course-form">
								<label for="class-name">Class Name:</label>
								<input type="text" id="class-name" name="class-name" class="form-control" maxlength="50" autofocus required/>
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>
								
								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>
								
								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-category" name="submit-category" class="btn btn-success">Submit</button>
								</div>

							</div>
						</form>
					</div>
					<!--/Add Category-->

					<!--View Category-->
					<div class="categories-view"></div>
					<!--/View Category-->
				</div>
				<!--/Page-->
			</body>
			<?php
			include("footer.php");

		}
		else if($page == "courses")
		{
			include("modal/edit_course_modal.php");
			include("modal/delete_course_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-list"></span>
						&nbsp;Courses
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!---->
					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default  active"href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>

					<!--Add Course-->
					<div class="course-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddCourse()" title="Close this form">&times;</button>
						</div>
						<form id="add-course" method="POST" action="action/add_course.php">
							<div class="course-form">
								<label for="course-name">Course Name:</label>
								<input type="text" id="course-name" name="course-name" class="form-control" maxlength="75" autofocus required/>
								<label for="course-description">Course Description:</label>
								<textarea id="course-description" name="course-description" class="form-control" maxlength="150"></textarea>
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>
								
								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>
								
								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-course" name="submit-course" class="btn btn-success">Submit</button>
								</div>

							</div>
						</form>
					</div>
					<!--/Add Course-->

					<!--View Courses-->
					<div class="courses-view"></div>
					<!--/View Courses-->
				</div>
				<!--/Page-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "departments")
		{
			include("modal/edit_department_modal.php");
			include("modal/delete_department_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-flag"></span>
						&nbsp;Departments
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!---->

					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default active" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default"href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>
					
					<!--Add Department-->
					<div class="department-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddDepartment()">&times;</button>
						</div>
						<form id="add-department" method="POST" action="action/add_department.php">
							<label for="department-name">Department Name:</label>
							<input type="text" id="department-name" name="department-name" class="form-control" maxlength="50" autofocus required/>
							<label for="department-description">Description:</label>
							<textarea id="department-description" name="department-description" class="form-control" maxlength="150"></textarea>

							<div class="form-loader">
								<span class="fa fa-spinner fa-spin"></span>
							</div>
								
							<div class="form-maintenance-response">
								<span class="fa fa-check"></span>&nbsp;Successfully Added!
							</div>
								
							<div class="form-buttons">
								<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
								<button type="submit" id="submit-department" name="submit-department" class="btn btn-success">Submit</button>
							</div>

						</form>
					</div>
					<!--/Add Department-->

					<!--View Departments-->
					<div class="departments-view"></div>
					<!--/View Departments-->
					
				</div>
				<!--/Page-->
			</body>
			<?php
			include("footer.php");
		}
		else if($page == "holidays")
		{
			include("modal/edit_holiday_modal.php");
			include("modal/delete_holiday_modal.php");
			?>
			<body>
				<?php include("navigation_bar.php"); ?>
				<!--Page Body-->
				<div class="page-body">
					<!--Form Header-->
					<div class="page-header">
						<span class="fa fa-flag"></span>
						&nbsp;Holidays
						<div class="current-date">
							<span class="fa fa-calendar"></span>
							<?php
								$date_today = date("F d, Y | h:i A");
								echo "&nbsp;".$date_today;
							?>
						</div>
					</div>
					<!---->
					
					<div class="sub-menu">
						<div class="maintenance-submenu">
							<nav>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=authors">Authors</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=categories">Categories</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=courses">Courses</a>
								</li>
								<li>
									<a class="btn btn-default" href="maintenance.php?page=departments">Departments</a>
								</li>
								<li>
									<a class="btn btn-default active" href="maintenance.php?page=holidays">Holidays</a>
								</li>
								<li>
									<a class="btn btn-default"href="maintenance.php?page=publishers">Publishers</a>
								</li>
							</nav>
						</div>
					</div>
					
					<!--Add Holiday-->
					<div class="holidays-add">
						<div class="form-closer">
							<button class="close" onclick="closeAddHoliday()">&times;</button>
						</div>
						<form id="add-holiday" method="POST" action="action/add_holiday.php">
							<div class="holiday-form">
								<label for="holiday-type">Event type:</label>
								<select id="holiday-type" name="holiday-type" class="form-control" required>
									<option value="regular">Regular Holiday</option>
									<option value="special">Special Holiday</option>
									<option value="suspension">Class Suspension</option>
									<option value="school-event">School Event</option>
									<option value="emergency">Emergency</option>
								</select>
								<label for="holiday-date">Date of Event:</label>
								<input type="date" id="holiday-date" name="holiday-date" class="form-control" required/>
								<label for="holiday-name">Event Name:</label>
								<input type="text" id="holiday-name" name="holiday-name" class="form-control" maxlength="100" autofocus required/>
								<label for="holiday-description">Description:</label>
								<textarea id="holiday-description" name="holiday-description" class="form-control" maxlength="150"></textarea>
								<div class="form-loader">
									<span class="fa fa-spinner fa-spin"></span>
								</div>
								
								<div class="form-maintenance-response">
									<span class="fa fa-check"></span>&nbsp;Successfully Added!
								</div>
								
								<div class="form-buttons">
									<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
									<button type="submit" id="submit-holiday" name="submit-holiday" class="btn btn-success">Submit</button>
								</div>

							</div>
						</form>
					</div>
					<!--/Add Holidays-->

					<!--View Holidays-->
					<div class="holidays-view">
					<!--/View Holidays-->
					</div>
				</div>
				<!--/Page-->
			</body>
			<?php
			include("footer.php");
		}
	}
	else
	{
		echo "<script>window.location='maintenance.php?page=authors'; </script>";
	}
?>