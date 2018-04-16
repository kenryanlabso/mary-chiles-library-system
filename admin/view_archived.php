<?php
	include("db_con.php");
?>
	<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
	<button class="btn btn-primary pull-right" title="Restore Books" style="margin-right:3px; margin-bottom:10px;">
		<span class="fa fa-recycle"></span>
		&nbsp;Restore Books
	</button>
	<div style="font-size:22px; font-weight:bold;">Records:</div>
	<div class="table table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<th><center>Accession No.</center></th>
				<th><center>Book Title</center></th>
				<th><center>Year</center></th>
				<th><center>Edition</center></th>
				<th><center>Volume</center></th>
				<th><center>Reason</center></th>
				<th><center>Remarks</center></th>
				<th><center>Date Archived</center></th>
				<th><center>In-Charge</center></th>
				<th><center>Restore</center></th>
			</thead>
			<tbody>
			<?php
				$query_view = "SELECT * FROM archive_tbl INNER JOIN acquisition_tbl ON archive_tbl.accession_number = acquisition_tbl.accession_number INNER JOIN book_tbl ON book_tbl.book_id = acquisition_tbl.book_id ORDER BY archive_date DESC";
				$result_view = $con->query($query_view);
				while($row = $result_view->fetch_array())
				{
					$accession_number = $row['accession_number'];
					$book_title = $row['book_title'];
					$copyright_year = $row['copyright_year'];
					$edition = $row['edition'];
					$volume = $row['volume'];
					$archive_reason = $row['archive_reason'];
					$archive_remarks = $row['archive_remarks'];
					$date_archive = date($row['archive_date']);
					$archive_date = date("m/d/Y", strtotime($date_archive));
					$account_number = $row['account_number'];
					?>
				<tr>
					<td>
					<?php 
						$accession_length = strlen($accession_number);
						for($i=$accession_length;$i<6;$i++)
						{
							if($i != 0)
							{
								echo 0;
							}
						}
						echo $accession_number; 
					?>
					</td>
					<td><?php echo $book_title; ?></td>
					<td><?php echo "c".$copyright_year; ?></td>
					<td><?php echo $edition; ?></td>
					<td>
					<?php
						if($volume != 0)
						{
							echo $volume;
						}
					?>
					</td>
					<td><?php echo $archive_reason; ?></td>
					<td><?php echo $archive_remarks; ?></td>
					<td><?php echo $archive_date; ?></td>
					<td><?php echo $account_number; ?></td>
					<td>
						<center>
							<button class="btn btn-primary btn-sm" onclick="restoreBookModal(<?php echo $accession_number; ?>)" title="Restore Book">
								<span class="fa fa-recycle"></span>
							</button>
						</center>
					</td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>