<?php
	include '../db.php';

echo '<table class="table table-modern table-style3 table-responsive">
		<thead>
			<tr>
				<th></th>
				<th>Venue</th>
				<th>Programme</th>
				<th>P.Code</th>
				<th>Category</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>';

				$get_venue = mysqli_query($connect, "SELECT * FROM venues");
				$i = 1;
				while($row2 = mysqli_fetch_assoc($get_venue)){
					$venue = array();
					$venue[] = $row2['id'];

					foreach($venue as $value=>$key){
						$get_current = mysqli_query($connect, "SELECT * FROM final_schedule f INNER JOIN venues v ON f.venue = v.id WHERE f.status IN('running', 'paused') AND v.id = $key");
						$nop = mysqli_num_rows($get_current);
						while($row3 = mysqli_fetch_assoc($get_current)){

							if($nop  == 0){
								echo '<tr>
											<td class="text-center" colspan="6">
												No programmes!
											</td>
										</tr>';
							}else{
									echo '<tr>
									<td>'.$i.'</td>
									<td>'.$row3['venue_name'].'</td>
									<td>'.$row3['programme'].'</td>
									<td>'.$row3['p_code'].'</td><td>'.ucwords($row3['category']).'</td><td>'.ucwords($row3['status']).'</td>
								</tr>';
							}
						}

					}
					$i++;
				}

		echo '</tbody>
	</table>';
?>