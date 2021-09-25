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
		}
	}else{
		header('Location: login.php');
	}

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

$ug = '';
			if(isset($_POST['get'])){
				if(!empty($_POST['ug'])){
					$sql_ugname = "SELECT ug_name FROM users WHERE user_id = '$_POST[ug]'";
					$run_ugname = mysqli_query($connect, $sql_ugname);
					$ugrow = mysqli_fetch_assoc($run_ugname);
					$_SESSION['ug'] = $_POST['ug'];
					$_SESSION['nameug'] = $ugrow['ug_name'];
				}else{
					$_SESSION['ug'] = '';
					$_SESSION['nameug'] = 'ALL';
				}
			}else{
				$_SESSION['ug'] = '';
				$_SESSION['nameug'] = '';
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
								<form action="primary.php" class="form-horizontal" role="form" method="post">
									<div class="col-md-12">
										<div class="form-group">
										<label for="pcode" class="control-form">Ug list</label>
											<select name="ug" id="ug" class="select">
													<option value="">Select ug</option>
												<?php
													
													// select all ug
													$sql_ugsel = "SELECT * FROM users WHERE role = 'ug'";
													$run_ugsel = mysqli_query($connect, $sql_ugsel);
													while($ugrow = mysqli_fetch_assoc($run_ugsel)){
														echo '<option value="'.$ugrow['user_id'].'">'.$ugrow['ug_name'].'</option>';
													}
												?>
												</select>
											</div>
										</div>
<!--
											<div class="form-group">
												<div class="input-group justify-content-end pr-3">
													<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
												</div>
											</div>
-->
										<div class="form-group">
												<div class="col-md-4 float-left">
													<label for="category">Category</label>
												<select name="category" id="category" class="w-25 input1">
													<option value="">Select a category</option>
													<?php
														$sql_catsel = "SELECT * FROM category";
														$run_catsel = mysqli_query($connect, $sql_catsel);
														while($row = mysqli_fetch_assoc($run_catsel)){
															echo '<option value="'.$row['cat_name'].'">'.$row['cat_name'].'</option>';
														}
													?>
												</select>
												</div>
												<div class="col-md-4 float-left">
													<label for="key" id="key">Key</label>
													<input type="text" class="input1 d-block" name="key" required>
												</div>
												<div class="col-md-4 float-left">
													<label for="">'</label>
													<input type="submit" name="get" class="input1 btn btn-secondary d-block" value="Find" style="background:gray;">
												</div>
												<div class="clearfix"></div>
											</div>
									</form>
<!--
									<form action="primary.php" class="form-horizontal" method="post" role="form">
										
										
									</form>
-->
									<?php
										if(isset($_POST['get'])){
											$key = $_POST['key'];
											if(!empty($_POST['ug']) && empty($_POST['category'])){
													
													echo '<table class="table table-hover">
													<thead>
														<tr>
														<th colspan = "2" class="text-center">'.$ugrow['ugname'].'</th>
														</tr>
														<tr>
															<th>Category</th>
															<th>Count</th>
														</tr>
													</thead><tbody>';
													$sql_prog_list = "SELECT DISTINCT candidate_reg.candidate_code, candidate_reg.prog_code, p.p_st_nst FROM candidate_reg INNER JOIN programmes AS p ON p.p_code = candidate_reg.prog_code INNER JOIN users AS u ON candidate_reg.author = u.username WHERE u.user_id = '$_POST[ug]' AND p.p_st_nst = '$key' GROUP BY candidate_reg.candidate_code";
													$run_prog_list = mysqli_query($connect, $sql_prog_list);
													$count = mysqli_num_rows($run_prog_list);
													$row = mysqli_fetch_assoc($run_prog_list);
														echo'<tr>
														<td>'.$row['p_st_nst'].'</td>
														<td>'.$count.'</td>
														</tr>';
													echo '</tbody></table>';
												
												
											}elseif(!empty($_POST['category']) && empty($_POST['ug'])){
													$category = $_POST['category'];
													echo '<table class="table table-hover">
													<thead>
														<tr>
														<th colspan = "2" class="text-center">'.$_SESSION['nameug'].'</th>
														</tr>
														<tr>
															<th>Category</th>
															<th>Code</th>
															<th>Count</th>
														</tr>
													</thead><tbody>';
													$sql_prog_list = "SELECT DISTINCT candidate_reg.candidate_code, candidate_reg.prog_code, p.p_st_nst FROM candidate_reg INNER JOIN programmes AS p ON p.p_code = candidate_reg.prog_code INNER JOIN users AS u ON candidate_reg.author = u.username WHERE p.p_st_nst = '$key' AND candidate_reg.category = '$category' GROUP BY candidate_reg.candidate_code";
													$run_prog_list = mysqli_query($connect, $sql_prog_list);
													$count = mysqli_num_rows($run_prog_list);
													$row = mysqli_fetch_assoc($run_prog_list);
														echo'<tr>
														<td>'.ucfirst($category).'</td>
														<td>'.$row['p_st_nst'].'</td>
														<td>'.$count.'</td>
														</tr>';
													echo '</tbody></table>';
												}elseif(empty($_POST['ug']) && empty($_POST['category'])){
												$key = $_POST['key'];
												$_SESSION['ug'] = '';
												$category = $_POST['category'];
											echo '<table class="table table-hover">
											<thead>
												<tr>
												<th colspan = "3" class="text-center">ALL</th>
												</tr>
												<tr>
													<th>Category</th>
													<th>Code</th>
													<th>Count</th>
												</tr>
											</thead><tbody>';
											$sql_prog_list = "SELECT DISTINCT c.candidate_code, c.prog_code, p.p_st_nst FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code WHERE p.p_st_nst = '$key' GROUP BY c.candidate_code";
											$run_prog_list = mysqli_query($connect, $sql_prog_list);
											$count = mysqli_num_rows($run_prog_list);
											$row = mysqli_fetch_assoc($run_prog_list);
												echo'<tr>
												<td>'.$category.'</td>
												<td>'.$row['p_st_nst'].'</td>
												<td>'.$count.'</td>
												</tr>';
											echo '</tbody></table>';
											}
											
											if(!empty($_POST['ug']) && !empty($_POST['category'])){
												$key = $_POST['key'];
												$_SESSION['ug'] = '';
												$category = $_POST['category'];
											echo '<table class="table table-hover">
											<thead>
												<tr>
												<th colspan = "3" class="text-center">ALL</th>
												</tr>
												<tr>
													<th>Category</th>
													<th>Code</th>
													<th>Count</th>
												</tr>
											</thead><tbody>';
											$sql_prog_list = "SELECT DISTINCT candidate_reg.candidate_code, candidate_reg.prog_code, p.p_st_nst FROM candidate_reg INNER JOIN programmes AS p ON p.p_code = candidate_reg.prog_code INNER JOIN users AS u ON candidate_reg.author = u.username WHERE u.user_id = '$_POST[ug]' AND p.p_st_nst = '$key' AND candidate_reg.category = '$_POST[category]' GROUP BY candidate_reg.candidate_code";
											$run_prog_list = mysqli_query($connect, $sql_prog_list);
											$count = mysqli_num_rows($run_prog_list);
											$row = mysqli_fetch_assoc($run_prog_list);
												echo'<tr>
												<td>'.$category.'</td>
												<td>'.$row['p_st_nst'].'</td>
												<td>'.$count.'</td>
												</tr>';
											echo '</tbody></table>';
											}
										}
										mysqli_close($connect);
									?>
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
						
				$('#category').selectmenu()
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