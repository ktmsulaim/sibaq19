<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
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

// Delete entry from db
if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM student_reg WHERE std_id = '$_GET[del_id]'";
		$run_del = mysqli_query($connect, $del_sql);
		if($run_del){
			header('Location: candidates.php?success');
		}
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

// Delete entry from db
if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM candidate_reg WHERE cand_id = '$_GET[del_id]'";
		$run_del = mysqli_query($connect, $del_sql);
		if($run_del){
			header('Location: statics.php?success');
		}else{
			header('Location: statics.php?failed');
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
						<?php if(isset($_GET['success'])){
								echo '<div class="col-md-4 m-auto alert alert-success text-center small">Deleted successfully!</div>';
							}elseif(isset($_GET['failed'])){
								echo '<div class="col-md-6 m-auto alert alert-danger text-center small">Sorry the selected entry was not deleted!</div>';
							} ?>
						<div class="wrapper">
							<div class="head1">
								<h4>Zone based candidates</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="print/ycat.php" method="get" role="form">
									<div class="form-group">
										<div class="col-md-6 float-left">
											<label for="zone">Zone</label>
											<select name="zone" id="zone">
												<option value="">Select Zone</option>
												<?php
													$sql_selzone = "SELECT * FROM zones";
													$run_selzone = mysqli_query($connect, $sql_selzone);
													while($row = mysqli_fetch_assoc($run_selzone)){
														echo '<option value="'.$row['zone_id'].'">'.strtoupper($row['zone_name']).'</option>';
													}
												?>
											</select>
										</div>
										<div class="col-md-6 float-left">
											<label for="prog">Programme</label>
											<select name="prog" id="prog">
												<option value="">Select programme</option>
												<?php
													$sql_selyprog = "SELECT p_name, p_code FROM programmes WHERE p_st_nst = 'y'";
													$run_selyprog = mysqli_query($connect, $sql_selyprog);
													while($row = mysqli_fetch_assoc($run_selyprog)){
														echo '<option value="'.$row['p_code'].'">'.strtoupper($row['p_name']).'</option>';
													}
												mysqli_close($connect);
												?>
											</select>
										</div>
										<div class="clearfix"></div>
									</div>
								<div id="candidates">
									
								</div>
<!--								<a href="print/ycat.php" class="btn btn-secondary c-white input" target="_blank">Print</a>-->
								<input type="submit" class="btn btn-secondary c-white input" value="Print" name="print">
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
				 $( "#accordion" ).accordion();
				$('#prog').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
				$('#zone').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
			});
			
		// get candidates ajax
			 $('#prog').on('selectmenuchange change', function(){
				 	 var zone = $('#zone option:selected').val();
					 var prog = $(this).val();
					$('#zone').on('selectmenuchange change', function(){
						zone = $(this).val();
					});
				 
					 $('#candidates').empty();
					 $.ajax({
						type : "GET",
						data : {programme : prog, zone : zone},
						url : 'ajax/candycat.php',
						beforeSend : function(){
							$('.cregWrapper').append('<div class="alert alert-warning m-auto" id="loading">loading</div>');
						},
					    complete : function(){
							$('#loading').remove();
						},
						success : function(data){
							$('#candidates').append(data);
						}
					 });
					});
		</script>
	</body>
</html>