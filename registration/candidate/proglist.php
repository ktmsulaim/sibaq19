<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
//				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
//                    
//                }else{
//                    header('Location: ../profile.php?tempblocked');
//                }
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

$msg = '';
if(isset($_GET['success'])){
	$msg = '<div class="small col-md-4 m-auto alert alert-success text-center">Deleted successfully!</div>';
}elseif(isset($_GET['failed'])){
	$msg = '<div class="small col-md-4 m-auto alert alert-danger text-center">Deletion failed!</div>';
}

$c_catcode = '';
$c_category = '';
$c_name = '';

if(isset($_POST['find'])){
	$sql_selprog = "SELECT *, p.p_name, s.photo_path FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON c.candidate_code = s.std_chest WHERE c.candidate_code = '$_POST[chestno]'";
	$run_selprog = mysqli_query($connect, $sql_selprog);
	while($runc = mysqli_fetch_assoc($run_selprog)){
		$c_catcode = $runc['category_code'];
		$c_category =  $runc['category'];
		$c_name =  $runc['candidate_name'];
		$c_photo =  $runc['photo_path'];
	}
}

/// delete data from database 
if(isset($_GET['del_id'])){
	$id = $_GET['del_id'];
	$run_del = mysqli_query($connect, "DELETE FROM candidate_reg WHERE cand_id = '$id'");
	if($run_del){
		header('Location: proglist.php?success');
	}else{
		header('Location: proglist.php?failed');
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
		<link rel="icon" href="../../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					<div class="container-fluid bgdark">
						<?php include 'topbar.php'; ?>
					</div>
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
						<?php echo $msg; ?>
						<div class="wrapper">
							<div class="head3">
								<h3>Registered programmes</h3>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<div id="getprog">
										<form action="proglist.php" role="form" method="post" class="form-horizontal">
											<div class="form-group">
												<label for="chestno" class="control-form">Chest No</label>
												<div class="input-group mb-6">
													<div class="input-group-prepend">
														<span class="input-group-text" id="chestnolabel">Eg.5114</span>
													</div>
													<?php
														if(isset($_POST['find'])){
															echo '<input type="number" name="chestno" id="chestno" class="form-control" autocomplete="off" aria-label="Chest No" aria-describedby="chestnolabel" value="'.$_POST['chestno'].'" required>';
														}else{
															echo '<input type="number" name="chestno" id="chestno" class="form-control" autocomplete="off" aria-label="Chest No" aria-describedby="chestnolabel" value="" required>';
														}
														
													?>
													<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
												<?php
													if(isset($_POST['find'])){
														echo '
														<div class="imgrounded m-auto"><img class="img-fluid" src="'.$c_photo.'"></div>
														<table class="table table-bordered">
															<thead class="text-center">';
																	echo '
																	<tr>
																		<th>'.$c_catcode.'</th>
																		<th colspan="2">'.$c_name.'</th>
																		<th>'.$c_category.'</th>
																	</tr>';
																	if($_SESSION['role'] == 'admin' ||$_SESSION['role'] == 'natadmin'){
																		echo '<tr>
																		<th>Sl.No</th>
																		<th>Programme Name</th>
																		<th>Programme Code</th>
																		<th>Action</th>
																	</tr>';
																	}elseif($_SESSION['role'] == 'markentry'){
																		echo '<tr>
																		<th>Sl.No</th>
																		<th>Programme Name</th>
																		<th>Programme Code</th>
																		<th>Code letter</th>
																	</tr>';
																	}else{
																		echo '<tr>
																		<th>Sl.No</th>
																		<th>Programme Name</th>
																		<th>Programme Code</th>
																		<th></th>
																	</tr>';
																	}
															echo '</thead>
															<tbody>';
														if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
																$sql_selprog = "SELECT *, p_name FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code WHERE c.candidate_code = '$_POST[chestno]' ORDER BY c.code_letter DESC";
																$run_selprog = mysqli_query($connect, $sql_selprog);
																$i = 1;
																$c_catcode = $runc['category_code'];
																$c_category =  $runc['category'];
																$c_name =  $runc['candidate_name'];
															
															while($row = mysqli_fetch_assoc($run_selprog)){
																echo '<tr>
																<td>'.$i.'</td>
																<td>'.$row['p_name'].'</td>
																<td>'.$row['prog_code'].'</td>
																<td class="text-center"><a href="proglist.php?del_id='.$row['cand_id'].'" id="trash"><i class="fa fa-trash"></i></a></td>
																</tr>';
																$i++;
															}
														}elseif($_SESSION['role'] == 'markentry'){
															$sql_selprog = "SELECT *, p_name FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code WHERE c.candidate_code = '$_POST[chestno]' AND c.category = '$_SESSION[user]' ORDER BY c.code_letter DESC";
																$run_selprog = mysqli_query($connect, $sql_selprog);
																$i = 1;
																$c_catcode = $runc['category_code'];
																$c_category =  $runc['category'];
																$c_name =  $runc['candidate_name'];
															
															while($row = mysqli_fetch_assoc($run_selprog)){
																echo '<tr>
																<td>'.$i.'</td>
																<td>'.$row['p_name'].'</td>
																<td>'.$row['prog_code'].'</td>
																<td>'.$row['code_letter'].'</td>
																</tr>';
																$i++;
															}
														}else{
														$sql_selprog = "SELECT *, p_name FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code WHERE c.candidate_code = '$_POST[chestno]' ORDER BY c.code_letter ASC";
															$run_selprog = mysqli_query($connect, $sql_selprog);
															$i = 1;
														while($row = mysqli_fetch_assoc($run_selprog)){						
															if($_SESSION['user'] == $row['author']){
																echo '<tr>
																<td>'.$i.'</td>
																<td>'.$row['p_name'].'</td>
																<td>'.$row['prog_code'].'</td>
																<td>'.$row['code_letter'].'</td>
																</tr>';
																$i++;
															}else{
																$msg = '<div class="small col-md-4 m-auto alert alert-danger text-center">You have no permission to get this data!</div>';
																}
															}
														}
													echo'		
														</tbody>
													</table>';
															
													}else{}?>
									</div>
								</div>
							</div>
							<hr>
							<a href="proglist.php?showAll" class="btn btn-primary input" id="show">Show All</a>
							<div class="candidates">
								<table class="table">
									<thead>
									<?php
										if(isset($_GET['showAll'])){
											if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'markentry'){
												echo '<tr>
												<th>Sl.No</th>
												<th>Name</th>
												<th>Category</th>
												<th width=100>Chest No</th>
												<th>Programmes</th>
												<th>Ug</th>
												</tr>';
											}else{
												echo '<tr>
												<th>Sl.No</th>
												<th>Name</th>
												<th>Category</th>
												<th width=100>Chest No</th>
												<th>Programmes</th>
											</tr>';
											}
										}
									?>
									</thead>
									<tbody>
											<?php
											if(isset($_GET['showAll'])){
												if($_SESSION['role'] == 'admin'){
													$sel_prog_sql = "SELECT candidate_reg.candidate_code, candidate_reg.candidate_name, candidate_reg.category, candidate_reg.author, GROUP_CONCAT(programmes.p_name) as p_names FROM candidate_reg INNER JOIN programmes ON candidate_reg.prog_code=programmes.p_code INNER JOIN users ON users.username = candidate_reg.author WHERE users.role = 'ug' GROUP BY candidate_reg.candidate_code ORDER BY candidate_reg.cand_id";
													$run_sel_prog = mysqli_query($connect, $sel_prog_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($run_sel_prog)){

															echo '<tr><td>'.$i.'</td>
															<td>'.strtoupper($row['candidate_name']).'</td>
															<td>'.$row['category'].'</td>
															<td>'.$row['candidate_code'].'</td>
															<td>'.$row['p_names'].'</td>
															<td>'.strtoupper(preg_replace('/@.*/', '',$row['author'] )).'</td>
															</tr>
															';

														$i++;
													}
												} elseif($_SESSION['role'] == 'natadmin'){
													$sel_prog_sql = "SELECT candidate_reg.candidate_code, candidate_reg.candidate_name, candidate_reg.category, candidate_reg.author, GROUP_CONCAT(programmes.p_name) as p_names FROM candidate_reg INNER JOIN programmes ON candidate_reg.prog_code=programmes.p_code INNER JOIN users ON users.username = candidate_reg.author WHERE users.role = 'ugnat' GROUP BY candidate_reg.candidate_code ORDER BY candidate_reg.cand_id";
													$run_sel_prog = mysqli_query($connect, $sel_prog_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($run_sel_prog)){

															echo '<tr><td>'.$i.'</td>
															<td>'.strtoupper($row['candidate_name']).'</td>
															<td>'.$row['category'].'</td>
															<td>'.$row['candidate_code'].'</td>
															<td>'.$row['p_names'].'</td>
															<td>'.strtoupper(preg_replace('/@.*/', '',$row['author'] )).'</td>
															</tr>
															';

														$i++;
													}
												}elseif($_SESSION['role'] == 'markentry'){
													$sel_prog_sql = "SELECT candidate_reg.candidate_code, candidate_reg.candidate_name, candidate_reg.category, candidate_reg.author, GROUP_CONCAT(programmes.p_name) as p_names FROM candidate_reg INNER JOIN programmes ON candidate_reg.prog_code=programmes.p_code INNER JOIN users ON users.username = candidate_reg.author INNER JOIN category ON category.cat_name = candidate_reg.category WHERE users.role = 'ug' AND category.cat_name = '$_SESSION[user]' GROUP BY candidate_reg.candidate_code ORDER BY candidate_reg.cand_id";
													$run_sel_prog = mysqli_query($connect, $sel_prog_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($run_sel_prog)){

															echo '<tr><td>'.$i.'</td>
															<td>'.strtoupper($row['candidate_name']).'</td>
															<td>'.$row['category'].'</td>
															<td>'.$row['candidate_code'].'</td>
															<td>'.$row['p_names'].'</td>
															<td>'.strtoupper(preg_replace('/@.*/', '',$row['author'] )).'</td>
															</tr>
															';

														$i++;
													}
												}else{
													$sel_prog_sql = "SELECT candidate_reg.candidate_code, candidate_reg.candidate_name, candidate_reg.category, candidate_reg.author, GROUP_CONCAT(programmes.p_name) as p_names FROM candidate_reg INNER JOIN programmes ON candidate_reg.prog_code=programmes.p_code WHERE candidate_reg.author = '$_SESSION[user]' GROUP BY candidate_reg.candidate_code ORDER BY candidate_reg.cand_id";
													$run_sel_prog = mysqli_query($connect, $sel_prog_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($run_sel_prog)){

															echo '<tr><td>'.$i.'</td>
															<td>'.strtoupper($row['candidate_name']).'</td>
															<td>'.$row['category'].'</td>
															<td>'.$row['candidate_code'].'</td>
															<td>'.$row['p_names'].'</td>
															</tr>
															';

														$i++;
													}
												}
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
		<script src="../js/jquery.tablesorter.min.js"></script>
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
			// toggle button to display all wise programmes
			$('#show').click(function(){
				$('.candidates').toggle();
			});
		</script>
	</body>
</html>