<?php
	require "db.php";
	
	$data = $_POST;
	
	$data=$_POST;
	if( isset($data['do_signup']) )
	{
	  // registration here	
	  
	  if ( trim($data['login']) == '' ) 
	  {
		$errors[] = 'Enter the login';
	  }
	  
	  if ( trim($data['email']) == '' ) 
	  {
		$errors[] = 'Enter the email';
	  }
	  
	  if ( $data['password'] == '' ) 
	  {
		$errors[] = 'Enter the password';
	  }
	  
	  if ( trim($data['password_2']) != $data['password'] ) 
	  {
		$errors[] = 'Repeated password entered incorrectly';
	  }
	  
	    if ( R::count('users', "login = ?", array($data['login'])) > 0 ) 
	  {
		$errors[] = 'User with that login already exists';
	  }
	  
	    if ( R::count('users', "email = ?", array($data['email'])) > 0 ) 
	  {
		$errors[] = 'User with that email already exists';
	  }
	  
	  if( empty($errors) )
	  {
		 //all ok
		 $user = R::dispense('users');
		 $user->login = $data['login'];
		 $user->email = $data['email'];
		 $user->password = password_hash($data['password'], PASSWORD_DEFAULT); // bcrypt password hash
		 R::store($user);
		 
		 echo '<div style="color: green;">Successfully registered</div><hr>';
		 
	  } else
	  {
		  echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	  }
	}
?>

<form action="/FinalAssignmentRepository/signup.php" method="POST">
	
	<p>
	<p><strong>Login</strong>:</p>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>">
	</p>
	
	
	<p>
	<p><strong>Email</strong>:</p>
	<input type="email" name="email" value="<?php echo @$data['email']; ?>">
	</p>
	
	<p>
	<p><strong>Password</strong>:</p>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>">
	</p>
	
	<p>
	<p><strong>Repeat password</strong>:</p>
	<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
	</p>
	
	<p>
	<button type="sumbit" name="do_signup">Registration</button>
	</p>
	
</form>