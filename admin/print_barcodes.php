<?php
	include("db_con.php");
	include("session.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='../bootstrap-3.3.7-dist/css/bootstrap-style.css'/>
		<link rel="icon" href="../images/logo.png"/>
		<style>
		body
		{
			font-size:11px;
		}
		.barcode-image
		{
			border:1px solid black;
			display:inline-block;
			padding:5px;
			text-align:center;
		}
		</style>
	</head>
	<body>
<?php

	if(isset($_GET['type'])) 
	{
		$type = $_GET['type'];
		if($type == "batch")
		{
			$start = $_GET['start'];
			$end = $_GET['end'];

			$result_generate = $con->query("SELECT * FROM acquisition_tbl INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.accession_number BETWEEN '$start' AND '$end'");
			while($row_generate = $result_generate->fetch_assoc())
			{
				$accession_number = $row_generate['accession_number'];
				$barcode_id = $row_generate['barcode_id'];
				$book_title = $row_generate['book_title'];

				?>
				<div class="barcode-image">
					<?php 
						echo "Accession Number: ";
						$accession_length = strlen($accession_number);
						for($i=$accession_length;$i<6;$i++)
						{
							if($i != 0)
							{
							echo 0;
							}
						}
						echo $accession_number;
					 ?><br/>
					<?php echo $book_title; ?><br/>
					<center>
						<img src="BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=<?php echo $barcode_id; ?>&thickness=70&start=NULL&code=BCGcode128" style="padding:10px;border:1px solid black;"/>
					</center>
				</div>
				<?php
				echo "<script>window.print();</script>";
			}
		}
		else
		{
			$accession_number = $_GET['accession-number'];
			$result_generate = $con->query("SELECT * FROM acquisition_tbl INNER JOIN book_tbl ON acquisition_tbl.book_id = book_tbl.book_id WHERE acquisition_tbl.accession_number = '$accession_number'");
			$row_generate = $result_generate->fetch_assoc();
			$barcode_id = $row_generate['barcode_id'];
			$book_title = $row_generate['book_title'];

			?>
			<div class="barcode-image">
				<?php 
					echo "Accession Number: ";
					$accession_length = strlen($accession_number);
						for($i=$accession_length;$i<6;$i++)
						{
							if($i != 0)
							{
							echo 0;
							}
						}
						echo $accession_number;
					 ?><br/>
					<?php echo $book_title; ?><br/>
					<center>
						<img src="BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=<?php echo $barcode_id; ?>&thickness=70&start=NULL&code=BCGcode128" style="padding:10px;border:1px solid black;"/>
					</center>
				</div>
				<?php
				echo "<script>window.print();</script>";
		}
	}	
?>
	</body>
</html>