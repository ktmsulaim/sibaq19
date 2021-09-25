<?php

	include '../../../db.php';
	
	$output = '';
	$category = '';
	if(isset($_GET['programme'])){
		$programme = $_GET['programme'];
		$zone = $_GET['zone'];
	
			$getcand_sql = "SELECT * FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE c.prog_code = '$programme' AND u.zone = '$zone' AND p.p_st_nst = 'y' ORDER BY c.candidate_code";
			$run_getcand = mysqli_query($connect, $getcand_sql);
		
			$getcat_sql = "SELECT * FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE c.prog_code = '$programme' AND u.zone = '$zone' AND p.p_st_nst = 'y' ORDER BY c.code_letter ASC";
			$run_getcat = mysqli_query($connect, $getcat_sql);
			$rowcat = mysqli_fetch_assoc($run_getcat);
			$category .= $rowcat['category'];
			$i = 1;
			$output .= '<table class="table table-striped" id="candidates">
						<thead>
						<tr><th colspan="5" class="text-center">'.$category.'</th></tr>
								<tr>
									<th>Sl.no</th>
									<th>Od.no</th>
									<th>Candidate</th>
									<th>Chest No</th>
									<th>Institution</th>
								</tr>
							</thead>
							<tbody>';
			while($candrow = mysqli_fetch_assoc($run_getcand)){
					$category .= $candrow['category'];
					$output .= '<tr>
					<td>'.$i.'</td>
					<td>'.$candrow['code_letter'].'</td>
					<td>'.$candrow['candidate_name'].'</td>
					<td>'.$candrow['candidate_code'].'</td>
					<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
					</tr>';
					$i++;
				}
		$output .= '</tbody></table>';
		echo $output;
	}
mysqli_close($connect);
?>