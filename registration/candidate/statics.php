<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'markentry'){
                    
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

/*------------------------------------------------------------------------------------------------------------------------*/


// Delete entry from db
if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM final_candidates WHERE id = '$_GET[del_id]'";
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
								<h4>Programme list</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
								<form action="statics.php" class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label for="pcode" class="control-form">Programme code</label>
											<div class="input-group mb-6">
												<div class="input-group-prepend">
													<span class="input-group-text" id="pcodelabel">Eg.D12</span>
												</div>
												<?php
													if(isset($_POST['find'])){
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" value="'.$_POST['pcode'].'" required placeholder="Enter programme code to find candidate">';
													}else{
														echo '<input type="text" name="pcode" id="pcode" class="form-control" autocomplete="off" aria-label="Programme code" aria-describedby="pcodelabel" required placeholder="Enter programme code to find candidate">';
													}
												?>
												<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
											</div>
										</div>
								</form>
								<form action="print/finalprogrammes.php" method="get" role="form">
									<table class="table table-striped">
										<thead>
											<tr><th colspan="6" class="text-center">
												<?php
													if(isset($_POST['find'])){
														$get_progname_sql = "SELECT * FROM programmes WHERE p_code = '$_POST[pcode]'";
														$run_pname = mysqli_query($connect, $get_progname_sql);
														while($pnamerow = mysqli_fetch_assoc($run_pname)){
															echo $pnamerow['p_name'].' ('.ucfirst($pnamerow['p_category']).')';
														}
													}else{
														echo '';
													}

												?>
											</th></tr>
											<tr>
												<?php
													if(isset($_POST['pcode'])){
														// get kind
														$getkind_sql = "SELECT p_kind FROM programmes WHERE p_code = '$_POST[pcode]'";
														$run_getkind = mysqli_query($connect, $getkind_sql);
														$candrow = mysqli_fetch_assoc($run_getkind);
														$pkind = $candrow['p_kind'];
														
														if($pkind == 'individual'){
															echo '<th>Sl.no</th>
														<th>Od.no</th>
														<th>Candidate</th>
														<th>Chest No</th>
														<th>Institution</th>
														<th></th>';
														}else{
															echo '<th>Sl.no</th>
														<th>Od.no</th>
														<th>Candidates</th>
														<th>Chest.No</th>
														<th>Institution</th>';
														}
													}
												?>
											</tr>
										</thead>
										<tbody>
											<?php
												if(isset($_POST['find'])){
													$getcand_sql = "SELECT DISTINCT c.*,p.p_kind FROM final_candidates c INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$_POST[pcode]'";
													$run_getcand = mysqli_query($connect, $getcand_sql);
													$i = 1;
													$numrow = mysqli_num_rows($run_getcand);
													while($candrow = mysqli_fetch_assoc($run_getcand)){ 
														$pkind = $candrow['p_kind'];
														// if individual display normally
														if($pkind == 'individual'){
															echo '<tr>
															<td>'.$i.'</td>
															<td><input type="hidden" name="pcode" value=""></td>
															<td>'.$candrow['name'].'</td>
															<td>'.$candrow['chest'].'</td>
															<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['author'])).'</td>
															<td><a id="trash" href="statics.php?del_id='.$candrow['id'].'"><i class="fa fa-trash text-center"></i></a></td>
															</tr>';
															$i++;
														}else{ ?>
														<?php
														 	$getcand_sql = "SELECT DISTINCT GROUP_CONCAT(c.name)AS candidates, GROUP_CONCAT(c.chest)AS chest, c.author,u.place, c.p_code, g.ug FROM final_candidates AS c RIGHT JOIN final_group AS g ON c.author = g.ug INNER JOIN users AS u ON c.author = u.username WHERE c.p_code = g.p_code AND g.p_code = '$_POST[pcode]' GROUP BY g.ug";
															$run_getcand = mysqli_query($connect, $getcand_sql);
															$i = 1;
															while($candrow = mysqli_fetch_assoc($run_getcand)){ 
																	echo '<tr>
																	<td>'.$i.'</td>
																	<td></td>
																	<td>'.$candrow['candidates'].'</td>
																	<td>'.$candrow['chest'].'</td>
																	<td><input type="hidden" name="pcode" value="'.$candrow['p_code'].'"></td>
																	<td>'. strtoupper(preg_replace('/@.*/', '', $candrow['ug'])).'</td>
																	</tr>';
																	$i++; 
															?>
														
														 <?php }
															
														}
													}
													mysqli_close($connect);
												}
											?>
										</tbody>
									</table>
										<?php
											if(isset($_POST['find'])){
												if(!empty($_POST['find'])){
													echo '<a href="print/finalprogrammes.php?pcode='.$_POST['pcode'].'" id="find" class="btn btn-primary input" name="find" title="Find candidate"><i class="fa fa-print"></i> Print</a>';
													
													echo '<a href="print/yprogs.php?pcode='.$_POST['pcode'].'" class="btn btn-secondary input ml-2">Print 3 in 1</a>';
												}
											}
										?>
								</form>
							</div>
							
							<div class="allprogrammes">
								<div class="allprogInner">
									<div class="head1">
										<h4>All programmes</h4>
									</div>
										<div class="prgwrapper">
											<div class="ugwise">
												<a href="statics.php?showall" class="btn btn-info input c-white">Ug wise</a>
											</div>
											<div class="row">
												<?php
													if(isset($_GET['showall'])){
														$prg_sql = "SELECT p_name, p_code, p_category, p_category_c FROM programmes";
														$run_prg = mysqli_query($connect, $prg_sql);
														while($frow = mysqli_fetch_assoc($run_prg)){
															echo '<div class="col-md-12 mt-3 mb-3"><table class="table-bordered">';
															echo '<thead class="thead-dark"><tr><th colspan="4" class="text-center">'.$frow['p_name'].' -'.ucfirst($frow['p_category']).'</th></tr>
															<tr>
															<th>Sl.no</th>
															<th>Candidate</th>
															<th>Chest No</th>
															<th>Institution</th>
															</tr>
															</thead><tbody>';
															$programme = array();
															$programme[] = $frow['p_code'];
															foreach($programme as $programmes => $pcode){
																$select_candsql = "SELECT candidate_name, candidate_code, author, u.place FROM candidate_reg AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN users AS u ON c.author = u.username WHERE p.p_code = '$pcode' ORDER BY RAND()";
																$run_candsel = mysqli_query($connect, $select_candsql);
																$i = 1;
																while($srow = mysqli_fetch_assoc($run_candsel)){
																	echo '<tr>
																		<td>'.$i.'</td>
																		<td></td>
																		<td>'.$srow['candidate_name'].'</td>
																		<td>'.$srow['candidate_code'].'</td>
																		<td>'.strtoupper(preg_replace('/@.*/', '', $srow['author'])).', '.$srow['place'].'</td>
																	</tr>';
																	$i++;
																}
															}
															echo '</tbody></table></div>';
														}
															mysqli_close($connect);
													}
											
												?>
												<div class="clearfix"></div>
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
				$('#category').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
				$('#programme').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
			});
			$('.print').click(function(){
				window.print();
			});
		</script>
	</body>
</html>