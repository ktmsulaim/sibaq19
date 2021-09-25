<?php
	
	include '../../../db.php';
	
	$programmes = '';
	if(isset($_GET['category'])){
		$cat = $_GET['category'];
		
		$sql_getprogrammes = "SELECT p_code, p_name FROM programmes WHERE p_category = '".$cat."'";
		$run_getprogrammes = mysqli_query($connect, $sql_getprogrammes);
		echo '<optgroup label="'.ucfirst($_GET['category']).'">';
		while($row = mysqli_fetch_assoc($run_getprogrammes)){
			$programmes .= '<option value="'.$row['p_code'].'">'.$row['p_name'].'</option>';
		}
		echo '</optgroup>';
		echo $programmes;
	}
mysqli_close($connect);
?>