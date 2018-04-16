<?php
	include("db_con.php");
	include("header.php");
	include("style.php");
	include("jscript.php");
	include("modal/clear_penalty_modal.php");
	include("modal/edit_payment_modal.php");

	$current_date = date("Y-m-d");
?>
	<body>
		<?php include("navigation_bar.php"); ?>
		<!--Page Body-->
		<div class="page-body">
		<!--Form Header-->
			<div class="page-header">
				<span class="fa fa-list"></span>
				&nbsp;Reports 
				<div class="current-date">
					<span class="fa fa-calendar"></span>
					<?php
						$date_today = date("F d, Y | h:i A");
						echo "&nbsp;".$date_today;
					?>
				</div>
			</div>
			<div class="reports-form">
				<form id="form-reports" method="POST" action="action/generate_report.php">
					<div class="form-inline">
						<label for="start-date">Start:</label>
						<input type="date" id="start-date" name="start-date" class="form-control" max="<?php echo $current_date; ?>" autofocus required/>
						<label for="end-date">End:</label>
						<input type="date" id="end-date" name="end-date" class="form-control"  max="<?php echo $current_date; ?>" required/>
						<select id="report-type" name="report-type" class="form-control" required>
							<option></option>
							<option value="acquisition">Book Acquisition</option>
							<option value="archived">Archived Books</option>
							<option value="borrowed">Borrowed Books</option>
							<option value="returned">Returned Books</option>
							<option value="reservations">Reserved Books</option>
							<option value="guest-transactions">Guest Transactions</option>
							<option value="unpaid-penalties">Unpaid Penalties</option>
							<option value="paid-penalties">Paid Penalties</option>
							<option value="user-registration">User Registration</option>
							<option value="inactive">Inactive Users</option>
							<option value="user-log">User Log</option>
						</select>
						<button id="submit-report" class="btn btn-success button-submit" title="Search report">
							<tagname id="button-label">
								<span class="fa fa-search"></span>
									&nbsp;Search
							</tagname>

							<div id="button-loader">
								<span class="fa fa-spinner fa-spin"></span>
							</div>
						</button>
					</div>
				</form>
			</div>
			<div class="reports-preview"></div>
		</div>
		<!--/Page Body-->
		<script type="text/javascript">
		$(document).ready(function () 
		{
			$("#report-type").select2(
			{
				placeholder: "Select Report",
				allowClear: true
			});

			$("#form-reports").submit(function(e)
			{
				e.preventDefault();
				$(this).ajaxSubmit(
				{
					beforeSend: function()
					{
						$("#submit-report").attr("disabled", true);
						$("#button-label").hide();
						$("#button-loader").show();
					},
					success: function (data, status)
					{
						$(".reports-preview").show();
						$("#button-loader").hide();
						$("#button-label").show();
						$("#submit-report").attr("disabled", false);
						$(".reports-preview").html(data);
					},
					resetForm: false
				});
				return false;
			});
		});
		function printReport()
		{
			var start_date = $("#start-report").val();
			var end_date = $("#end-report").val();
			var report_type = $("#type-report").val();

			window.location='print_report.php?type='+report_type+'&start='+start_date+'&end='+end_date;
		}
		</script>
	</body>
<?php include("footer.php"); ?>
		
