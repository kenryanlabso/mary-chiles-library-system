<?php
	//Database connection
	include("../db_con.php");
	$date_acquired = date("Y-m-d");
	
	//Handling file
	$file=$_FILES['book-image']['tmp_name'];
	$image = $_FILES['book-image'] ['name'];
	$image_name= addslashes($_FILES['book-image']['name']);
	$size = $_FILES['book-image'] ['size'];
	$error = $_FILES['book-image'] ['error'];

	//Conditions for the file
	if($size > 10000000)
	{
		die("Format is not allowed or file size is too big!");
	}
	else
	{
		//Upload book image
		move_uploaded_file($_FILES["book-image"]["tmp_name"],"../uploads/books/".$_FILES["book-image"]["name"]);

		//Get the book id
		$query_max_id = "SELECT MAX(book_id) FROM book_tbl";
		$result_max_id= $con->query($query_max_id);
		$row_max_id = $result_max_id->fetch_assoc();
		$max_book_id = $row_max_id['MAX(book_id)'];	

		//Declaration of variables
		$book_id = $max_book_id + 1;
		$author_id = $_POST['author-id'];
		$call_number = $con->escape_string($_POST['call-number']);
		$book_title = $con->escape_string($_POST['book-title']);
		$copyright_year = $_POST['copyright-year'];
		$edition = $_POST['edition'];
		$volume = $_POST['volume'];
		$isbn = $_POST['isbn'];
		$pages = $_POST['pages'];
		$book_status = "Available";
		$book_price = $_POST['book-price'];
		$category_id = $_POST['category-id'];
		$publisher_id = $_POST['publisher-id'];
		$copies = $_POST['copies'];	
		$acquisition_type = $_POST['acquisition-type'];
		$book_image=$_FILES["book-image"]["name"];
		$total_sub_authors = $_POST['total-sub-authors'];	

		//Add to book table
		$query_add_book = "INSERT INTO book_tbl (book_id, call_number, book_title, copyright_year, edition, volume, isbn, pages, book_price, book_image, category_id, publisher_id) VALUES ('$book_id', '$call_number', '$book_title', '$copyright_year', '$edition', '$volume', '$isbn', '$pages', '$book_price', '$book_image', '$category_id', '$publisher_id')";
		if($result_add_book = $con->query($query_add_book))
		{
			for($total=1;$total<=$copies;$total++)
			{
				//Get accession number
				$query_max_accession = "SELECT MAX(accession_number) FROM acquisition_tbl";
				$result_max_accession = $con->query($query_max_accession);
				$row_max_accession = $result_max_accession->fetch_assoc();
				$max_accession_number = $row_max_accession['MAX(accession_number)'];
				$accession_number = $max_accession_number + 1;
				$accession_length = strlen($accession_number);

				//Conditions for generating barcode
				if($accession_length == 1)
				{
					$barcode_id = "01".rand(11, 99).rand(10000, 99999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
				}
				else if($accession_length == 2)
				{
					$barcode_id = "02".rand(11, 99).rand(1000, 9999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
				}
				else if($accession_length == 3)
				{
					$barcode_id = "03".rand(11, 99).rand(100, 999).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
				}
				else if($accession_length == 4)
				{
					$barcode_id = "04".rand(11, 99).rand(10, 99).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);	
				}
				else if($accession_length == 5)
				{
					$barcode_id = "05".rand(11, 99).rand(1, 9).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
				}
				else if($accession_length == 6)
				{
					$barcode_id = "06".rand(11, 99).$accession_number.substr($copyright_year, 2, 2).rand(10, 99);
				}
				//Add to acquisition table
				$query_add_accession = "INSERT INTO acquisition_tbl (accession_number, barcode_id, book_status, fund_source, date_acquired, book_id) VALUES ('$accession_number', '$barcode_id', '$book_status', '$acquisition_type', '$date_acquired', '$book_id')";
				$result_add_accession = $con->query($query_add_accession);
			}

			//Add main author
			$query_add_author =  "INSERT INTO book_author_tbl (book_id, author_id) VALUES ('$book_id','$author_id')";
			if($result_add_author = $con->query($query_add_author))
			{
				if($total_sub_authors != 0)
				{
					for($i=1;$i<=$total_sub_authors;$i++)
					{
						$sub_author_id = $_POST['authors-id-'.$i];
						if(isset($_POST['authors-id-'.$i]))
						{
							$sub_author_id = $_POST['authors-id-'.$i];
							//Add other authors
							$query_add_sub_author = "INSERT INTO book_author_tbl (book_id, author_id) VALUES ('$book_id','$sub_author_id')";
							$result_add_sub_author = $con->query($query_add_sub_author);
						}
					}
				}
			}
		}	
	}
?>