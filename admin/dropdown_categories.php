<?php
	include("db_con.php");
?>
	<select id="category-id" name="category-id" class="select2" style="width:100%;" required>
		<option></option>
		<?php
			$query_category = "SELECT * FROM category_tbl";
			$result_category = $con->query($query_category);
			while($row = $result_category->fetch_assoc())
			{
				$category_id = $row['category_id'];
				$classname = $row['classname'];
				?>
				<option value="<?php echo $category_id; ?>">
					<?php echo " ".$classname; ?>
				</option>
				<?php
			}
		?>
	</select>

	<script type="text/javascript">
	$(document).ready(function () 
	{
		$("#category-id").select2(
		{
			placeholder: "Select Category",
			allowClear: true
		});
	});
	</script>