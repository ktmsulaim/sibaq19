<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'markentry'){
                    
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


// select count
$ugcode = '';
$bidaya = '';
$uoola = '';
$thaniya = '';
$thanawiya = 'W';
$aliya = 'A';

// select ug code
if($_SESSION['role'] == 'admin'){
	$ugcode = 'ug';
}elseif($_SESSION['role'] == 'natadmin'){
	$ugcode = 'ugnat';
}
if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
	$bidaya = 'D';
	$uoola = 'L';
	$thaniya = 'N';
	
}elseif($_SESSION['role'] == 'ugnat' || $_SESSION['role'] == 'natadmin'){
	$bidaya = 'B';
	$uoola = 'U';
	$thaniya = 'T';
}

$p_kind = '';
// insert mark into database
	if(isset($_POST['addletters'])){
		$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$_POST[pcode]'";
		$run_getkind = mysqli_query($connect, $getkind_sql);
		$row1 = mysqli_fetch_assoc($run_getkind);
		$p_kind = $row1['p_kind'];
		
			if($p_kind == 'individual'){
				foreach($_POST['id'] as $id=>$candid){
				$ids = $candid;
				$cletter = $_POST["cletter"][$id];

				$sql_update = "UPDATE candidate_reg SET code_letter = '$cletter' WHERE cand_id = $ids";
				$run_update = mysqli_query($connect, $sql_update);
				}

				if($run_update){
					header('Location: codeentry.php?success');
				}else{
					header('Location: codeentry.php?failed');
				}	
			}else{
				foreach($_POST['gid'] as $gid=>$ids){
				$cletter = $_POST["cletter"][$gid];
	
				$sql_update = "UPDATE group_points SET code_letter = '$cletter' WHERE grp_id = '$ids'";
				$run_update = mysqli_query($connect, $sql_update);
				}
	
				if($run_update){
					header('Location: codeentry.php?success');
				}else{
					header('Location: codeentry.php?failed');
				}
			}
		}else{}
	
// clear codes

	if(isset($_GET['clear'])){
		$sql_clear = "UPDATE candidate_reg SET code_letter = '' WHERE prog_code = '$_GET[p_code]'";
		if(mysqli_query($connect, $sql_clear)){
			header('Location: codeentry.php?cleared');
		}
	}
//get error message
$msg = '';
	if(isset($_GET['empty'])){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Input cannot be empty!</div>';
	}elseif(isset($_GET['success'])){
		$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Code entried successfully!</div>';
	}elseif(isset($_GET['failed'])){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Code entry failed!</div>';
	}elseif(isset($_GET['cleared'])){
		$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Code cleared successfully!</div>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Results > Code entry</title>
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
								<h4>Code Letter Entry</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="codeentry.php" class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label for="pcode" class="control-form">Programme code</label>
											<div class="input-group mb-6">
												<div class="input-group-prepend">
													<span class="input-group-text" id="pcodelabel">Eg.D12</span>
												</div>
												<?php
													// set programme code as if it is edit or first entry
												
													$p_code = '';
													if(isset($_POST['find'])){
														$p_code = $_POST['pcode'];
													}elseif(isset($_GET['edit'])){
														$p_code = $_GET['p_code'];
													}
												
													if(isset($_POST['find']) || isset($_GET['edit'])){
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" value="'.$p_code.'" required placeholder="Enter programme code to find candidate">';
													}else{
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" required placeholder="Enter programme code to find candidate">';
													}
												?>
												<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
											</div>
										</div>
								</form>
								
								
								<form action="codeentry.php" class="form-horizontal" role="form" method="post">
								<table class="table table-bordered" id="markentry">
									<thead>
										<tr><th colspan="7" class="text-center">
											<?php
												if(isset($_POST['find']) || isset($_GET['edit'])){
													$get_progname_sql = "SELECT * FROM programmes WHERE p_code = '$p_code'";
													$run_pname = mysqli_query($connect, $get_progname_sql);
													while($pnamerow = mysqli_fetch_assoc($run_pname)){
														$p_kind = $pnamerow['p_kind'];
														echo $pnamerow['p_name'].' - '.ucfirst($pnamerow['p_category']);
													}
												}else{
													echo '';
												}
												
											?>
										</th></tr>
										<tr>
											<?php
												if(isset($_POST['find']) || isset($_GET['edit'])){
													if($p_kind == 'individual'){
														echo '<th>Sl.no</th>
																<th>Code Letter</th>
																<th>Candidate</th>
																<th>Chest No</th>
																<th>Institution</th>';
													}else{
														echo '<th>Sl.no</th>
																<th>Code Letter</th>
																<th>Institution</th>';
													}
												}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
											if(isset($_POST['find'])){
													$getcand_sql = "SELECT c.*, p.p_kind FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code WHERE c.prog_code = '$_POST[pcode]'";
													$run_getcand = mysqli_query($connect, $getcand_sql);
													$i = 1;
													$numrow = mysqli_num_rows($run_getcand);
													
													while($candrow = mysqli_fetch_assoc($run_getcand)){
														$_SESSION['pkind'] = $candrow['p_kind'];
														if($candrow['p_kind'] == 'individual'){
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['prog_code'].'" readonly class="form-control" name="pcode">'.$i.'</td>
															<td><input type="hidden" class="form-control" name="cletter[]" value="'.$candrow['code_letter'].'">'.$candrow['code_letter'].'</td>
															<td>'.$candrow['candidate_name'].'</td>
															<td><input type="hidden" value="'.$candrow['cand_id'].'" readonly class="form-control" name="id[]">'.$candrow['candidate_code'].'</td>
															<td><input type="hidden" value="'.$candrow['author'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															</tr>';
															$i++;
														
														}else{
														?>
													
													<?php 
														$sql_grp_prg = "SELECT * FROM group_points WHERE p_code = '$_POST[pcode]'";
														$_SESSION['pcode'] = $_POST['pcode'];
														$run_getcand = mysqli_query($connect, $sql_grp_prg);
														$i = 1;
														while($candrow = mysqli_fetch_assoc($run_getcand)){
															$percentage = ($candrow['total'] == '' ? '' : ($candrow['total'] * 100) / 30) . ' %';
															
																echo '<tr>
																<td><input type="hidden" class="form-control" name="pcode" value="'.$candrow['p_code'].'">'.$i.'</td>
																<td><input type="hidden" class="form-control" name="cletter[]" value="'.$candrow['code_letter'].'">'.$candrow['code_letter'].'</td>
																<td><input type="hidden" value="'.$candrow['grp_id'].'" readonly class="form-control" name="gid[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																</tr>';
																$i++;
															
														} ?>
													
													<?php
													}
												}
											}
										?>
										<?php
											if(isset($_GET['edit'])){
													$getcand_sql = "SELECT c.*, p.p_kind FROM candidate_reg c INNER JOIN programmes p ON c.prog_code = p.p_code WHERE c.prog_code = '$_GET[p_code]'";
													$run_getcand = mysqli_query($connect, $getcand_sql);
													$i = 1;
													$numrow = mysqli_num_rows($run_getcand);
													while($candrow = mysqli_fetch_assoc($run_getcand)){
														if($p_kind == 'individual'){
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['prog_code'].'" readonly class="form-control paste-me" name="pcode">'.$i.'</td>
															<td><input type="text" class="form-control" name="cletter[]" value="'.$candrow['code_letter'].'"></td>
															<td>'.$candrow['candidate_name'].'</td>
															<td><input type="hidden" value="'.$candrow['cand_id'].'" readonly class="form-control" name="id[]">'.$candrow['candidate_code'].'</td>
															<td><input type="hidden" value="'.$candrow['author'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															</tr>';
															$i++;
														}else{ ?>
														
													<?php
													$sql_grp_prg = "SELECT * FROM group_points WHERE p_code = '$_GET[p_code]'";
														$_SESSION['pcode'] = $_GET['p_code'];
														$run_getcand = mysqli_query($connect, $sql_grp_prg);
														$i = 1;
														while($candrow = mysqli_fetch_assoc($run_getcand)){
																echo '<tr>
																<td><input type="hidden" class="form-control" name="pcode" value="'.$candrow['p_code'].'">'.$i.'</td>
																<td><input type="text" class="form-control" name="cletter[]" value="'.$candrow['code_letter'].'">
																<input type="hidden" value="'.$candrow['grp_id'].'" readonly class="form-control" name="gid[]"></td>
																<td><input type="hidden" value="'.$candrow['ug'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																</tr>';
																$i++;
														} ?>
														<?php
													}
												}
											}
										mysqli_close($connect);
										?>
										
									</tbody>
								</table>
								
									
										<div class="form-group clearfix">
											<?php
												if(isset($_POST['find'])){
													echo '<a href="codeentry.php?edit&p_code='.$p_code.'" class="btn btn-secondary input float-right ml-2">Edit</a>';
													echo '<a href="codeentry.php?clear&p_code='.$p_code.'" class="btn btn-warning input float-right ml-2">Clear Code</a>';
												}elseif(isset($_POST['find']) || isset($_GET['edit'])){
													echo '<input type="submit" class="btn btn-info input float-right mb-3" value="Submit" name="addletters">';
												}
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
				$('.table').tablesorter();
				$('#category').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
				$('#programme').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
			});
		</script>
	</body>
</html>