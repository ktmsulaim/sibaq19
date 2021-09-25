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
			header('Location: result.php?success=publish_programme');
		}else{
			header('Location: result.php?failed=publish_programme');
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
		$sql_updateprg = "UPDATE programmes SET status = 'unpublish', pb_date = '$date' WHERE p_code = '$pcode'";
		$run_updateprg = mysqli_query($connect, $sql_updateprg);
		if($run_updateprg){
			header('Location: result.php?success=unpublish_programme');
		}else{
			header('Location: result.php?failed=unpublish_programme');
		}
	mysqli_close($connect);
}

// Update prepare status into database
//////////////////////// PREPARE ////////////////////////////////
if(isset($_POST['prepare'])){
		// get kind of programme
		$pcode = $_POST['pcode'][0];
		$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$pcode'";
		$run_getkind = mysqli_query($connect, $getkind_sql);
		$row1 = mysqli_fetch_assoc($run_getkind);
		$p_kind = $row1['p_kind'];
	// If it is indidividual update from candidate_reg table
		if($p_kind == 'individual'){
		foreach($_POST['id'] as $id=>$mark){
		$ids = $mark;
		$pcode = $_POST["pcode"][$id];
		$rank = $_POST["rank"][$id];
		$status = $_POST["status"][$id];
		
		$sql_update = "UPDATE candidate_reg SET rank = $rank, status = '$status', prepare = 'true' WHERE cand_id = '$ids' AND prog_code = '$pcode'";
		$run_update = mysqli_query($connect, $sql_update);
		}
		if($run_update){
			header('Location: result.php?success=prepare');
		}else{
			header('Location: result.php?failed=prepare');
		}
	
	}else{ // group points
		foreach($_POST['id'] as $id=>$mark){
		$ids = $mark;
		$rank = $_POST["rank"][$id];
		$status = $_POST["status"][$id];
			
		$sql_update = "UPDATE group_points SET rank = '$rank', status = '$status', prepare = 'true' WHERE grp_id = '$ids'";
		$run_update = mysqli_query($connect, $sql_update);
		$sql_updategrp = "UPDATE candidate_reg c INNER JOIN group_points AS g ON c.prog_code = g.p_code SET c.status = g.status, c.prepare = g.prepare WHERE g.grp_id = '$mark' AND g.ug = c.author AND g.status = 'Selected'";
		$run_updategrp = mysqli_query($connect, $sql_updategrp);
		
			if($run_update && $run_updategrp){
			header('Location: result.php?success=prepare');
		}else{
			header('Location: result.php?failed=prepare');
		}
		
	}
}
mysqli_close($connect);
}

///////////////////////////// UNPREPARE ///////////////////////////////
if(isset($_POST['unprepare'])){
		// get kind of programme
		$pcode = $_POST['pcode'][0];
		$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$pcode'";
		$run_getkind = mysqli_query($connect, $getkind_sql);
		$row1 = mysqli_fetch_assoc($run_getkind);
		
		$p_kind = $row1['p_kind'];
	// If it is indidividual update from candidate_reg table
	if($p_kind == 'individual'){
		foreach($_POST['id'] as $id=>$mark){
			$ids = $mark;
			$pcode = $_POST["pcode"][$id];

			$sql_update = "UPDATE candidate_reg SET rank = 0, status = '', prepare = 'false' WHERE cand_id = '$ids' AND prog_code = '$pcode'";
			$run_update = mysqli_query($connect, $sql_update);
			
			if($run_update){
				header('Location: result.php?success=unprepare');
			}else{
				header('Location: result.php?failed=unprepare');
			}
		}
	
	}else{ /// group points
		$grp_id = $_POST['id'];
		foreach($grp_id as $id=>$mark){
		$ids = $mark;
		$prog = $_POST["pcode"][$id];
		$sql_update = "UPDATE group_points SET rank = 0, status = '', prepare = 'false' WHERE grp_id = '$mark' AND p_code = '$prog'";
		$run_update = mysqli_query($connect, $sql_update);
		
		$sql_updategrp = "UPDATE candidate_reg c INNER JOIN group_points AS g ON c.prog_code = g.p_code SET c.status = '', c.prepare = 'false' WHERE g.grp_id = '$mark'";
		$run_updategrp = mysqli_query($connect, $sql_updategrp);
			
		if($run_update && $run_updategrp){
			header('Location: result.php?success=unprepare');
		}else{
			header('Location: result.php?failed=unprepare');
		}
	}
}

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
								<h4>Candidate Status</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="result.php" class="form-horizontal" role="form" method="post">
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
								
								<form action="result.php" class="form-horizontal" role="form" method="post">
								<table class="table table-striped">
									<h4 class="text-right">Selected : <span class="badge badge-danger" id="count"></span></h4>
									<thead>
										<tr><th colspan="12" class="text-center">
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
											<th class="text-center">J1</th>
											<th class="text-center">J2</th>
											<th class="text-center">J3</th>
											<th class="text-center">Total</th>
											<th class="text-center">R</th>
											<th class="text-center">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if(isset($_POST['find'])){
												$getcand_sql = "SELECT c.cand_id, c.category_code, c.prog_code, c.code_letter, c.candidate_name, candidate_code, c.author, c.j1, c.j2, c.j3, c.total, p.p_kind FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code WHERE c.prog_code = '$_POST[pcode]' ORDER BY c.total DESC";
												$run_getcand = mysqli_query($connect, $getcand_sql);
												
												$getlimit_sql = "SELECT c.prog_code, c.category_code FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code WHERE c.prog_code = '$_POST[pcode]' ORDER BY c.total DESC";
												$run_getlimit = mysqli_query($connect, $getlimit_sql);
												$i = 1;
												
												// set candidate selection count category wise
												$select = '';
												$array_ccode = mysqli_fetch_assoc($run_getlimit);
												$ccode = $array_ccode['category_code'];
												$p_code = $array_ccode['prog_code'];
												$exception = array('D8', 'L1','L7','L8', 'W8');
												
												
												if($ccode == 'D' || $ccode == 'L' || $ccode == 'N' ){
													$select = 8;
												}elseif($ccode == 'W' || $ccode == 'A' || $ccodec == 'K'){
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
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['prog_code'].'" readonly class="form-control" name="pcode[]">'.$i.'</td>
															<td>'.$candrow['code_letter'].'</td>
															<td>'.$candrow['candidate_name'].'</td>
															<td><input type="hidden" value="'.$candrow['cand_id'].'" readonly class="form-control" name="id[]">'.$candrow['candidate_code'].'</td>
															<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															<td><input type="hidden" name="j1[]" value="'.$candrow['j1'].'">'.$candrow['j1'].'</td>
															<td><input type="hidden" name="j2[]" value="'.$candrow['j2'].'">'.$candrow['j2'].'</td>
															<td><input type="hidden" name="j3[]" value="'.$candrow['j3'].'">'.$candrow['j3'].'</td>
															<td>'.$candrow['total'].'</td>
															<td><input type="hidden" name="rank[]" value="'.$i.'">'.$i.'</td>
															<td><input class="status" type="hidden" name="status[]" value="'.($i <= $select ? 'Selected' : '').'">'.($i <= $select ? 'Selected' : '').'</td>
															</tr>';
															$i++;
														} else{ ?> 
														
														<?php 
															$sql_grp_prg = "SELECT g.grp_id,g.p_code,g.code_letter,g.ug,g.j1, g.j2, g.j3, g.total FROM group_points AS g INNER JOIN programmes AS p ON g.p_code = p.p_code WHERE g.p_code = '$_POST[pcode]' ORDER BY g.total DESC, g.ug ASC";
															$run_getcand = mysqli_query($connect, $sql_grp_prg);
															$i = 1;
															$numrow = mysqli_num_rows($run_getcand);
															while($candrow = mysqli_fetch_assoc($run_getcand)){
																	echo '<tr>
																	<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode[]">'.$i.'</td>
																	<td>'.$candrow['code_letter'].'</td>
																	<td><input type="hidden" value="'.$candrow['grp_id'].'" readonly class="form-control" name="id[]"></td>
																	<td></td>
																	<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																	<td>'.$candrow['j1'].'</td>
																	<td>'.$candrow['j2'].'</td>
																	<td>'.$candrow['j3'].'</td>
																	<td>'.$candrow['total'].'</td>
																	<td><input type="hidden" name="rank[]" value="'.$i.'">'.$i.'</td>
																	<td><input class="status" type="hidden" name="status[]" value="'.($i <= $select ? 'Selected' : '').'">'.($i <= $select ? 'Selected' : '').'</td>
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
												$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$pcode'";
												$run_getkind = mysqli_query($connect, $getkind_sql);
												$row1 = mysqli_fetch_assoc($run_getkind);
												$p_kind = $row1['p_kind'];
												$db = '';
												$pcode = '';
												if($p_kind == 'individual'){
													$db = 'candidate_reg';
													$pcode = 'prog_code';
												}else{
													$db = 'group_points';
													$pcode = 'p_code';
												}
												$sel_progstat = "SELECT status FROM programmes WHERE p_code = '$_POST[pcode]'";
												$run_progstat = mysqli_query($connect, $sel_progstat);
												$statrow = mysqli_fetch_assoc($run_progstat);
												$status = $statrow['status'];
												
												// sql to update prepare or not
												$sel_prep_stat = "SELECT prepare FROM $db WHERE $pcode = '$_POST[pcode]'";
												$run_prepstat = mysqli_query($connect, $sel_prep_stat);
												$prrow = mysqli_fetch_assoc($run_prepstat);
												$prepare = $prrow['prepare'];
												
												// check whether status is published
												if($status == 'unpublish' && $prepare == 'false'){
													echo '<input type="submit" class="btn btn-warning input mr-2" name="prepare" value="Prepare">';
													
													
												}elseif($status == 'unpublish' && $prepare == 'true'){
													echo '<input type="submit" class="btn btn-warning input mr-2" name="unprepare" value="Unprepare">';
													echo '<input type="submit" class="btn btn-success input" name="publish" value="Publish">';
													echo '<a href="print/result.php?print&pcode='.$_POST['pcode'].'" target="_blank" class="btn btn-secondary input ml-2">Print</a>';
												}elseif($status == 'publish' && $prepare == 'false'){
													echo '<input type="submit" class="btn btn-warning input mr-2" name="prepare" value="Prepare">';
													echo '<input type="submit" class="btn btn-danger input" name="unpublish" value="Unpublish">';
												}else{
													echo '<input type="submit" class="btn btn-warning input mr-2" name="unprepare" value="Unprepare">';
													echo '<input type="submit" class="btn btn-danger input" name="unpublish" value="Unpublish">';
													echo '<a href="print/result.php?print&pcode='.$_POST['pcode'].'" target="_blank" class="btn btn-secondary input ml-2">Print</a>';
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
		<script>
			$(function(){
			var count = $(".status[value='Selected']").length;
			$('#count').text(count);
			});
		</script>
	</body>
</html>