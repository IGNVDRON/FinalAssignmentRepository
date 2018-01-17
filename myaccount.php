<?php
	require "db.php";
	?>
	
	<?php  if( isset($_SESSION['logged_user']) ) :  ?>
	
	Signed in.
	Hello, <?php echo $_SESSION['logged_user']->login; ?>
	<hr>
	<a href="logout.php">Sign out</a>
	<?php else : ?>
	<a href="login.php">Authorization</a><br>
	<a href="signup.php">Registration</a>
	<?php endif; ?>