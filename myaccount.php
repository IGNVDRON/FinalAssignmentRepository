<?php
	require "db.php";
	?>
	
	<?php  if( isset($_SESSION['logged_user']) ) :  ?>
	
	Signed in.
	Hello, <?php echo $_SESSION['logged_user']->login; ?>
	<hr>
	<a href="shop/logout.php">Sign out</a>
	<?php else : ?>
	<a href="../FinalAssignmentRepository/login.php">Authorization</a><br>
	<a href="/FinalAssignmentRepository/signup.php">Registration</a>
	<?php endif; ?>