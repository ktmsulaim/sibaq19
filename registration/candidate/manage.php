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
		<title>Sibaq '19 | Manager mode</title>
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
								<h4>Manager mode</h4>
							</div>
							
							<div class="cregWrapper pt-3 pb-3">
								<div id="category">
								
							
									<?php
									// get categories as per college
									$run_getcat = mysqli_query($connect, "SELECT DISTINCT p.p_category FROM final_candidates c LEFT JOIN final_group g ON c.p_code = g.p_code INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.author = '$_SESSION[user]' ORDER BY p.p_id");
									while($row = mysqli_fetch_assoc($run_getcat)){
										$category = array();
										$category[] = $row['p_category'];
										echo '<h3>'.strtoupper($row['p_category']).'</h3>
										<div>	
										<table class="table table-sm table-modern table-style1">
													<thead>
														<tr>
															<th>Name</th>
															<th>Chest</th>
															<th>Programme</th>
															<th>Date</th>
															<th>Venue</th>
															<th>From</th>
															<th>To</th>
															<th>P.status</th>
															<th>Report</th>
															<th>Result</th>
														</tr>
													</thead>
													<tbody>';
										foreach($category as $cindex => $cat){
											$sel_candtls = mysqli_query($connect, "SELECT DISTINCT c.*, p.p_name,sd.venue, sd.sd_from, sd.sd_to, sd.sd_date,sd.status AS pstatus FROM final_candidates c LEFT JOIN final_group g ON c.p_code = g.p_code LEFT JOIN final_schedule sd ON c.p_code = sd.p_code LEFT JOIN programmes p ON c.p_code = p.p_code WHERE c.author = '$_SESSION[user]' AND c.category = '$cat' AND p.p_st_nst NOT IN('y')");
											while($row1 = mysqli_fetch_assoc($sel_candtls)){
												echo '<tr>
															<td>'.$row1['name'].'</td>
															<td>'.$row1['chest'].'</td>
															<td>'.$row1['p_name'].'</td>
															<td>'.$row1['sd_date'].'</td>
															<td>'.$row1['venue'].'</td>
															<td>'.$row1['sd_from'].'</td>
															<td>'.$row1['sd_to'].'</td>
															<td>'.ucwords($row1['pstatus']).'</td>
															<td>'.ucwords($row1['status']).'</td>
															<td>'.$row1['position'].' '.$row1['grade'].'</td>
														</tr>';
											}
										}
										echo '</tbody>
												</table></div>';
									}
									mysqli_close($connect)
								?>
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
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
		<script src="../js/jquery-duplifer.js"></script>
		<script src="../js/ajax.js"></script>
		<script>
			$(function(){
				$('.table').tablesorter();
				$( "#category" ).accordion({ heightStyle: "content"});		
			});			
		</script>
		<script>
			$(function(){
				// get programme list
				 $('#cat').on('selectmenuchange change', function(){
					 var category = $(this).val();
					 $('.programmes').empty();
					 $.ajax({
						type : "GET",
						data : {category : category},
						url : 'ajax/getprog.php',
						beforeSend : function(){
							$('.cregWrapper').append('<div class="alert alert-warning m-auto" id="loading">loading</div>');
						},
					    complete : function(){
							$('#loading').remove();
						},
						success : function(data){
							$('.programmes').append(data);
						}
					 });
					});
				
				 });
		</script>
	</body>
</html>