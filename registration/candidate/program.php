<?php
	session_start();
	include '../../db.php';
	$url = 'login.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE BINARY username = '$_SESSION[user]' AND BINARY password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
                }else{
                    header('Location: ../profile.php?expired');
                }
			}else{
				header('Location:'.$url);
			}
			while($users = mysqli_fetch_assoc($result)){
				$ugname = $users['ug_name'];
			}
		}
	}else{
		header('Location:'.$url);
	}

//set name category variables


$name = $_SESSION['cand_name'];
$category = $_SESSION['cand_cat'];
$chest = $_SESSION['chestno'];

$get_cat_name_sql = "SELECT * FROM category WHERE cat_code = '$category'";
$run_cat_name = mysqli_query($connect, $get_cat_name_sql);
$category_rows = mysqli_fetch_assoc($run_cat_name);
$category_name = ucwords($category_rows['cat_name']);

$error = '';
// set ug / nat ug class

$institution = '';
//if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'ug' || $_SESSION['']){
	
if($_SESSION['cand_cat'] == 'B' || $_SESSION['cand_cat'] == 'U' || $_SESSION['cand_cat'] == 'T'){
	$institution = ' nat';
}else{
	$institution = ' ug';
}

// set author if admin or not admin
	$author = '';

if(isset($_POST['reg'])){
//			
		if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
			$author = $_POST['ug'];
		}else{
			$author = $_SESSION['user'];
		}
	
			$progs = $_POST['programme'];
			
			foreach ($progs as $prog => $pcode){
				$reg_prog_sql = "INSERT INTO candidate_reg(candidate_name, candidate_code, category, category_code, prog_code, code_letter, author,j1,j2,j3,total,rank,status,prepare) VALUES('$name', '$chest', '$category_name', '$category', '$pcode','', '$author', 0,0,0,0,0,'','false')";
				$run_reg = mysqli_query($connect, $reg_prog_sql);
				if($run_reg){
					$url = 'proglist.php?success';
					header('Location:'.$url);
				}else{
					header('Location: regForm.php?failed');
				}
			}
		}
?>

	
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Candidate Registration</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
		
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					
						<?php include 'topbar.php'; ?>
					
				</div>
				<div class="row">
					<div class="col-lg-2">

					</div>
					<div class="col-lg-10">
						<div class="wrapper">
						<div class="row">
							<div class="col-md-8">
								<div class="formWrapper">
									<div class="head3">
										<h2>Register candidate <span class="badge badge-default"><?php echo $category_name; ?></span></h2>
									</div>
									<form action="program.php" class="form-horizontal" method="post" role="form">
										<div class="form-group">
											<div class="candiname">
											<table class="table">
												<tr>
												<th>Candidate</th>
													<td class="tdname"><?php echo strtoupper($name); ?></td>
												</tr>
												<tr>
													<th>Chest No</th>
													<td class="chstno">
														<?php
														//get category no

														echo $chest;
														?>
													</td>
												</tr>
												<tr>
													<th>Selected</th>
													<td id="selCount"></td>
												</tr>
												<tr>
													<th>Status</th>
													<td id="selStatus"></td>
												</tr>
												<?php
													if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
														echo '<tr>
															<th>UG</th>
															<td id="ugsel"><select name="ug" id="uglist">
																<option value="" selected>Select UG</option>
															';
															$sql_ug = "SELECT user_id, username, ug_name FROM users WHERE role NOT IN ('markentry')";
															$run_ug = mysqli_query($connect, $sql_ug);
															while($row = mysqli_fetch_assoc($run_ug)){
												
																echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
															}
															
														echo '</select></td>
														</tr>';
													}
												?>
											</table>
												
											</div>
										</div>
										<div class="form-group">
											<div id="programmes">
												<div class="showDiv">
													
												</div>
											<div id="tab">
												<ul>
													<li><a href="#nstage">Non Stage <span class="badge badge-default"><?php 
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'non_stage' AND p_category_c = '$category'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														echo mysqli_num_rows($run_prog_sel);
														?></span></a></li>
													<li><a href="#stage">Stage <span class="badge badge-default"><?php 
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'stage' AND p_category_c = '$category'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														echo mysqli_num_rows($run_prog_sel);
														?></span></a></li>
														<li><a href="#kulliya">Kulliya <span class="badge badge-default"><?php 
														$sel_prog = "SELECT * FROM programmes WHERE p_category_c = 'K'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														echo mysqli_num_rows($run_prog_sel);
														?></span></a></li>
												</ul>
												<div id="nstage">
				
								<!--					non stage individual							-->
												
													<h5 class="tabsub">Individual</h5>
													<fieldset>
													<?php 
														
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'non_stage' AND p_category_c = '$category' AND p_kind = 'individual'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														while($programmes = mysqli_fetch_assoc($run_prog_sel)){
															
															echo'<label for="'.$programmes['p_code'].'">'.$programmes['p_name'].'</label>
														<input type="checkbox" name="programme[]" id="'.$programmes['p_code'].'" value="'.$programmes['p_code'].'" class="individual '.$programmes['p_char'].' '.$programmes['p_curb'].$institution.'">';
														}
														
														?>
													</fieldset>
													
									<!--					non stage group								-->
													<?php
													if(mysqli_num_rows($run_prog_sel) >= 1){
															echo '<h5 class="tabsub">Group</h5>';
														}else{
														echo '';
													}
													?>
													<fieldset>
														
													
													<?php
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'non_stage' AND p_category_c = '$category' AND p_kind = 'group'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														while($programmes = mysqli_fetch_assoc($run_prog_sel)){
															
															echo'<label for="'.$programmes['p_code'].'">'.$programmes['p_name'].'</label>
														<input type="checkbox" name="programme[]" id="'.$programmes['p_code'].'" value="'.$programmes['p_code'].'" class="group '.$programmes['p_char'].' '.$programmes['p_curb'].'">';
														}
													?>
													
													</fieldset>
												</div>
												<div id="stage">
												<h5 class="tabsub">Individual</h5>
													<fieldset>
													<?php 
														
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'stage' AND p_category_c = '$category' AND p_kind = 'individual'";
														$run_prog_sel = mysqli_query($connect, $sel_prog);
														while($programmes = mysqli_fetch_assoc($run_prog_sel)){
															
															echo'<label for="'.$programmes['p_code'].'">'.$programmes['p_name'].'</label>
														<input type="checkbox" name="programme[]" id="'.$programmes['p_code'].'" value="'.$programmes['p_code'].'" class="individual '.$programmes['p_char'].' '.$programmes['p_curb'].$institution.'">';
														}
														
														?>
													</fieldset>
													
									<!--					stage group								-->
													<?php
													if(mysqli_num_rows($run_prog_sel) >= 1){
															echo '<h5 class="tabsub">Group</h5>';
														}else{
														echo '';
													}
													?>
													<fieldset>
														
													
													<?php
														$sel_prog = "SELECT * FROM programmes WHERE p_type = 'stage' AND p_category_c = '$category' AND p_kind = 'group'";
														$run_prog_select = mysqli_query($connect, $sel_prog);
														while($programmes = mysqli_fetch_assoc($run_prog_select)){
															
															echo'<label for="'.$programmes['p_code'].'">'.$programmes['p_name'].'</label>
														<input type="checkbox" name="programme[]" id="'.$programmes['p_code'].'" value="'.$programmes['p_code'].'" class="group '.$programmes['p_char'].' '.$programmes['p_curb'].'">';
														}
													?>
													
													</fieldset>
													
												</div>
												<div id="kulliya">
													<fieldset>
														
													
													<?php
														$sel_prog = "SELECT * FROM programmes WHERE p_category_c = 'K'";
														$run_prog_select = mysqli_query($connect, $sel_prog);
														while($programmes = mysqli_fetch_assoc($run_prog_select)){
															
															echo'<label for="'.$programmes['p_code'].'">'.$programmes['p_name'].'</label>
														<input type="checkbox" name="programme[]" id="'.$programmes['p_code'].'" value="'.$programmes['p_code'].'" class="group '.$programmes['p_char'].' '.$programmes['p_curb'].'">';
														}
														mysqli_close($connect);
													?>
													
													</fieldset>
												</div>
											</div>
												
											</div>
										</div>
										<div class="form-group" id="buttongrp">
											<a href="regForm.php" class="btn btn-primary input2" style="color:#fff !important;">Back</a>
											<button class="btn btn-info input2" name="reg" id="nextbtn">Register</button>
										</div>
									</form>
								</div>
							</div>
						</div>
							
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
	  	<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#tab').tabs();
				$('.table').tablesorter();
				$('.select').selectmenu();
				$('#uglist').selectmenu().selectmenu( "menuWidget" )
					.addClass( "overflow" );
				$('#programmes input').checkboxradio();
				
				//limitation info
					
			});
		</script>
		<script src="reg.js"></script>
	</body>
</html>
