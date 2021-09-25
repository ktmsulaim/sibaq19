<?php
	include '../../db.php';
	$request = mysqli_real_escape_string($connect, $_POST['query']);
	$sel_sql = "SELECT * FROM student_reg WHERE std_name LIKE '%".$request."%'";
	
	$result = mysqli_query($connect, $sel_sql);
	$data = array();
	if(mysqli_num_rows($result > 0)){
		while($row = mysqli_fetch_assoc($result)){
			$data[] = $row['std_name'];
		}
		echo json_encode($data);
	}
mysqli_close($connect);
?>