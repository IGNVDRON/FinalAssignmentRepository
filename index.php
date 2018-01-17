<?php
session_start();
//error_reporting(0);

// Languages start
$lang = $_GET['lang'];
$langArray = array('en','ru');
$found = false;

if (in_array($lang, $langArray))
	$found = true;

if (!$found)
	$lang = 'en';

$xml = simplexml_load_file('languages.xml') or die("xml not found!");

// Translations
$home = $xml->home->$lang;
$support = $xml->support->$lang;
$account = $xml->account->$lang;

$categories = $xml->categories->$lang;
$cat_all = $xml->cat_all->$lang;
$cat_clothing = $xml->cat_clothing->$lang;
$cat_phones = $xml->cat_phones->$lang;
$cat_accessories = $xml->cat_accessories->$lang;

$authors = $xml->authors->$lang;

$tab_name = $xml->tab_name->$lang;
$tab_price = $xml->tab_price->$lang;
$tab_category = $xml->tab_category->$lang;
$tab_quantity = $xml->tab_quantity->$lang;
$tab_cost = $xml->tab_cost->$lang;
// End of translations
// End of languages

require("products.php");
//require("layout.php");



// Registration and login
require ("db.php");
$data = $_POST;
// End of registration and login




// Initialize cart
if(!isset($_SESSION['shopping_cart'])) {
	$_SESSION['shopping_cart'] = array();
}
// Empty cart
if(isset($_GET['empty_cart'])) {
	$_SESSION['shopping_cart'] = array();
}


// **PROCESS FORM DATA**

$message = '';

// Add product to cart
if(isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];
	
	// Check for valid item
	if(!isset($products[$product_id])) {
		$message = "Invalid item!<br />";
	}
	// If item is already in cart, tell user
	else if(isset($_SESSION['shopping_cart'][$product_id])) {
		$message = "Item already in cart!<br />";
	}
	// Otherwise, add to cart
	else {
		$_SESSION['shopping_cart'][$product_id]['product_id'] = $_POST['product_id'];
		$_SESSION['shopping_cart'][$product_id]['quantity'] = $_POST['quantity'];
		$message = "Added to cart!";
	}
}
// Update Cart
if(isset($_POST['update_cart'])) {
	$quantities = $_POST['quantity'];
	foreach($quantities as $id => $quantity) {
		if(!isset($products[$id])) {
			$message = "Invalid product!";
			break;
		}
		$_SESSION['shopping_cart'][$id]['quantity'] = $quantity;
	}
	if(!$message) {
		$message = "Cart updated!<br />";
	}
}


// **DISPLAY PAGE**
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shonline</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="js/jquery-func.js" type="text/javascript"></script>
</head>
<body>
<!-- Shell -->
<div class="shell">
  <!-- Header -->
  <div id="header">
    <h1 id="logo"><a href="./index.php">Shonline</a></h1>
    <!-- Cart -->
    <div id="cart"><a href="./index.php?view_cart=1" class="cart-link">Your Shopping Cart</a> <!-- Open cart -->
	</strong></span>
	</div>
    <!-- End Cart -->
    <!-- Navigation -->
    <div id="navigation">
      <ul>
        <li><a href="index.php">'. $home .'</a></li>
        <li><a href="./index.php?myaccount=1">'. $account .'</a></li>
        <li><a href="?lang=en">En</a></li>
        <li><a href="?lang=ru">Ru</a></li>
      </ul>
    </div>
    <!-- End Navigation -->
  </div>
  <!-- End Header -->
  <!-- Main -->
  <div id="main">
    <div class="cl">&nbsp;</div>
    <!-- Content -->
    <div id="content">';

echo $message;

// View a product
if(isset($_GET['view_product'])) {
	$product_id = $_GET['view_product'];
	
	if(isset($products[$product_id])) {
		// Display site links
		echo "<p>
			<a href='./index.php'>Shonline</a> &gt; <a href='./index.php?category=". $products[$product_id]['category'] ."'>" . 
			$products[$product_id]['category'] . "</a></p>";
		
		// Display product
		echo "<p>
			<span style='font-weight:bold;'>" . $products[$product_id]['name'] . "</span><br />
			<span>$" . $products[$product_id]['price'] . "</span><br />
			<span>" . $products[$product_id]['description'] . "</span><br />
			<p>
				<form action='./index.php?view_product=$product_id' method='post'>
					<select name='quantity'>
						<option value='1'>1</option>
						<option value='2'>2</option>
						<option value='3'>3</option>
					</select>
					<input type='hidden' name='product_id' value='$product_id' />
					<input type='submit' name='add_to_cart' value='Add to cart' />
				</form>
			</p>
		</p>";
	}
	else {
		echo "Invalid product!";
	}
}






// View cart
else if(isset($_GET['view_cart'])) {
	// Display site links
	echo "<p>
		<a href='./index.php'>Shonline</a></p>";
	
	echo "<h3>Your Cart</h3>
	<p>
		<a href='./index.php?empty_cart=1'>Empty Cart</a>
	</p>";
	
	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?view_cart=1' method='post'>
		<table style='width:90%;' cellspacing='0'>
				<tr>
					<th style='border-bottom:1px solid #000000;'>". $tab_name ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_price ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_category ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_quantity ."</th>
				</tr>";
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $product['product_id'];
					
					echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=$id'>" . 
							$products[$product_id]['name'] . "</a></td>
						<td style='border-bottom:1px solid #000000;'>$" . $products[$product_id]['price'] . "</td> 
						<td style='border-bottom:1px solid #000000;'>" . $products[$product_id]['category'] . "</td>
						<td style='border-bottom:1px solid #000000;'>
							<input type='text' name='quantity[$product_id]' value='" . $product['quantity'] . "' /></td>
					</tr>";
				}
			echo "</table>
			<input type='submit' name='update_cart' value='Update' />
			</form>
			<p>
				<a href='./index.php?checkout=1'>Checkout</a>
			</p>";
		
	}
}







// Checkount
else if(isset($_GET['checkout'])) {
	// Display site links
	echo "<h3>Checkout</h3>";
	
	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?checkout=1' method='post'>
		<table style='width:90%;' cellspacing='0'>
				<tr>
					<th style='border-bottom:1px solid #000000;'>". $tab_name ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_price ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_quantity ."</th>
					<th style='border-bottom:1px solid #000000;'>". $tab_cost ."</th>
				</tr>";

				$total_price = 0;
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $product['product_id'];
					
					
					$total_price += $products[$product_id]['price'] * $product['quantity'];
					echo "<tr>
						<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=$id'>" . 
							$products[$product_id]['name'] . "</a></td>
						<td style='border-bottom:1px solid #000000;'>$" . $products[$product_id]['price'] . "</td> 
						<td style='border-bottom:1px solid #000000;'>" . $product['quantity'] . "</td>
						<td style='border-bottom:1px solid #000000;'>$" . ($products[$product_id]['price'] * $product['quantity']) . "</td>
					</tr>";
				}
			echo "</table>
			<p>Total price: $" . $total_price . "</p>";
		
	}
}



else if(isset($_GET['myaccount'])) {

// Login
if( isset($data['do_login']) ){ 
		$erros = array();
		$user = R::findOne('users', 'login = ?', array($data['login']
		));
		if( $user ) {			// login exists
			if( password_verify($data['password'], $user->password) ) {
				//all ok, sign in user
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Congratulations! You are authorized!</div><hr>';
				
		} else {
			$errors[] = 'Invalid password';
		}
		} else {
			 $errors[] = 'User with that login not found'; 
		}
	if( !empty($errors) ){
		 echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
}
// End of login

// Registration
if( isset($data['do_signup']) ){
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
// End of registration

// Show login and registration fields
	echo '
<div class="cols">
<div class="col">
<form action= "index.php?myaccount=1" method="POST">
	<p>
	<p><strong>Login</strong>:</p>
	<input type="text" name="login" value=>
	</p>
	<p>
	<p><strong>Password</strong>:</p>
	<input type="password" name="password" value=>
	</p>
	<p>
		<button type="sumbit" name="do_login">Sign in</button>
	</p>
</form>
</div>
<div class="col">
<form action="index.php?myaccount=1" method="POST">
	<p><p><strong>Login</strong>:</p>
	<input type="text" name="login" value="">
	</p><p>
	<p><strong>Email</strong>:</p>
	<input type="email" name="email" value="">
	</p><p>
	<p><strong>Password</strong>:</p>
	<input type="password" name="password" value="">
	</p><p>
	<p><strong>Repeat password</strong>:</p>
	<input type="password" name="password_2" value="">
	</p><p>
	<button type="sumbit" name="do_signup">Registration</button>
	</p>
</form>
</div>
</div>
';
// End of login and registration fields
}







// View all products
else {
	// Display site links
	echo "<table style='width:90%;' cellspacing='0'>";
	echo "<tr>
		<th style='border-bottom:1px solid #000000;'>". $tab_name ."</th>
		<th style='border-bottom:1px solid #000000;'>". $tab_price ."</th>
		<th style='border-bottom:1px solid #000000;'>". $tab_category ."</th>
	</tr>";


	// Loop to display all products
	foreach($products as $id => $product) {
		echo "<tr>
			<td style='border-bottom:1px solid #000000;'><a href='./index.php?view_product=$id'>" . $product['name'] . "</a></td>
			<td style='border-bottom:1px solid #000000;'>$" . $product['price'] . "</td> 
			<td style='border-bottom:1px solid #000000;'>" . $product['category'] . "</td>
		</tr>";
	}
	echo "</table>";
}











//echo $footer;
echo '</div>
    <!-- End Content -->
    <!-- Sidebar -->
    <div id="sidebar">
      <div class="box categories">
        <h2>'. $categories .'<span></span></h2>
        <div class="box-content">
          <ul>
            <li><a href="./index.php?category=All">'. $cat_all .'</a></li>
            <li><a href="./index.php?category=Clothing">'. $cat_clothing .'</a></li>
            <li><a href="./index.php?category=Phones">'. $cat_phones .'</a></li>
            <li class="last"><a href="./index.php?category=Accessories">'. $cat_accessories .'</a></li>
          </ul>
        </div>
      </div>
      <!-- End Categories -->
    </div>
    <!-- End Sidebar -->
    <div class="cl">&nbsp;</div>
  </div>
  <!-- End Main -->
  <!-- Side Full -->
  <div class="side-full">
    <!-- End More Products -->
	
    <!-- Text Cols -->
    <div class="cols">
      <div class="cl">&nbsp;</div>
      <div class="col">
        <h3 class="ico ico1">Worldwide delivery</h3>
      </div>
      <div class="col">
        <h3 class="ico ico2">Free calls to operators</h3>
      </div>
      <div class="col">
        <h3 class="ico ico3">Weekly gifts</h3>
      </div>
      <div class="col col-last">
        <h3 class="ico ico4">Shop online</h3>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <!-- End Text Cols -->
	
	
  </div>
  <!-- End Side Full -->
  <!-- Footer -->
  <div id="footer">
    <p class="left"> <a href="index.php">'. $home .'</a> <span>|</span> <a href="?myaccount=1">'. $account .'</a> <span>|</span> <a href="?lang=en">En</a> <span>|</span> <a href="?lang=ru">Ru</a> </p>
    <p class="right"> &copy; 2018 Shonline. '. $authors .'</p>
  </div>
  <!-- End Footer -->
</div>
<!-- End Shell -->
</body>
</html>';

?>