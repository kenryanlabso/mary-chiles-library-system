<div class="modal fade" id="print-barcodes-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal" title="Close this form">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Print Barcodes</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<label for="barcode-start">Start (Accession No.): </label>
					<select id="barcode-start" onchange="checkBarcodes()" class="form-control">
						<option></option>
						<?php
							$result_start = $con->query("SELECT * FROM acquisition_tbl INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.book_status != 'Archived' ORDER BY accession_number ASC");
							while($row_start = $result_start->fetch_assoc())
							{
								$accession_number = $row_start['accession_number'];
								$book_title = $row_start['book_title'];
								?>
								<option value="<?php echo $accession_number; ?>">
								<?php
									$accession_length = strlen($accession_number);
									for($i=$accession_length;$i<6;$i++)
									{
										if($i != 0)
										{
											echo 0;
										}
									}
									echo $accession_number." - ".$book_title;
								?>
								</option>
								<?php
							}
						?>
					</select>
					
					<label for="barcode-end">End (Accession No.): </label>
					<select id="barcode-end" onchange="checkBarcodes()" class="form-control">
						<option></option>
						<?php
							$result_end = $con->query("SELECT * FROM acquisition_tbl INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.book_status != 'Archived' ORDER BY accession_number ASC");
							while($row_end = $result_end->fetch_assoc())
							{
								$accession_number = $row_end['accession_number'];
								$book_title = $row_end['book_title'];
								?>
								<option value="<?php echo $accession_number; ?>">
								<?php
									$accession_length = strlen($accession_number);
									for($i=$accession_length;$i<6;$i++)
									{
										if($i != 0)
										{
											echo 0;
										}
									}
									echo $accession_number." - ".$book_title;
								?>
								</option>
								<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<p id="barcode-range-error">Invalid range of accession numbers.</p>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-success" id="print-barcodes" onclick="printBarcodes()">Submit</button>
			</div>

		</div>
	</div>
</div>