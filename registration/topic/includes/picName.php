<div class="userPhoto">
	<div class="img-round">
		<?php
			if(!empty($ugphoto)){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
					echo '<div style="background-image: url(../'.$ugphoto.');" class = "imageug imgadmin"></div>';
				}else{
					echo '<div style="background-image: url(../'.$ugphoto.');" class = "imageug"></div>';
				}
			}else{
				echo '<div style="background-image: url(../ugphoto/insti-icon.png);" class = "imageug"></div>';	
			}
		?>
		
	</div>
</div>
<div class="userName">
	<section class="name"><span><?php 
		if($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'natadmin'){
			echo strtolower($_SESSION['user']); 
		}else{
			echo strtoupper($_SESSION['ugname']);
		}


		?></span></section>
</div>