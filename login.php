<?php
	require "db.php";
	
	$data = $_POST;
	
	if( isset($data['do_login']) )
	{
		$erros = array();
		$user = R::findOne('users', 'login = ?', array($data['login']
		));
		if( $user )
		{
			// login exists
			if( password_verify($data['password'], $user->password) ) {
				
				//all ok, sign in user
				
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Authorized. You may go on the <a href="/shop/myaccount.php">title webpage</a> </div><hr>';
				
		} else {
			
			$errors[] = 'Invalid password';
		}
		} else {
			
			 $errors[] = 'User with that login did not find';
			 
		}
	if( !empty($errors) )
	  {
		 echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
	
	}
	?>
	
	<form action= "login.php" method="POST">
	
	<p>
	<p><strong>Login</strong>:</p>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>">
	</p>
	
	<p>
	<p><strong>Password</strong>:</p>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>">
	</p>
	
	<p>
	<button type="sumbit" name="do_login">Sign in</button>
	</p>
	
	</form>