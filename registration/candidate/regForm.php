<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
                }else{
                    header('Location: ../profile.php?expired');
                }
			}else{
				header('Location: login.php');
			}
			while($users = mysqli_fetch_assoc($result)){
				$ugname = $users['ug_name'];
			}
		}
	}else{
		header('Location: login.php');
	}
// find candidate
$chestno = '';
$error = '';
$real_chest = '';
$cand_name = '';
$cand_cat = '';
$category = '';
$cand_ug = '';
if(isset($_POST['find'])){
	$chestno = $_POST['chestno'];
	$sel_cand_detail_sql = "SELECT * FROM student_reg s JOIN users u ON s.std_ug = u.username WHERE BINARY std_chest = '$chestno'";
	if($run_cdtl = mysqli_query($connect, $sel_cand_detail_sql)){
		while($canddtls = mysqli_fetch_array($run_cdtl)){
			$real_chest = $canddtls['std_chest'];
			$cand_name = $canddtls['std_name'];
			$cand_cat = $canddtls['std_cat'];
			$cand_ug = $canddtls['ug_name'];
		}
		if($chestno === $real_chest){
			$_SESSION['chestno'] = $real_chest;
			$_SESSION['cand_name'] = $cand_name;
			$_SESSION['cand_cat'] = $cand_cat;
			
			// get category name
			$sel_cat_sql = "SELECT cat_name FROM category WHERE cat_code = '$_SESSION[cand_cat]'";
			$run_cat_name = mysqli_query($connect, $sel_cat_sql);
			while($cat_row = mysqli_fetch_assoc($run_cat_name)){
				$category = $cat_row['cat_name'];
			}
			$error = '<div class="alert alert-primary small text-center">Candidate found!</div>';
		}else{
			$error = '<div class="alert alert-danger small text-center">No candidate found!</div>';
		}
	}else{
			$error = '<div class="alert alert-danger small text-center">No candidate found!</div>';
		}
}

// candidate authority validation
if(isset($POST['next'])){
	if(empty($_SESSION['chestno']) || empty($_SESSION['cand_name']) || empty($_SESSION['cand_cat'])){
		header('Location: regForm.php?empty');
	}else{
		
	}
}

if(isset($_GET['empty'])){
	$error = '<div class="alert alert-danger small text-center">Empty feald! Find candidate first!</div>';
}
mysqli_close($connect);
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.10.6/jquery.typeahead.min.css">
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
				<div class="row">
					<div class="col-lg-2">
						
					</div>
					<div class="col-lg-10">
						<div class="wrapper">
						<div class="row">
							<div class="col-md-8">
								<div class="formWrapper">
								<?php 
									if(isset($_GET['success'])){
										echo'<div class="alert alert-success text-center">Registered successfully!</div>';
									}elseif(isset($_GET['comingsoon'])){
										echo'<div class="alert alert-warning text-center">Coming soon!</div>';
									}elseif(isset($_GET['authfailed'])){
										echo'<div class="alert alert-danger text-center">You are no belonged to this chest number!</div>';
									}elseif(isset($_GET['failed'])){
										echo'<div class="alert alert-danger text-center">Registration failed! Try again!</div>';
									}
										echo $error;
									?>
									<div class="head3">
										<h2>Register programmes</h2>
									</div>
									<form action="regForm.php" class="form-horizontal" method="post">
										<div class="form-group">
											<div class="regPhoto">
												<div class="photoHolderNew">
													<img src="../../img/hand-with-pen.png" alt="Register programme" width="100%" title="Change photo">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<label for="chestno" class="control-form">Chest No</label>
													<div class="input-group mb-6">
														<div class="input-group-prepend">
															<span class="input-group-text" id="chestnolabel">Eg.5114</span>
														</div>
														<?php
															echo '<input type="number" name="chestno" id="chestno" class="form-control" autocomplete="off" aria-label="Chest No" aria-describedby="chestnolabel" value="'.$real_chest.'" required>';
														?>
														<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
													</div>
											</div>
											
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<label for="name" class="control-form">Candidate Name</label>
												<?php
													echo '<input type="text" name="name" class="input1" id="name" placeholder="Candidate name" value="'.$cand_name.'" readonly>';
												?>
											</div>
											
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<label for="name" class="control-form">UG</label>
												<?php
													echo '<input type="text" name="name" class="input1" id="name" placeholder="Candidate name" value="'.$cand_ug.'" readonly>';
												?>
											</div>
											
										</div>
										<div class="form-group">
										<div class="col-md-12">
											<label for="category" class="control-form">Category</label>
										</div>
										<div>
											<div class="col-md-6 float-left">
												<?php
												echo '<input type="text" name="category" class="input1" placeholder="Category Code" value="'.$cand_cat.'" readonly>';
												?>
											</div>
											<div class="col-md-6 float-left">
												<?php
												echo '<input type="text" name="category" class="input1" placeholder="Category Name" value="'.ucfirst($category).'" readonly>';
												
											?>
											</div>
											<div class="clearfix"></div>
										</div>
										</div>
									</form>
									<form action="program.php" class="form-horizontal" method="post" role="form">
										<div class="form-group mt-4">
											<div class="col-md-12">
												<button id="fnextbtn" class="btn btn-info input2" name="next" value="next">Next</button>
											</div>
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
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.10.6/jquery.typeahead.min.js"></script>
	  	<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
		
		<script type="text/javascript">
			$(function(){
				$('#tab').tabs();
				$('.table').tablesorter();
				$('.select').selectmenu();
				$('#programmes input').checkboxradio();
			})
		</script>
	</body>
</html>