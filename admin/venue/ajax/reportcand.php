<?php
include '../../../db.php';
// update status of candidate
if(isset($_GET['status'])){
	$status = $_GET['status'];
	$id = $_GET['id'];
	$update = mysqli_query($connect, "UPDATE final_candidates SET status = '$status' WHERE id = '$id'");
	if($update){
		header('Refresh:0; url=report.php');
		echo 'Updated ID: '. $id;
		
	}else{
		echo 'Not updated';
	}
}
mysqli_close($connect);
?>