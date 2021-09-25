<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				
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

// Delete entry from db
if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM student_reg WHERE std_id = '$_GET[del_id]'";
		$run_del = mysqli_query($connect, $del_sql);
		if($run_del){
			header('Location: candidates.php?success');
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
		<link rel="stylesheet" href="../css/jquery-ui.min.css" media="all">
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
							<?php include 'include/nav.php'; ?>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9">
						<div class="wrapper">
							<?php if(isset($_GET['success'])){
								echo '<div class="col-md-4 m-auto alert alert-success text-center">Deleted successfully!</div>';
							}elseif(isset($_GET['failed'])){
								echo '<div class="col-md-6 m-auto alert alert-danger text-center">You cannot delete the selected entry!</div>';
							} ?>
							<div class="head3">
								<h3>Candidates</h3>
							</div>
							<div class="uploadopt">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="msg">
												You can now upload your candidates' photos as we instructed. Photo should be the current Rename the photo with their chest number. <a href="uploadphoto.php" class="btn">Go to upload page</a>
											</div>
											<div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="candidates">
								<table class="table">
									<thead>
										<?php
											if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'markentry'){
												echo '<tr>
											<th>Sl.No</th>
											<th>Name</th>
											<th>Category</th>
											<th>Ad.No</th>
											<th>Date of Birth</th>
											<th>Chest No</th>
											<th>Ug</th>
											<th>Delete</th>
										</tr>';
											}else{
												echo '<tr>
											<th>Sl.No</th>
											<th>Name</th>
											<th>Category</th>
											<th>Ad.No</th>
											<th>Date of Birth</th>
											<th>Chest No</th>
										</tr>';
											}
										?>
									</thead>
									<tbody>
										<tr>
											<?php
												if($_SESSION['role'] == 'admin'){
													$sel_prog = "SELECT * FROM student_reg s JOIN category c, users u WHERE c.cat_code = s.std_cat AND s.std_ug = u.username AND u.role = 'ug' ORDER BY s.std_id DESC";
													$run_student_sel = mysqli_query($connect, $sel_prog);
													$i = 1;	

													while($row = mysqli_fetch_assoc($run_student_sel)){
														echo '<tr><td>'.$i.'</td>
																<td>'.strtoupper($row['std_name']).'</td>
																<td>'.ucwords($row['cat_name']).'</td>
																<td>'.$row['std_adno'].'</td>
																<td>'.$row['std_dob'].'</td>
																<td>'.$row['std_chest'].'</td>
																<td>'.strtoupper(preg_replace('/@.*/', '',$row['username'] )).'</td>
																<td><a id="trash" href="candidates.php?del_id='.$row['std_id'].'"><i class="fa fa-trash text-center"></i></a></td>
																</tr>';
														$i++;
													}
													
												}elseif($_SESSION['role'] == 'natadmin'){
													$sel_prog = "SELECT * FROM student_reg s JOIN category c, users u WHERE c.cat_code = s.std_cat AND s.std_ug = u.username AND u.role = 'ugnat' ORDER BY s.std_id DESC";
													$run_student_sel = mysqli_query($connect, $sel_prog);
													$i = 1;	

													while($row = mysqli_fetch_assoc($run_student_sel)){
														echo '<tr><td>'.$i.'</td>
																<td>'.strtoupper($row['std_name']).'</td>
																<td>'.ucwords($row['cat_name']).'</td>
																<td>'.$row['std_adno'].'</td>
																<td>'.$row['std_dob'].'</td>
																<td>'.$row['std_chest'].'</td>
																<td>'.strtoupper(preg_replace('/@.*/', '',$row['username'] )).'</td>
																<td><a id="trash" href="candidates.php?del_id='.$row['std_id'].'"><i class="fa fa-trash text-center"></i></a></td>
																</tr>';
														$i++;
													}
												}elseif($_SESSION['role'] == 'markentry'){
													$sel_prog = "SELECT * FROM student_reg AS s INNER JOIN category AS c ON c.cat_code = s.std_cat INNER JOIN users AS u ON s.std_ug = u.username WHERE c.cat_name = '$_SESSION[user]' AND u.role = 'ug' ORDER BY s.std_id DESC";
													$run_student_sel = mysqli_query($connect, $sel_prog);
													$i = 1;	

													while($row = mysqli_fetch_assoc($run_student_sel)){
														echo '<tr><td>'.$i.'</td>
																<td>'.strtoupper($row['std_name']).'</td>
																<td>'.ucwords($row['cat_name']).'</td>
																<td>'.$row['std_adno'].'</td>
																<td>'.$row['std_dob'].'</td>
																<td>'.$row['std_chest'].'</td>
																<td>'.strtoupper(preg_replace('/@.*/', '',$row['username'] )).'</td>
																<td><a id="trash" href="candidates.php?del_id='.$row['std_id'].'"><i class="fa fa-trash text-center"></i></a></td>
																</tr>';
														$i++;
													}
												}else{
													$sel_prog = "SELECT * FROM student_reg s JOIN category c WHERE s.std_ug = '$_SESSION[user]' AND c.cat_code = s.std_cat ORDER BY s.std_id DESC";
													$run_student_sel = mysqli_query($connect, $sel_prog);
													$i = 1;	

													while($row = mysqli_fetch_assoc($run_student_sel)){
														echo '<tr><td>'.$i.'</td>
																<td>'.strtoupper($row['std_name']).'</td>
																<td>'.ucwords($row['cat_name']).'</td>
																<td>'.$row['std_adno'].'</td>
																<td>'.$row['std_dob'].'</td>
																<td>'.$row['std_chest'].'</td>
																</tr>';
														$i++;
													}
												}
											mysqli_close($connect);
											?>
										</tr>
									</tbody>
								</table>
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
			});
		</script>
	</body>
</html>