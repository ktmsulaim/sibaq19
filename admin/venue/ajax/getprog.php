<?php

	include '../../../db.php';
	
	$output = '';
	
		
	$output .= '<table class="table table-modern table-style2">
	<thead>';
	
	if(isset($_GET['programme'])){
		$programme = $_GET['programme'];
		
		//select header datails
		$sel_pdetails = mysqli_query($connect, "SELECT p_name, p_code, p_category FROM programmes WHERE p_code = '".$programme."'");
		while($row2 = mysqli_fetch_assoc($sel_pdetails)){
		$output .= '<tr class="text-center"><th>'.$row2['p_code'].'</th>
		<th colspan="3">'.$row2['p_name'].'</th>
		<th colspan="2">'.ucwords($row2['p_category']).'</th></tr>';
		}
		$output .= '
			<tr>
				<th></th>
				<th>Code Letter</th>
				<th>Candidate</th>
				<th>Chest.No</th>
				<th>Institution</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead><tbody>';
		$sql_getcand = "SELECT c.*, p.p_name, p.p_code FROM final_candidates AS c INNER JOIN programmes AS p ON c.p_code = p.p_code WHERE p.p_code = '".$programme."' ORDER BY c.code_letter";
		$run_getcand = mysqli_query($connect, $sql_getcand);
		$i = 1;

		while($row = mysqli_fetch_assoc($run_getcand)){
			$id = $row['id'];
			$output .= '<tr>
							<td>'.$i.'</td>
							<td>'.$row['code_letter'].'</td>
							<td>'.$row['name'].'</td>
							<td>'.$row['chest'].'</td>
							<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
							<td>'.ucwords($row['status']).'</td>
							<td>'.($row['status'] == 'reported' ? '<a href="javascript:void(0)" onClick="reportCand('."'".$id."'".', '."'".'not reported'."'".')"><i class="fas fa-times"></i></a>' : '<a href="javascript:void(0)" onClick="reportCand('."'".$id."'".', '."'".'reported'."'".')"><i class="fas fa-user-check"></i></a>' ).'</td>
						</tr>';
			
			$i++;
		}
		$output .= '<input type="hidden" name="pcode" value="'.$programme.'"></tbody></table>';
		echo $output;
	}
mysqli_close($connect);
?>
