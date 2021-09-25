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
		<title>Sibaq '19 | Candidate Registration > Check duplicate canidates</title>
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
								<h4>Check duplicate candidates</h4>
							</div>
							<div class="cregWrapper pt-3 pb-3">
									<div class="catlist">
										<div class="col-md-12">
											<label for="cat" class="control-form">Category list</label>
											<select name="cat" id="cat" class="select">
													<option value="" selected>Select category</option>
												<?php

													// select all cat
													$sql_ugsel = "SELECT * FROM category";
													$run_ugsel = mysqli_query($connect, $sql_ugsel);
													while($ugrow = mysqli_fetch_assoc($run_ugsel)){
														echo '<option value="'.$ugrow['cat_name'].'">'.ucfirst($ugrow['cat_name']).'</option>';
													}
												?>
												</select>
												<div id="text"></div>
										</div>
									</div>
									<div id="prolist" class="mt-3">
										<div class="col-md-6 float-left">
											<label for="proglist1" class="control-form">Programme 1</label>
											<div class="proglist">
												<select name="prog1" id="proglist1" class="programmes">
													<option value="" selected>Select a programme</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 float-left">
											<label for="proglist2" class="control-form">Programme 2</label>
											<div class="proglist">
												<select name="prog2" id="proglist2" class="programmes">
													<option value="" selected>Select a programme</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div id="tablelist" class="mt-4">
										<div id="message">
											
										</div>
										<div class="col-md-6 float-left">
											<table class="table table-bordered" id="t1">
												<thead>
													<tr>
														<th>Sl.No</th>
														<th>Candidate</th>
														<th class="duplifer-highlightdups">Chest No</th>
														<th>Ug</th>
													</tr>
												</thead>
												<tbody id="c1">
													
												</tbody>
											</table>
										</div>
										<div class="col-md-6 float-left">
											<table class="table table-bordered" id="t2">
												<thead>
													<tr>
														<th>Sl.No</th>
														<th>Candidate</th>
														<th class="duplifer-highlightdups">Chest No</th>
														<th>Ug</th>
													</tr>
												</thead>
												<tbody id="c2">
													
												</tbody>
											</table>
										</div>
										<div class="clearfix"></div>
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
				$('#cat').selectmenu({
					  change: function( event, ui ) {}
					}).selectmenu("menuWidget")
					.addClass( "overflow" );
//				$('#proglist1').selectmenu().selectmenu( "menuWidget" )
//					.addClass( "overflow" );
//				$('#proglist2').selectmenu().selectmenu( "menuWidget" )
//					.addClass( "overflow" );		
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
				
				// get tables of selected category
					$('#proglist1').on('selectmenuchange change', function(){
						var programmes = $(this).val();
						$('#c1').empty();
						$.ajax({
							url : 'ajax/getcand.php',
							type : "GET",
							data : {programme:programmes},
							beforeSend : function(){
								$('.cregWrapper').append('<div class="alert alert-warning m-auto" id="loading">loading</div>');
							},
							complete : function(){
								$('#loading').remove();
							},
							success : function(data){
								$('#c1').append(data);
							},
							fail : function(){
								$('tbody#c1').text('Failed to load');
							}
						});
					});
				// table two
				$('#proglist2').on('selectmenuchange change', function(){
						var programmes = $(this).val();
						$('#c2').empty();
						$.ajax({
							url : 'ajax/getcand.php',
							type : "GET",
							data : {programme:programmes},
							beforeSend : function(){
								$('.cregWrapper').append('<div class="alert alert-warning m-auto" id="loading">loading</div>');
							},
							complete : function(){
								$('#loading').remove();
							},
							success : function(data){
								$('#c2').append(data);
							},
							fail : function(){
								$('tbody#c2').text('Failed to load');
							}
						});
					});
				 });
		</script>
	</body>
</html>