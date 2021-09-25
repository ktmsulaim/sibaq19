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


// insert mark into database
if(isset($_POST['addmark'])){
	$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$_POST[pcode]'";
	$run_getkind = mysqli_query($connect, $getkind_sql);
	$row1 = mysqli_fetch_assoc($run_getkind);
	$p_kind = $row1['p_kind'];
	
	if($p_kind == 'individual'){
		foreach($_POST['id'] as $id=>$candid){
		$ids = $candid;
		$p = $_POST["p"][$id];
		$pp = $_POST["pp"][$id];
		$g = $_POST["g"][$id];
		$gp = $_POST["gp"][$id];
		
			
		$sql_update = "UPDATE final_candidates SET position = '$p', position_point = '$pp', grade = '$g', grade_point = '$gp' WHERE id = '$ids'";
		$run_update = mysqli_query($connect, $sql_update);
		}
	
		if($run_update){
			header('Location: finalmarkentry.php?success');
		}else{
			header('Location: finalmarkentry.php?failed');
		}	
	}else{
		foreach($_POST['gid'] as $gid=>$ids){			
				
				$p = $_POST["p"][$gid];
				$pp = $_POST["pp"][$gid];
				$g = $_POST["g"][$gid];
				$gp = $_POST["gp"][$gid];
			
				$sql_update = "UPDATE final_group SET position = '$p', position_point = '$pp', grade = '$g', grade_point = '$gp' WHERE id = '$ids'";
				$run_update = mysqli_query($connect, $sql_update);
				}
	
				if($run_update){
					header('Location: finalmarkentry.php?success');
				}else{
					header('Location: finalmarkentry.php?failed');
				}
	}
}

// clear marks

	if(isset($_GET['clear'])){
		$pcode = $_GET['p_code'];
		$sql_clear = "UPDATE final_candidates SET position = '', position_point = 0, grade = '', grade_point = 0 WHERE p_code = '$pcode'";
		$run_clear = mysqli_query($sql_clear);
		if($run_clear){
			header('Location: finalmarkentry.php?cleared');
		}else{
			header('Location: finalmarkentry.php?failed=clear');
		}
	}
//get error message
$msg = '';
	if(isset($_GET['empty'])){
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Input cannot be empty!</div>';
	}elseif(isset($_GET['success'])){
		$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Mark entried successfully!</div>';
	}elseif(isset($_GET['cleared'])){
		$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Mark cleared successfully!</div>';
	}elseif(isset($_GET['failed'])){
		if($_GET['failed'] == 'clear'){
			$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Mark clearance failed!</div>';
		}
		$msg = '<div class="alert alert-danger col-md-4 m-auto small text-center">Failed!</div>';
	}elseif(isset($_GET['cleared'])){
		$msg = '<div class="alert alert-success col-md-4 m-auto small text-center">Mark cleared successfully!</div>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Final Results > Mark entry</title>
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
								<h4>Final Mark Entry</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="finalmarkentry.php" class="form-horizontal" role="form" method="post">
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
								
								
								<form action="finalmarkentry.php" class="form-horizontal" role="form" method="post">
								<table class="table table-bordered" id="markentry">
									<thead>
										<tr><th colspan="9" class="text-center">
											<?php
												if(isset($_POST['find']) || isset($_GET['edit'])){
													$get_progname_sql = "SELECT * FROM programmes WHERE p_code = '$p_code'";
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
										</tr>
									</thead>
									<tbody>
										<?php
											if(isset($_POST['find'])){
													$getcand_sql = "SELECT c.*, p.p_kind FROM final_candidates c INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$_POST[pcode]' ORDER BY c.code_letter";
													$run_getcand = mysqli_query($connect, $getcand_sql);
													$i = 1;
													$numrow = mysqli_num_rows($run_getcand);
													
													while($candrow = mysqli_fetch_assoc($run_getcand)){
														$_SESSION['pkind'] = $candrow['p_kind'];
														if($candrow['p_kind'] == 'individual'){
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode">'.$i.'</td>
															<td>'.$candrow['code_letter'].'</td>
															<td>'.$candrow['name'].'</td>
															<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="id[]">'.$candrow['chest'].'</td>
															<td><input type="hidden" value="'.$candrow['author'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															
															<td><input type="hidden" name="p[]" class="form-control" value="'.$candrow['position'].'">'.$candrow['position'].'</td>
															
															<td><input type="hidden" name="pp[]" class="form-control" value="'.$candrow['position_point'].'">'.$candrow['position_point'].'</td>
															
															<td><input type="hidden" name="g[]" class="form-control" value="'.$candrow['grade'].'">'.$candrow['grade'].'</td>
															
															<td><input type="hidden" name="gp[]" class="form-control" value="'.$candrow['grade_point'].'">'.$candrow['grade_point'].'</td>
															</tr>';
															$i++;
														
														}else{
														?>
													
													<?php 
														$sql_grp_prg = "SELECT * FROM final_group WHERE p_code = '$_POST[pcode]'";
														$_SESSION['pcode'] = $_POST['pcode'];
														$run_getcand = mysqli_query($connect, $sql_grp_prg);
														$i = 1;
														while($candrow = mysqli_fetch_assoc($run_getcand)){
															
																echo '<tr>
																<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode">'.$i.'</td>
																<td>'.$candrow['code_letter'].'</td>
																<td></td>
																<td></td>
																<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="gid[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																
																<td><input type="hidden" name="p[]" class="form-control" value="'.$candrow['position'].'">'.$candrow['position'].'</td>
															
																<td><input type="hidden" name="pp[]" class="form-control" value="'.$candrow['position_point'].'">'.$candrow['position_point'].'</td>

																<td><input type="hidden" name="g[]" class="form-control" value="'.$candrow['grade'].'">'.$candrow['grade'].'</td>

																<td><input type="hidden" name="gp[]" class="form-control" value="'.$candrow['grade_point'].'">'.$candrow['grade_point'].'</td>
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
													$getcand_sql = "SELECT c.*, p.p_kind FROM final_candidates c INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$_GET[p_code]' ORDER BY c.code_letter";
													$run_getcand = mysqli_query($connect, $getcand_sql);
													$i = 1;
													$numrow = mysqli_num_rows($run_getcand);
													while($candrow = mysqli_fetch_assoc($run_getcand)){
														if($candrow['p_kind'] == 'individual'){
															echo '<tr>
															<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode">'.$i.'</td>
															<td>'.$candrow['code_letter'].'</td>
															<td>'.$candrow['name'].'</td>
															<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="id[]">'.$candrow['chest'].'</td>
															<td><input type="hidden" value="'.$candrow['author'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															
															<td><input type="text" name="p[]" class="form-control" value="'.$candrow['position'].'"></td>
															
															<td><input type="number" name="pp[]" class="form-control" value="'.$candrow['position_point'].'" step=".01"></td>
															
															<td><input type="text" name="g[]" class="form-control" value="'.$candrow['grade'].'"></td>
															
															<td><input type="number" name="gp[]" class="form-control" value="'.$candrow['grade_point'].'" step=".01"></td>
															</tr>';
															$i++;
														}else{ ?>
														
													<?php
													$sql_grp_prg = "SELECT * FROM final_group WHERE p_code = '$_GET[p_code]' ORDER BY code_letter";
														$_SESSION['pcode'] = $_GET['p_code'];
														$run_getcand = mysqli_query($connect, $sql_grp_prg);
														$i = 1;
														while($candrow = mysqli_fetch_assoc($run_getcand)){
																echo '<tr>
																<td><input type="hidden" value="'.$candrow['p_code'].'" readonly class="form-control" name="pcode">'.$i.'</td>
																<td>'.$candrow['code_letter'].'</td>
																<td></td>
																<td><input type="hidden" value="'.$candrow['id'].'" readonly class="form-control" name="gid[]"></td>
																<td><input type="hidden" value="'.$candrow['ug'].'" readonly class="form-control" name="ug[]">'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																
																<td><input type="number" name="p[]" class="form-control" value="'.$candrow['position'].'"></td>
															
																<td><input type="number" name="pp[]" class="form-control" value="'.$candrow['position_point'].'"></td>

																<td><input type="text" name="g[]" class="form-control" value="'.$candrow['grade'].'"></td>

																<td><input type="number" name="gp[]" class="form-control" value="'.$candrow['grade_point'].'"></td>
																
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
													echo '<a href="finalmarkentry.php?edit&p_code='.$p_code.'" class="btn btn-secondary input float-right ml-2">Edit</a>';
													echo '<a href="finalmarkentry.php?clear&p_code='.$p_code.'" class="btn btn-warning input float-right ml-2">Clear mark</a>';
												}
											?>
											<input type="submit" class="btn btn-info input float-right mb-3" value="Submit" name="addmark">
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
		<script>
			$(function(){
				// disable scroll on input number
				$(document).on("wheel", "input[type=number]", function (e) {
					$(this).blur();
				});
			});
		</script>
	</body>
</html>