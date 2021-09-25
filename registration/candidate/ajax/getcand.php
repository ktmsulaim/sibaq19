<?php

	include '../../../db.php';
	
	$output = '';
	
	if(isset($_GET['programme'])){
		$programme = $_GET['programme'];
		$sql_getcand = "SELECT *, p.p_name, p.p_code FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code WHERE p.p_code = '".$programme."' ORDER BY c.cand_id";
		$run_getcand = mysqli_query($connect, $sql_getcand);
		$i = 1;

		while($row = mysqli_fetch_assoc($run_getcand)){
			$output .= '<tr>
			<td>'.$i.'</td>
			<td>'.$row['candidate_name'].'</td>
			<td class="chest"><input type="text" class="form-control" value="'.$row['candidate_code'].'" readonly></td>
			<td>'.$row['author'].'</td>
			</tr>';
			
			$i++;
		}
		echo $output;
	}
mysqli_close($connect);
?>