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

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Candidate Registration > Ug wise programmes</title>
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
						<div class="wrapper">
							<div class="head1">
								<h4>Ug Wise programme list</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="ugwise.php" class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label for="pcode" class="control-form">Ug list</label>
											<select name="ug" id="ug" class="select">
													<option value="">Select ug</option>
												<?php
													
													// select all ug
													$sql_ugsel = "SELECT * FROM users WHERE role IN('ug', 'ugnat')";
													$run_ugsel = mysqli_query($connect, $sql_ugsel);
													while($ugrow = mysqli_fetch_assoc($run_ugsel)){
														echo '<option value="'.$ugrow['user_id'].'">'.$ugrow['ug_name'].'</option>';
													}
												?>
												</select>
										</div>
										<div class="form-group">
											<div class="input-group justify-content-end pr-3">
												<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
												
											</div>
										</div>
								</form>
								<table class="table table-bordered">
									<thead class="thead-dark">
										<tr><th colspan="6" class="text-center">
											<?php
												if(isset($_POST['find'])){
													$get_ugname_sql = "SELECT * FROM users WHERE user_id = '$_POST[ug]'";
													$run_ugname = mysqli_query($connect, $get_ugname_sql);
													while($unamerow = mysqli_fetch_assoc($run_ugname)){
														echo $unamerow['ug_name'];
													}
												}else{
													echo '';
												}
												
											?>
											</th></tr>
												<tr>
													<th>Sl.no</th>
													<th>Programme</th>
													<th>Programme code</th>
													<th>Cand.Category</th>
													<th>Candidate</th>
													<th>Chest No</th>
												</tr>
											</thead>
											<tbody>
												
										<?php
											if(isset($_POST['find'])){
												$sql_prog = "SELECT * FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE u.user_id = '$_POST[ug]'";
												$run_prog_sel = mysqli_query($connect, $sql_prog);
												$i = 1;
												while($p_row = mysqli_fetch_assoc($run_prog_sel)){
													echo '<tr>
													<td>'.$i.'</td>
													<td>'.$p_row['p_name'].'</td>
													<td>'.$p_row['p_code'].'</td>
													<td>'.$p_row['category'].'</td>
													<td>'.$p_row['candidate_name'].'</td>
													<td>'.$p_row['candidate_code'].'</td>
												</tr>';
													$i++;
												}
												
											}else{
												echo 'No option selected!';
											}
												mysqli_close($connect);
										?>
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
				$('#ug').selectmenu()
				  .selectmenu( "menuWidget" )
					.addClass( "overflow" );
						});
			
				// table customize
				var tables = $("table").tableExport();
				tables.tableExport.update({
				fileName: "Candidate_registration"         // pass in a new set of options
				});
		</script>
	</body>
</html>