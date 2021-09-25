<?php
	if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
			echo'<li><a href="../profile.php"><i class="fa fa-home"></i> Home</a></li>
	<li><a href="index.php"><i class="fa fa-edit"></i> Candidate registration</a></li>
	<li><a href="regForm.php"><i class="fa fa-edit"></i> Programme registration</a></li>
	<li><a href="../topic/index.php"><i class="fa fa-edit"></i> Topic registration</a></li>
	<li><a href="candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
	<li><a href="proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
	<li id="result"><a><i class="fa fa-trophy"></i> Results</a>
	</li>
		<ul id="resultmenu" class="collapse">
				<li><a href="markentry.php"><i class="fa fa-pencil"></i> Mark entry</a></li>
				<li><a href="result.php"><i class="fa fa-pencil"></i> View entries</a></li>
				<li><a href="published.php"><i class="fa fa-pencil"></i> Published Programs</a></li>
				<li><a href="codeentry.php"><i class="fa fa-pencil"></i> Code entry</a></li>
			</ul>
			
	<li id="final"><a><i class="fa fa-trophy"></i> Final Results</a>
	</li>
		<ul id="final" class="collapse">
				<li><a href="finalmarkentry.php"><i class="fa fa-pencil"></i> Mark entry</a></li>
				<li><a href="finalresult.php"><i class="fa fa-pencil"></i> View entries</a></li>
			</ul>
			
	<li id="tools"><a><i class="fa fa-wrench"></i> Tools</a></li>
		<ul class="collapse" id="toolsmenu">
			<li><a href="statics.php"><i class="fa fa-print"></i> Print programmes</a></li>
			<li><a href="ugwise.php"><i class="fa fa-print"></i> Ug wise programmes</a></li>
			<li><a href="primary.php"><i class="fa fa-print"></i> Primary Round</a></li>
			<li><a href="ycat.php"><i class="fa fa-print"></i> Zone based</a></li>
			<li><a href="checkcand.php"><i class="fa fa-print"></i> Check duplicate</a></li>
		</ul>
	<li id="users"><a><i class="fa fa-user"></i> Users</a></li>
		<ul class="collapse" id="usersmenu">
			<li><a href="addUser.php"><i class="fa fa-user-plus"></i> Add User</a></li>
			<li><a href="usersMgmt.php"><i class="fa fa-user"></i> Manage Users</a></li>
		</ul>
	';
		}elseif($_SESSION['role'] == 'markentry'){
			echo'<li><a href="../profile.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
				<li><a href="proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
				<li id="result"><a><i class="fa fa-trophy"></i> Results</a>
				</li>
					<ul id="resultmenu" class="collapse">
							<li><a href="markentry.php"><i class="fa fa-pencil"></i> Mark entry</a></li>
							<li><a href="result.php"><i class="fa fa-pencil"></i> View entries</a></li>
							<li><a href="published.php"><i class="fa fa-pencil"></i> Published Programs</a></li>
							<li><a href="statics.php"><i class="fa fa-print"></i> Print programmes</a></li>
							<li><a href="codeentry.php"><i class="fa fa-pencil"></i> Code entry</a></li>
						</ul>
				';
		}else{
			echo'<li><a href="../profile.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="index.php"><i class="fa fa-edit"></i> Candidate registration</a></li>
				<li><a href="regForm.php"><i class="fa fa-edit"></i> Programme registration</a></li>
				<li><a href="../topic/index.php"><i class="fa fa-edit"></i> Topic registration</a></li>
				<li><a href="candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
				<li><a href="proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
				<li><a href="manage.php"><i class="fa fa-user-circle-o"></i> Manager mode</a></li>
				';
		}
?>