<?php

	include '../db.php';
	
	$output = '';
	
	if(isset($_GET['programme'])){
		$programme = $_GET['programme'];
		// get kind
		$sql_get_kind = "SELECT p_kind FROM programmes WHERE p_code = '".$programme."'";
		$run_kind = mysqli_query($connect, $sql_get_kind);
		$kind = mysqli_fetch_assoc($run_kind);
		$p_kind = $kind['p_kind'];
		$db = '';
		$pcode = '';
		
		if($p_kind == 'individual'){
			$sql_getcand = "SELECT *, p.p_name, p.p_code, u.place FROM final_candidates AS c INNER JOIN programmes AS p ON c.p_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE p.p_code = '".$programme."' AND c.position IN(1,2,3) OR p.p_code='".$programme."' AND c.grade IN('A','B') ORDER BY c.position_point DESC";
		}else{
			$sql_getcand = "SELECT *, p.p_name, p.p_code, u.place FROM final_group AS c INNER JOIN programmes AS p ON c.p_code = p.p_code INNER JOIN users AS u ON c.ug = u.username WHERE p.p_code = '".$programme."' AND c.position IN(1,2,3) OR p.p_code='".$programme."' AND c.grade IN('A','B') ORDER BY c.position_point DESC";
		}
		
		$run_getcand = mysqli_query($connect, $sql_getcand);
		$i = 1;
		if($p_kind == 'individual'){
			$output .= '<table class="table table-modern table-style2 table-responsive">
							<thead>
								<tr>
									<th>Name</th>
									<th>Chest No</th>
									<th>Position</th>
									<th>Grade</th>
									<th>Institution</th>
								</tr>
							</thead>
							<tbody>';
		}else{
			$output .= '<table class="table table-modern table-style2 table-responsive">
							<thead>
								<tr>
									<th>Institution</th>
									<th>Position</th>
									<th>Grade</th>
								</tr>
							</thead>
							<tbody>';
		}
		while($row = mysqli_fetch_assoc($run_getcand)){
			
			if($p_kind == 'individual'){
				$ug = strtoupper(preg_replace('/@.*/', '', $row['author'])) .', '.$row['place'];
				$output .= '<tr>
				<td>'.$row['name'].'</td>
				<td class="chest">'.$row['chest'].'</td>
				<td class="chest">'.$row['position'].'</td>
				<td class="chest">'.$row['grade'].'</td>
				<td>'.$ug.'</td>
				</tr>';
			}else{
				$ug = strtoupper(preg_replace('/@.*/', '', $row['ug'])) .', '.$row['place'];
				$output .= '<tr>
				<td>'.$ug.'</td>
				<td>'.$row['position'].'</td>
				<td>'.$row['grade'].'</td>
				</tr>';
			}
			
			$i++;
		}
		$output .= '</tbody></table>';
		echo $output;
	}
mysqli_close($connect);
?>