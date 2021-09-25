<?php
	session_start();
	include '../../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'venue'){
                    
                }else{
                    header('Location: login.php?login=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
		}else{
			header('Location: login.php');
		}

// updating code letter
if(isset($_POST['addltr'])){
	$id = $_POST['id'];

	foreach($id as $ids=>$val){
		$cletter = $_POST["cletter"][$ids];
		$update_cltr = mysqli_query($connect, "UPDATE final_candidates SET code_letter = '$cletter' WHERE id = '$val'");
		if($update_cltr){
			header('Location: report.php?updated');
		}else{
			header('Location: report.php?failed');
		}
	}
}

// MSG ALERT
$msg = '';
if(isset($_GET['updated'])){
	$msg = '<div class="alert alert-success col-md-4 m-auto text-center small">Updated!</div>';
}elseif(isset($_GET['failed'])){
	$msg = '<div class="alert alert-danger col-md-4 m-auto text-center small">Failed, try again!</div>';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq'19 | Report Candidates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/css/fontawesome.min.css" media="all">
		<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css" media="all">
		<link rel="stylesheet" href="../../registration/candidate/css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<?php include 'theme/header.php'; 
				echo $msg;
			?>
			<div class="container-fluid">
				<div class="row">
					<?php include 'theme/side.php'; ?>
					<div class="col-lg-9" id="dashContent">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="wrapper1">
										<div class="head1">
											<h4>Report Candidates</h4>
										</div>
										<div class="reportContent">
											<label for="selectprg" class="control-form">Select programme</label>
											<div class="col-md-5">
												<form action="index.php" class="form-horizontal" method="post">
													<div class="form-group">
														<select name="selprg" id="selectprg" class="input">
															<option value="">Choose programe</option>
															<?php
																$sel_progopt = mysqli_query($connect, "SELECT DISTINCT p.p_name, p.p_code FROM programmes p LEFT JOIN final_schedule f ON p.p_code = f.p_code LEFT JOIN venues v ON f.venue = v.id WHERE v.user = '$_SESSION[user]'");
																$i = 1;
																while($row1 = mysqli_fetch_assoc($sel_progopt)){
																	echo '<option value="'.$row1['p_code'].'">'.$row1['p_name'].'</option>';
																}
															?>
														</select>
													</div>
												</form>
												
											</div>
											<div id="response"></div>
											<?php
												if(isset($_GET['pcode'])){
													
												}else{
													echo '<form action="report.php" role="form" method="get">';
												}
											?>
											<div class="table-content">
												<?php
												$output = '';
													if(isset($_GET['pcode'])){
														$programme = $_GET['pcode'];
														echo '<form action="report.php" method="post"><table class="table table-modern table-style1"><thead>';
														//select header datails
														$sel_pdetails = mysqli_query($connect, "SELECT p_name, p_code, p_category FROM programmes WHERE p_code = '".$programme."'");
														while($row2 = mysqli_fetch_assoc($sel_pdetails)){
														$output .= '<tr class="text-center"><th>'.$row2['p_code'].'</th>
														<th colspan="3">'.$row2['p_name'].'</th>
														<th colspan="2">'.ucwords($row2['p_category']).'</th></tr>';
														}
														echo '
															<tr>
																<th></th>
																<th>Code Letter</th>
																<th>Candidate</th>
																<th>Chest.No</th>
																<th>Institution</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead><tbody>';
														$sql_getcand = "SELECT c.*, p.p_name, p.p_code FROM final_candidates AS c INNER JOIN programmes AS p ON c.p_code = p.p_code WHERE p.p_code = '".$programme."'";
														$run_getcand = mysqli_query($connect, $sql_getcand);
														$i = 1;

														while($row = mysqli_fetch_assoc($run_getcand)){
															$id = $row['id'];
															echo '<tr>
																			<td><input type="hidden" name="id[]" value="'.$row['id'].'">'.$i.'</td>
																			<td><input type="text" name="cletter[]" class="form-control" value="'.$row['code_letter'].'"></td>
																			<td>'.$row['name'].'</td>
																			<td>'.$row['chest'].'</td>
																			<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
																			<td>'.ucwords($row['status']).'</td>
																			<td>'.($row['status'] == 'reported' ? '<a href="javascript:void(0)" onClick="reportCand('."'".$id."'".', '."'".'not reported'."'".')"><i class="fas fa-times"></i></a>' : '<a href="javascript:void(0)" onClick="reportCand('."'".$id."'".', '."'".'reported'."'".')"><i class="fas fa-user-check"></i></a>' ).'</td>
																		</tr>';

															$i++;
														}
														echo '</tbody></table>';

														echo '<input type="submit" name="addltr" value="Update" class="btn btn-info input"></form>';
													}
												?>
											</div>
											<?php
												if(isset($_GET['pcode'])){
													
												}else{
													echo '<input type="submit" name="codeltr" value="Code letter" class="btn btn-info input"></form>';
												}
											?>
											
											
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
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
		<script>
			$(function(){
				$('#selectprg').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
				$('#selectprg').on('selectmenuchange change load', function(){
						var programmes = $(this).val();
						$('.table-content').empty();
						$.ajax({
							url : 'ajax/getprog.php',
							type : "GET",
							data : {programme:programmes},
							beforeSend : function(){
								$('.table-content').append('<div class="alert alert-warning w-25 text-center m-auto" id="loading">loading</div>');
							},
							complete : function(){
								$('#loading').remove();
							},
							success : function(data){
								$('.table-content').append(data);
							},
							fail : function(){
								$('.table-content').text('Failed to load');
							}
						});
					});
				
				
				
			});
			
		</script>
		<script>
			function reportCand(id,status){
					$('#response').empty();
					$.ajax({
						url: 'ajax/reportcand.php',
						type: "GET",
						data: {id:id, status:status},
						beforeSend : function(){
							$('#response').append('<div class="alert alert-warning w-25 text-center m-auto" id="loading">Updating</div>');
						},
						complete: function(){
							$('#loading').remove();
						},
						success: function(data){
							$('#response').append(data);
						},
						fail : function(){
								$('#response').text('Failed to load');
							}
					});
				}
		</script>
	</body>
</html>