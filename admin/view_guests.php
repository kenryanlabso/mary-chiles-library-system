<?php
	include("session.php");
	include("db_con.php");
?>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<a href="#" id="show-add" onclick="showAddGuest()" title="Click here to add guest">Add Guest</a><br><br>
<div class="table table-responsive">
	<table class="table table-striped table-hover" id="example">
		<thead>
			<th><center>Receipt No.</center></th>
			<th><center>Guest Name</center></th>
			<th><center>School/Company</center></th>
			<th><center>Contact Number</center></th>
			<th><center>Visit Date</center></th>
			<th width="90"><center>Time In</center></th>
			<th width="90"><center>Time Out</center></th>
			<th><center>Books Used</center></th>
			<th><center>Action</center></th>
		</thead>
		<tbody>
		<?php
			$query_view = "SELECT guest_tbl.*, acquisition_tbl.*, GROUP_CONCAT(DISTINCT(book_tbl.book_title)) AS borrowed_books FROM guest_tbl LEFT JOIN guest_transaction_tbl ON guest_tbl.guest_id = guest_transaction_tbl.guest_id LEFT JOIN acquisition_tbl ON guest_transaction_tbl.accession_number = acquisition_tbl.accession_number LEFT JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id GROUP BY guest_tbl.guest_id ORDER BY guest_tbl.date_visited ASC";
			$result_view = $con->query($query_view);
			while($row_view = $result_view->fetch_assoc())
			{
				$guest_id = $row_view['guest_id'];
				$receipt_number = $row_view['guest_receipt'];
				$guest_name = $row_view['guest_name'];
				$school_company = $row_view['guest_company'];
				$contact_number = $row_view['guest_contact'];
				$visited_date = date($row_view['date_visited']);
				$date_visited = date("m/d/Y", strtotime($visited_date));
				$date_today = date("Y-m-d");
				$check_in = $row_view['check_in'];
				$check_out = $row_view['check_out'];
				$time_check_in = date("h:i A", strtotime($check_in));
				$time_check_out = date("h:i A", strtotime($check_out));
				$borrowed_books = $row_view['borrowed_books'];
				$book_status = $row_view['book_status'];

				?>
				<tr>
					<td><?php echo $receipt_number; ?></td>
					<td><?php echo $guest_name; ?></td>
					<td><?php echo $school_company; ?></td>
					<td><?php echo $contact_number; ?></td>
					<td><?php echo $date_visited; ?></td>
					<td>
						<?php
							if($check_in != "00:00:00")
							{
								echo $time_check_in;
							}
						?>
					</td>
					<td>
						<?php
							if($check_out != "00:00:00")
							{
								echo $time_check_out;
							}
						?>
					</td>
					<td><?php echo $borrowed_books; ?></td>
					<td>
						<center>
							<div class="guest-action-buttons">
							<?php
								if(strtotime($date_today) > strtotime($date_visited))
								{
									?>
									<button class="btn btn-primary btn-sm" onclick="borrowGuestModal(<?php echo $guest_id; ?>)" title="Borrow book" disabled>
										<span class="fa fa-plus"></span>
									</button>
									<button class="btn btn-danger btn-sm" onclick="returnGuestModal(<?php echo $guest_id; ?>)" title="Return Book" disabled>
										<span class="fa fa-minus"></span>
									</button>

									<button class="btn btn-info btn-sm" onclick="logoutGuestModal(<?php echo $guest_id; ?>)" title="Session expired" disabled>
										<span class="fa fa-flag"></span>
									</button>
									<?php
								}
								else
								{
									if($check_out != "00:00:00")
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="borrowGuestModal(<?php echo $guest_id; ?>)" title="Borrow book" disabled>
											<span class="fa fa-plus"></span>
										</button>

										<button class="btn btn-danger btn-sm" onclick="returnGuestModal(<?php echo $guest_id; ?>)" title="Return Book" disabled>
											<span class="fa fa-minus"></span>
										</button>
										
										<button class="btn btn-success btn-sm" onclick="relogGuestModal(<?php echo $guest_id; ?>)" title="Log-out">
											<span class="fa fa-sign-in"></span>
										</button>
										<?php
									}
									else
									{
										?>
										<button class="btn btn-primary btn-sm" onclick="borrowGuestModal(<?php echo $guest_id; ?>)" title="Borrow book">
										<span class="fa fa-plus"></span>
										</button>

										<button class="btn btn-danger btn-sm" onclick="returnGuestModal(<?php echo $guest_id; ?>)" title="Return Book">
											<span class="fa fa-minus"></span>
										</button>
										<?php
										 if($book_status == 'Borrowed')
										 {
										 	?>
										 	<button class="btn btn-success btn-sm" onclick="relogGuestModal(<?php echo $guest_id; ?>)" title="Log-out" disabled>
												<span class="fa fa-sign-in"></span>
											</button>
										 	<?php
										 }
										 else
										 {
										 	?>
										 	<button class="btn btn-info btn-sm" onclick="logoutGuestModal(<?php echo $guest_id; ?>)" title="Logout guest">
												<span class="fa fa-flag"></span>
											</button>
										 	<?php

										 }
									}
								}
							?>
							</div>
						</center>
					</td>
				</tr>
				<?php
			}
		?>
		</tbody>
	</table>
</div>