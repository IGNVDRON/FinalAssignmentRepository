<?php
	require "db.php";
	?>
	
	<?php  if( isset($_SESSION['logged_user']) ) :  ?>
	
	Signed in.
	Hello, <?php echo $_SESSION['logged_user']->login; ?>
	<hr>
	<a href="logout.php">Sign out</a>
	<?php else : ?>
<<<<<<< HEAD
	<a href="../FinalAssignmentRepository/login.php">Authorization</a><br>
	<a href="/FinalAssignmentRepository/signup.php">Registration</a>
=======
	<a href="login.php">Authorization</a><br>
	<a href="signup.php">Registration</a>
>>>>>>> 96281c8333b3a0d4af8ee78ad0a9641a9ff8a61a
	<?php endif; ?>