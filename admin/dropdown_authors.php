<?php 
	include("db_con.php");
?>
	<select id="author-id" name="author-id" onchange="enableSubAuthors()"class="select2" style="width:100%;" required>
		<option></option>
		<?php
			$query_author = "SELECT * FROM author_tbl ORDER BY author_id DESC";
			$result_author = $con->query($query_author);
			while($row_author = $result_author->fetch_assoc())
			{
				$author_id = $row_author['author_id'];
				$author_name = $row_author['author_fname']." ".$row_author['author_mi'].". ".$row_author['author_lname'];
				?>
				<option value="<?php echo $author_id; ?>"><?php echo $author_name; ?></option>
				<?php
			}
		?>
	</select>
	<script type="text/javascript">
	$(document).ready(function () 
	{
		$("#author-id").select2(
		{
			placeholder: "Select Author",
			allowClear: true
		});
	});
	</script>