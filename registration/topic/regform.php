<?php
	session_start();
	include '../../db.php';
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if(isset($_POST['register'])){
					if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
						// get p_name matching item
						$run_getpname = mysqli_query($connect, "SELECT p_name FROM programmes WHERE p_code = '$_POST[item]'");
						while($prow = mysqli_fetch_assoc($run_getpname)){
							$p_name = $prow['p_name'];
						}
						date_default_timezone_set('Asia/Kolkata');
						$category = $_SESSION['category'];
						$item = $_POST['item'];
						$candidate = $_SESSION['cand_name'];
						$chest = $_SESSION['chestno'];
						$title = strip_tags($_POST['title']);
						$link = $_POST['link'];
						$date = date('Y-m-d h:i:s');
						$author = $_SESSION['user'];

						$ins_sql = "INSERT INTO final_topics (author, category, programme, p_code, candidate, chest, title, link, status, date) VALUES('$author', '$category','$p_name', '$item', '$candidate','$chest', '$title', '$link', 'pending' , '$date')";

						if($run_sql = mysqli_query($connect, $ins_sql)){
							header('Location: entryStatus.php?entry=added');
						}else{
							header('Location: newEntry.php?regstat=failedlink');
						}

					}else if($_SESSION['role'] == 'ugnat' || $_SESSION['role'] == 'natadmin'){
						date_default_timezone_set('Asia/Kolkata');
						$category = $_SESSION['category'];
						$item = $_POST['item'];
						$candidate = $_SESSION['cand_name'];
						$title = strip_tags($_POST['title']);
						$link = $_POST['link'];
						$date = date('Y-m-d h:i:s');
						$author = $_SESSION['user'];

						$ins_sql = "INSERT INTO final_topics (author, category, programme, p_code, candidate, chest, title, link, status, date) VALUES('$author', '$category', '$item', '$candidate', '$title', '$link', 'pending' , '$date')";

						if($run_sql = mysqli_query($connect, $ins_sql)){
							header('Location: entryStatus.php?entry=added');
						}else{
							header('Location: newEntry.php?regstat=failedfile');
						}
					}

				}
			
			}else{
				header('Location: login.php');
			}
		}else{
			header('Location: login.php?login=false');
		}
	}else{
		header('Location: login.php?login=false');
	}

	mysqli_close($connect);
?>