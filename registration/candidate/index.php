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
// chest n
if(isset($_POST['register'])){
	$get_chst = "SELECT * FROM category WHERE cat_code = '$_POST[category]'";
	$run_chst_sel = mysqli_query($connect, $get_chst);
	while($catcode = mysqli_fetch_assoc($run_chst_sel)){
		$ccode = $catcode['cat_id'];
	}
}

// register student
$error = '';
if(isset($_POST['register'])){
	$author = '';
	if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
		$author = $_POST['ug'];
	}else{
		$author = $_SESSION['user'];
	}
	$name = $_POST['name'];
	$category = $_POST['category'];
	$class = $_POST['class'];
	$ugad = $_POST['ugad'];
	$dob = $_POST['dob'];
	$chest = $_POST['chestno'];
	
//	if(isset($_FILES['image'])){
//		$image_name = $_FILES['image']['name'];
//		$image_tmp_name = $_FILES['image']['tmp_name'];
//		$image_size = $_FILES['image']['size'];
//		$image_ext = explode('.', $image_name);
//		$image_real_ext = strtolower(end($image_ext));
//		$image_error = $_FILES['image']['error'];
//		$image_path = 'cphotos/'.$image_name;
//		$image_db_path = 'candidate/cphotos'.$image_name;
//		$allowed = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
//		
//		if(in_array($image_real_ext, $allowed)){
//			if($image_error === 0){
//				if($image_size < 100000){
//						if(move_uploaded_file($image_tmp_name, $image_path)){
//							if($_SESSION['user'] == $author){
//								if(file_exists($image_tmp_name)){
//									$error = '<div class="alert alert-danger small">You have already uploaded the photo!</div>';
//								}else{
									$ins_sql = "INSERT INTO student_reg (std_name, std_cat, std_class, std_adno, std_dob, std_ug, std_chest) VALUES('$name', '$category', '$class', '$ugad', '$dob', '$author', '$chest')";
									$run_ins = mysqli_query($connect, $ins_sql);
									if($run_ins){
										header('Location: index.php?success');
									}else{
										die('Unable to register now, pls try later!');
									}
								}
//							}else{
//								$error = '<div class="alert alert-danger small">You are not author of this candidate!</div>';
//							}
//							
//							}else{
//								$error = '<div class="alert alert-danger small">Unabe to move uploaded file!</div>';
//							}
//						}else{
//							$error = '<div class="alert alert-danger small">Image size is too big to upload! only allowed 100kb!</div>';
//						}
//					}else{
//						$error = '<div class="alert alert-danger small">Sorry there was a problem with uploading image!</div>';
//					}
//				}else{
//					$error = '<div class="alert alert-danger small">The file format does not support!</div>';
//				}
//			}else{
//		
//			$ins_sql = "INSERT INTO student_reg (std_name, std_cat, std_class, std_adno, std_dob, std_ug, std_chest) VALUES('$name', '$category', '$class', '$ugad', '$dob', '$author', '$chest')";
//		
//			$run_ins = mysqli_query($connect, $ins_sql);
//		
//			if($run_ins){
//				header('Location: index.php?success');
//			}else{
//				die('Unable to register now, pls try later!');
//			}
//		}
//	}
	

if(isset($_GET['success'])){
	$error = '<div class="alert alert-success small">The registration was successful!</div>';
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
		<link rel="icon" href="../../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
										<h2>Register candidate</h2>
									</div>
									<?php echo $error; ?>
									<form action="index.php" class="form-horizontal" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<div class="candiPhoto">
												<div class="photoHolder">
													<img src="boy.png" alt="Change photo" width="100%" title="Change photo" class="stdphoto">
												<?php
													if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
														
													}else{
														echo '<input type="file" name="image" class="imgfile">';
													}
												?>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="name" class="input1" id="name" placeholder="Candidate name" required>
												<div class="msg">
													<b>Note: </b>The name given here will be used for official records, Please ensure and provide correct information.
												</div>
											</div>
											
										</div>
										<div class="form-group">
										<div class="col-md-6 float-left">
											<label for="category" class="control-form">Category</label>
											<select name="category" id="category" class="input1 select" required>
												<option value="">Select category</option>
												<?php 
													$sel_sql = "SELECT * FROM category";
													$run_cat_sel = mysqli_query($connect, $sel_sql);

													while($cat = mysqli_fetch_assoc($run_cat_sel)){
														if($cat['cat_code'] == 'K'){
															continue;
														}
														echo '<option value="'.$cat['cat_code'].'">'.ucwords($cat['cat_name']).'</option>';
													}
												?>
											</select>
										</div>
										<div class="col-md-6 float-left">
											<label for="class" class="control-form">Class</label>
											<select name="class" id="class" class="input1 select" required>
												<option value="" selected>Select Class</option>
												<option value="1">Secondary First year</option>
												<option value="2">Secondary Second year</option>
												<option value="3">Secondary Third year</option>
												<option value="4">Secondary Fourth year</option>
												<option value="5">Secondary Fifth year</option>
												<option value="6">S.Secondary First year</option>
												<option value="7">S.Secondary Second year</option>
												<option value="8">Degree First year</option>
												<option value="9">Degree Second year</option>
												<option value="10">Degree Third year</option>
											</select>
										</div>
										<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<div class="col-md-6 float-left">
												<label for="ugad" class="control-form">Ad.No</label>
												<input type="text" name="ugad" id="ugad" class="input1" required>
											</div>
											<div class="col-md-6 float-left">
												<label for="dob" class="control-form">Date of Birth</label>
												<input type="date" name="dob" id="dob" class="input1" required>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group">
											<div class="col-md-6 float-left">
												<label for="chestno" class="control-form">Chest No</label>
												<input type="number" name="chestno" id="chestno" class="input1" required>
											</div>
											<div class="col-md-6 float-left">
												<label for="uglist" class="control-form">Ug</label>
										<?php
											if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
												echo '<select name="ug" id="uglist">
														<option value="" selected>Select UG</option>
													';
													$sql_ug = "SELECT user_id, username, ug_name FROM users WHERE role NOT IN ('markentry')";
													$run_ug = mysqli_query($connect, $sql_ug);
													while($row = mysqli_fetch_assoc($run_ug)){

														echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
													}

												echo '</select>';
												echo '</div>';
											}
												mysqli_close($connect);
										?>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-group mt-4">
											<div class="col-md-12">
												<button class="btn btn-info input2" name="register" value="register">Register</button>
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
				$('#uglist').selectmenu().selectmenu( "menuWidget" )
					.addClass( "overflow" );
				
				// msg info
				$('.msg').hide();
				$('#name').focusin(function(){
				$('.msg').fadeIn();
				});
				$('#name').focusout(function(){
				$('.msg').fadeOut();
				});
			});
		</script>
	</body>
</html>