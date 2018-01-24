<?php

$header = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <h1 id="logo"><a href='./index.php'>Shonline</a></h1>
    <!-- Cart -->
    <div id="cart"><a href="./index.php?view_cart=1" class="cart-link">Your Shopping Cart</a> <!-- Open cart -->
      <div class="cl">&nbsp;</div>
      <span>Articles: <strong>4</strong></span> &nbsp;&nbsp; <span>Cost: <strong>$250.99</strong></span>
	</div>
    <!-- End Cart -->
    <!-- Navigation -->
    <div id="navigation">
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./index.php?myaccount=1">My Account</a></li>
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
    <div id="content">
HTML;

$footer = <<<HTML
</div>
    <!-- End Content -->
    <!-- Sidebar -->
    <div id="sidebar">
      <div class="box categories">
        <h2>Categories <span></span></h2>
        <div class="box-content">
          <ul>
            <li><a href="./index.php?category=all">All prices</a></li>
            <li><a href="./index.php?category=clothing">Clothing</a></li>
            <li><a href="./index.php?category=phones">Cell phones</a></li>
            <li class="last"><a href="./index.php?category=accessories">Accessories</a></li>
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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
        <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
      </div>
      <div class="col">
        <h3 class="ico ico2">Free calls to operators</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
        <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
      </div>
      <div class="col">
        <h3 class="ico ico3">Weekly gifts</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
        <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
      </div>
      <div class="col col-last">
        <h3 class="ico ico4">Shop online</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
        <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <!-- End Text Cols -->
	
	
  </div>
  <!-- End Side Full -->
  <!-- Footer -->
  <div id="footer">
    <p class="left"> <a href="#">Home</a> <span>|</span> <a href="#">Support</a> <span>|</span> <a href="#">My Account</a> <span>|</span> <a href="?lang=en">En</a> <span>|</span> <a href="?lang=ru">Ru</a> </p>
    <p class="right"> &copy; 2018 Shonline. Design by Ignat, Dmitry</p>
  </div>
  <!-- End Footer -->
</div>
<!-- End Shell -->
</body>
</html>

HTML;

?>
