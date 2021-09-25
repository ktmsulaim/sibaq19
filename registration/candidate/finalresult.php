<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'markentry'){
                    
                }else{
                    header('Location: ../profile.php?noaccess');
                }
			}else{
				header('Location: login.php');
			}
			while($users = mysqli_fetch_assoc($result)){
				$ugname = $users['ug_name'];
				$sibaq_id = $users['sibaq_id'];
				$email = $users['email'];
				$contact = $users['contact_no'];
				$coordinator = $users['coordinator'];
				$address = $users['address'];
			}
		}
	}else{
		header('Location: login.php');
	}
/*------------------------------------------------------------------------------------------------------------------------*/

// Update status into database
//////////////////////// PUBLISH ////////////////////////////////
if(isset($_POST['publish'])){
		// get kind of programme
		$pcode = $_POST['pcode'][0];
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d h:i:s');
	// update main programmes
		$sql_updateprg = "UPDATE programmes SET status = 'publish', pb_date = '$date' WHERE p_code = '$pcode'";
		$run_updateprg = mysqli_query($connect, $sql_updateprg);
		if($run_updateprg){
			header('Location: finalresult.php?success=publish_programme');
		}else{
			header('Location: finalresult.php?failed=publish_programme');
		}
	mysqli_close($connect);
}

//////////////////////// UNPUBLISH ////////////////////////////////
if(isset($_POST['unpublish'])){
		// get kind of programme
		$pcode = $_POST['pcode'][0];
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d h:i:s');
	// update main programmes
		$sql_updateprg = "UPDATE programmes SET status = 'unpublish', pb_date = NULL WHERE p_code = '$pcode'";
		$run_updateprg = mysqli_query($connect, $sql_updateprg);
		if($run_updateprg){
			header('Location: finalresult.php?success=unpublish_programme');
		}else{
			header('Location: finalresult.php?failed=unpublish_programme');
		}
	mysqli_close($connect);
}

//get error message
$msg = '';
	if(isset($_GET['empty'])){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Input cannot be empty!</div>';
	}elseif(isset($_GET['success'])){
		if($_GET['success'] == 'publish'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Candidate selected!</div>';
		}elseif($_GET['success'] == 'publish_programme'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Result published!</div>';
		}elseif($_GET['success'] == 'unpublish'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Candidate Deselected!</div>';
		}elseif($_GET['success'] == 'unpublish_programme'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Result unpublished!</div>';
		}elseif($_GET['success'] == 'prepare'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Result prepared!</div>';
		}elseif($_GET['success'] == 'unprepare'){
			$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Result unprepared!</div>';
		}
	}elseif(isset($_GET['failed'])){
		if($_GET['failed'] == 'publish_programme'){
			$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Failed publishing programme!</div>';
		}elseif($_GET['failed'] == 'publsih'){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Candidates not selected!</div>';
		}elseif($_GET['failed'] == 'unpublish_programme'){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Failed unpublishing programme!</div>';
		}elseif($_GET['failed'] == 'prepare'){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Result not prepared!</div>';
		}elseif($_GET['failed'] == 'unprepare'){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Result not unprepared!</div>';
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Results > Candidate Status</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="../css/tableexport.min.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					
						<?php include 'topbar.php'; ?>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-3 bg-dark" id="profileSide">
						<ul class="navbar-nav" id="menu">
						<?php
							 include 'include/nav.php';
						?>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9">
						<?php echo $msg; ?>
						<div class="wrapper">
							<div class="head1">
								<h4>Final Candidate Status</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="finalresult.php" class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label for="pcode" class="control-form">Programme code</label>
											<div class="input-group mb-6">
												<div class="input-group-prepend">
													<span class="input-group-text" id="pcodelabel">Eg.D12</span>
												</div>
												<?php
													if(isset($_POST['find'])){
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" value="'.$_POST['pcode'].'" required placeholder="Enter programme code to find candidate">';
													}else{
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" required placeholder="Enter programme code to find candidate">';
													}
												?>
												<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
											</div>
										</div>
								</form>
								
								<form action="finalresult.php" class="form-horizontal" role="form" method="post">
								<table class="table table-striped">
									<thead>
										<tr><th colspan="10" class="text-center">
											<?php
												if(isset($_POST['find'])){
													$get_progname_sql = "SELECT * FROM programmes WHERE p_code = '$_POST[pcode]'";
													$run_pname = mysqli_query($connect, $get_progname_sql);
													while($pnamerow = mysqli_fetch_assoc($run_pname)){
														echo $pnamerow['p_name'].' - '.ucfirst($pnamerow['p_category']);
													}
												}else{
													echo '';
												}
												
											?>
										</th></tr>
										<tr>
											<th>Sl.no</th>
											<th>Code</th>
											<th>Candidate</th>
											<th>Chest No</th>
											<th>Institution</th>
											<th class="text-center">P</th>
											<th class="text-center">PP</th>
											<th class="text-center">G</th>
											<th class="text-center">GP</th>
											<th class="text-center">GT</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if(isset($_POST['find'])){
												$getcand_sql = "SELECT c.id, c.c_code, c.p_code, c.code_letter, c.name, c.chest, c.author, c.position, c.position_point, c.grade, c.grade_point, p.p_kind FROM final_candidates c INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$_POST[pcode]' ORDER BY c.position_point DESC, c.grade_point DESC";
												$run_getcand = mysqli_query($connect, $getcand_sql);
												
												$getlimit_sql = "SELECT c.p_code, c.c_code FROM final_candidates c INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$_POST[pcode]'";
												$run_getlimit = mysqli_query($connect, $getlimit_sql);
												$i = 1;
												
												// set candidate selection count category wise
												$select = '';
												$array_ccode = mysqli_fetch_assoc($run_getlimit);
												$ccode = $array_ccode['c_code'];
												$p_code = $array_ccode['p_code'];
												$exception = array('D8', 'L1','L7','L8', 'W8');
												
												
												if($ccode == 'D' || $ccode == 'L' || $ccode == 'N' ){
													$select = 8;
												}elseif($ccode == 'W' || $ccode == 'A' || $ccode == 'K'){
													$select = 6;
												}
												
												if($p_code == 'D8' || $p_code == 'L7' || $p_code == 'L8' || $p_code == 'L9'){
													$select = 16;
												}elseif($p_code == 'W8'){
													$select = 12;
												}elseif($p_code == 'K4'){
													$select = 6;
												}elseif($p_code == 'K1' || $p_code == 'K2'){
													$select = 4;
												}
												$numrow = mysqli_num_rows($run_getcand);
												while($candrow = mysqli_fetch_assoc($run_getcand)){
													
														if($candrow['p_kind'] == 'individual'){
															$total = ($candrow['position_point'] + $candrow['grade_point']);
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode[]">'.$i.'</td>
															<td>'.$candrow['code_letter'].'</td>
															<td>'.$candrow['name'].'</td>
															<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="id[]">'.$candrow['chest'].'</td>
															<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															
															<td><input type="hidden" name="p[]" class="form-control" value="'.$candrow['position'].'">'.$candrow['position'].'</td>
															
															<td><input type="hidden" name="pp[]" class="form-control" value="'.$candrow['position_point'].'">'.$candrow['position_point'].'</td>
															
															<td><input type="hidden" name="g[]" class="form-control" value="'.$candrow['grade'].'">'.$candrow['grade'].'</td>
															
															<td><input type="hidden" name="gp[]" class="form-control" value="'.$candrow['grade_point'].'">'.$candrow['grade_point'].'</td>
															
															<td>'.$total.'</td>
															</tr>';
															$i++;
														} else{ ?> 
														
														<?php 
															$sql_grp_prg = "SELECT g.id,g.p_code,g.code_letter,g.ug,g.position, g.position_point, g.grade, g.grade_point FROM final_group AS g INNER JOIN programmes AS p ON g.p_code = p.p_code WHERE g.p_code = '$_POST[pcode]' ORDER BY g.position_point DESC, g.grade_point DESC";
															$run_getcand = mysqli_query($connect, $sql_grp_prg);
															$i = 1;
															while($candrow = mysqli_fetch_assoc($run_getcand)){
																$total = ($candrow['position_point'] + $candrow['grade_point']);
																	echo '<tr>
																	<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode[]">'.$i.'</td>
																	<td>'.$candrow['code_letter'].'</td>
																	<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="id[]"></td>
																	<td></td>
																	<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																	
																	<td>'.$candrow['position'].'</td>
															
																	<td>'.$candrow['position_point'].'</td>

																	<td>'.$candrow['grade'].'</td>

																	<td>'.$candrow['grade_point'].'</td>
																	<td>'.$total.'</td>
																	</tr>';
																	$i++;
														}?>
													
												<?php }
												}
											}
										?>
										
									</tbody>
								</table>
									<div class="form-group">
										<?php
											if(isset($_POST['find'])){
												$pcode = $_POST['pcode'];
												$getkind_sql = "SELECT status FROM programmes WHERE p_code = '$pcode'";
												$run_getkind = mysqli_query($connect, $getkind_sql);
												$row1 = mysqli_fetch_assoc($run_getkind);
												$status = $row1['status'];
												
												// check whether status is published
												if($status == 'unpublish'){
													echo '<input type="submit" class="btn btn-success input" name="publish" value="Publish">';
													
												}else{
													echo '<input type="submit" class="btn btn-danger input" name="unpublish" value="Unpublish">';
												}
												
											}
										mysqli_close($connect);
										?>
									</div>
								</form>
								</div>							
							</div>
						</div>
					</div>
				</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
	  	<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
<!--	Export to excel sheet jquery	-->
	
		<script src="../js/FileSaver.js"></script>
		<script src="../js/tableexport.min.js"></script>
		
<!--	old browser support	-->
		<script src="../js/Blob.js"></script>
		<script src="../js/xlsx.core.min.js"></script>
		<script src="../js/export.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>