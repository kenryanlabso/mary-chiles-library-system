<?php
	include("db_con.php"); 
?>
	<select id="publisher-id" name="publisher-id" class="select2" style="width:100%;" required>
		<option></option>
		<?php
			$query_publisher = "SELECT * FROM publisher_tbl ORDER BY publisher_id DESC";
			$result_publisher = $con->query($query_publisher);
			while($row_publisher = $result_publisher->fetch_assoc())
			{
				$publisher_id = $row_publisher['publisher_id'];
				$publisher_name = $row_publisher['publisher_name'];
				?>
				<option value="<?php echo $publisher_id; ?>">
					<?php echo " ".$publisher_name; ?>
				</option>
				<?php
			}
		?>
	</select>
	<script type="text/javascript">
	$(document).ready(function () 
	{
		$("#publisher-id").select2(
		{
			placeholder: "Select Publisher",
			allowClear: true
		});
	});
	</script>
	