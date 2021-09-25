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



if($_SESSION['role'] == 'admin'){
		$sql_selprg_p = "SELECT p_name, p_code from programmes WHERE status = 'publish'";
		$run_selprg_p = mysqli_query($connect, $sql_selprg_p);
		$count_p = mysqli_num_rows($run_selprg_p);
}else{
	//published programmes
	$sql_selprg_p = "SELECT p_name, p_code from programmes WHERE status = 'publish' AND p_category = '$_SESSION[user]'";
	$run_selprg_p = mysqli_query($connect, $sql_selprg_p);
	$count_p = mysqli_num_rows($run_selprg_p);
}

if($_SESSION['role'] == 'admin'){
	//prepared programmes
	$sql_selprg_u = "SELECT DISTINCT p.p_name, p.p_code FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE c.prepare = 'true' ORDER BY p.p_code ASC";
	$run_selprg_u = mysqli_query($connect, $sql_selprg_u);
	$count_u = mysqli_num_rows($run_selprg_u);
}else{
	//prepared programmes
	$sql_selprg_u = "SELECT DISTINCT p.p_name, p.p_code FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE p.p_category = '$_SESSION[user]' AND c.prepare = 'true' ORDER BY p.p_code ASC";
	$run_selprg_u = mysqli_query($connect, $sql_selprg_u);
	$count_u = mysqli_num_rows($run_selprg_u);
}

if($_SESSION['role'] == 'admin'){
	//unprepared programmes
	$sql_selprg_up = "SELECT DISTINCT p.p_name, p.p_code FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE c.prepare = 'false' ORDER BY p.p_code ASC";
	$run_selprg_up = mysqli_query($connect, $sql_selprg_up);
	$count_up = mysqli_num_rows($run_selprg_up);
}else{
	//unprepared programmes
	$sql_selprg_up = "SELECT DISTINCT p.p_name, p.p_code FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE p.p_category = '$_SESSION[user]' AND c.prepare = 'false' ORDER BY p.p_code ASC";
	$run_selprg_up = mysqli_query($connect, $sql_selprg_up);
	$count_up = mysqli_num_rows($run_selprg_up);
	
}

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Results > Programme Status</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
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
								<h4>Programme status</h4>
							</div>
							<div class="innerBox pt-3 pb-3">
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<h5 class="text-center subhead1">Published <span class="badge badge-secondary"><?php echo $count_p; ?></span></h5>
											<div class="h-350">
												<table class="table">
													<thead>
														<tr>
															<th></th>
															<th>Programme</th>
															<th>Code</th>
															<th>Print</th>
														</tr>
													</thead>
													<tbody>
															<?php
																while($row = mysqli_fetch_assoc($run_selprg_p)){
																	echo '<tr>
																	<td></td>
																	<td>'.$row['p_name'].'</td>
																	<td>'.$row['p_code'].'</td>
																	<td><a class="table-row" href="print/result.php?print=print&pcode='.$row['p_code'].'" target="_blank"><i class="fa fa-print"></i></a></td>
																	</tr>';
																}
															?>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<h5 class="text-center subhead1">Prepared <span class="badge badge-secondary"><?php echo $count_u; ?></span></h5>
											<div class="h-350">
												<table class="table">
													<thead>
														<tr>
															<th></th>
															<th>Programme</th>
															<th>Code</th>
															<th>Print</th>
														</tr>
													</thead>
													<tbody>
															<?php
																while($row = mysqli_fetch_assoc($run_selprg_u)){
																	echo '<tr>
																	<td></td>
																	<td>'.$row['p_name'].'</td>
																	<td>'.$row['p_code'].'</td>
																	<td><a class="table-row" href="print/result.php?print=print&pcode='.$row['p_code'].'" target="_blank"><i class="fa fa-print"></i></a></td>
																	</tr>';
																}
															?>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<h5 class="text-center subhead1">Unprepared <span class="badge badge-secondary"><?php echo $count_up; ?></span></h5>
											<div class="h-350">
												<table class="table">
													<thead>
														<tr>
															<th></th>
															<th>Programme</th>
															<th>Code</th>
														</tr>
													</thead>
													<tbody>
															<?php
																while($row = mysqli_fetch_assoc($run_selprg_up)){
																	echo '<tr>
																	<td></td>
																	<td>'.$row['p_name'].'</td>
																	<td>'.$row['p_code'].'</td>
																	</tr>';
																}
															?>

													</tbody>
												</table>
											</div>
										</div>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
		<script src="../js/FileSaver.js"></script>
		<script src="../js/tableexport.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>