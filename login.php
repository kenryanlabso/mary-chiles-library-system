<?php
	include("refresh_database.php");
	if(isset($_GET['type']))
	{	
		include("db/db_con.php");
		include("session.php");
		$session_id =  $_SESSION['id'];

		$query_type = "SELECT account_type FROM account_tbl WHERE account_number = '$session_id'";
		$result_type = $con->query($query_type);
		$row_type = $result_type->fetch_assoc();
		$account_type = $row_type['account_type'];
		if($account_type == "Admin" || $account_type == "Staff")
		{
			header("location: admin/home.php");
		}
		else
		{
			header("location: borrower/home.php");
		}
	}
	else
	{
		session_start();
		if(isset($_SESSION['id']))
		{
			$session_id =  $_SESSION['id'];
			$query_type = "SELECT account_type FROM account_tbl WHERE account_number = '$session_id'";
			$result_type = $con->query($query_type);
			$row_type = $result_type->fetch_assoc();
			$account_type = $row_type['account_type'];
			if($account_type == "Admin" || $account_type == "Staff")
			{
				header("location: admin/home.php");
			}
			else
			{
				header("location: borrower/home.php");
			}
		}
		include("admin/style.php");
		?>
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">
				<link rel="icon" href="images/logo.png">
				<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap-style.css"/>
				<link rel="stylesheet" type="text/css" href="fonts/css/font-awesome.min.css">
				<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
				<script type="text/javascript" src="js/j_QueryForm.js"></script>
				<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
			</head>
			<style>
			body
			{
				font-size:14px;
				margin-left: 30px;
				margin-right: 30px;
			}
			</style>
			<body>
				<div class="login-head">
					<img src="images/logo.png" id="image" style="height:50px; border-radius:4px; border:0.5px solid #28791d;">
					Mary Chiles College Online Library
				</div>
				
				<!--Page Body-->
				<div class="login-body">

					<!--Login Page-->
					<div class="login-page">
						
						<div class="login-header">
							<span class="fa fa-user"></span>
							&nbsp;Login

						</div>
						<?php
							if(isset($_GET['failed']))
							{
								echo "<style>.login-page{
									height:280px; }</style>";
								echo '<p id="login-first">Login first!</p>';
							}
						?>
						
						
						<form id="login-form" method="POST" action="admin/action/login.php">
							<label for="user-id">User ID:</label>
							<input type="text" id="user-id" name="user-id" class="form-control" maxlength="50" required/>
							<label for="password">Password:</label>
							<input type="password" id="password" name="password" class="form-control" minlength="5" maxlength="25" required/>
							<div class="form-loader">
								<span class="fa fa-spinner fa-spin"></span>
							</div>

							<div class="login-response">
								<p id="response-message"></p>
							</div>

							<div class="form-buttons">
								<button type="submit" id="submit-password" class="btn btn-success">Submit</button>
								<button type="reset" id="cancel-button" class="btn btn-default">Clear</button>
							</div>
						</form>
					</div>
					<!--/Login Page-->

				</div>
				<!--/Page Body-->
				<script>
				$(document).ready(function()
				{
					$("#login-form").submit(function(e)
					{
						e.preventDefault();
						$(this).ajaxSubmit(
						{
							beforeSend: function()
							{
								$(".form-loader").show();
							},
							success: function(data, status)
							{
			    				var response = JSON.parse(data);
								$(".form-loader").hide();
								$("#response-message").text(response);
								if(response == "Login successfully!")
								{
									$("#user-id").val("");
									$("#password").val("");
									$("#response-message").css("color", "green");
									loginResponseSuccess();
								}
								else
								{
									$("#response-message").css("color", "red");
									loginResponseFailed();
									if(response == "Incorrect password.")
									{
										$("#password").val("");
										$("#password").focus();
									}
									else
									{
										$("#user-id").val("");
										$("#password").val("");
										$("#user-id").focus();	
									}
								}
								
							},
							resetForm: false
						});
						return false;
					});

					$(".books-view").load("view_books.php");
				});
				function hideResponseFailed()
				{
					$(".login-response").hide();
				}
				function loginResponseFailed()
				{
					$(".login-response").show();
					setTimeout('hideResponseFailed()', 1200);
				}	
				function hideResponseSuccess()
				{
					$(".login-response").hide();
					window.location='login.php?type';
				}
				function loginResponseSuccess()
				{
					$(".login-response").show();
					setTimeout('hideResponseSuccess()', 1200);
				}
				</script>
				<?php include("admin/footer.php"); ?>
			</body>
		</html>
		<?php
	}
?>
