<?php
	session_start();
	include '../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'media'){
                    
                }else{
                    header('Location: login.php?login=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
		}else{
			header('Location: login.php');
		}


?>
<!DOCTYPE html>
<html>
	<head>
		<title>All programmes</title>
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/css/fontawesome-all.min.css" media="all">
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<?php include 'theme/header.php'; ?>
		
		<div class="row">
		<?php include 'theme/side.php'; ?>
		<div class="col-lg-10 mt-5 pt-3">
			<div class="row">
				<div class="col-md-12">
					<div class="display-3">
						<h4>All programmes</h4>
						<hr>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-11">
								<div class="allprogrammes">
								<div class="allprogInner">
										<div class="prgwrapper">
											<div class="ugwise">
											</div>
											<div class="row">
												<?php
													
														$prg_sql = "SELECT p_name, p_code, p_category, p_category_c FROM programmes";
														$run_prg = mysqli_query($connect, $prg_sql);
														while($frow = mysqli_fetch_assoc($run_prg)){
															echo '<div class="col-md-12 mt-3 mb-3"><table class="table-bordered">';
															echo '<thead class="thead-dark"><tr><th colspan="4" class="text-center">'.$frow['p_name'].' -'.ucfirst($frow['p_category']).'</th></tr>
															<tr>
															<th>Sl.no</th>
															<th>Candidate</th>
															<th>Chest No</th>
															<th>Institution</th>
															</tr>
															</thead><tbody>';
															$programme = array();
															$programme[] = $frow['p_code'];
															foreach($programme as $programmes => $pcode){
																$select_candsql = "SELECT name, chest, author, u.place FROM final_candidates AS c INNER JOIN programmes AS p ON c.p_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE p.p_code = '$pcode' ORDER BY RAND()";
																$run_candsel = mysqli_query($connect, $select_candsql);
																$i = 1;
																while($srow = mysqli_fetch_assoc($run_candsel)){
																	echo '<tr>
																		<td>'.$i.'</td>
																		<td></td>
																		<td>'.$srow['name'].'</td>
																		<td>'.$srow['chest'].'</td>
																		<td>'.strtoupper(preg_replace('/@.*/', '', $srow['author'])).', '.$srow['place'].'</td>
																	</tr>';
																	$i++;
																}
															}
															echo '</tbody></table></div>';
														}
															mysqli_close($connect);
											
												?>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		
	</body>
</html>