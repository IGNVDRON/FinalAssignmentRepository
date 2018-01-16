<?php
if (isset($_GET['lang']))
	$lang = $_GET['lang'];

$langArray = array('en','ru');
$found = false;

if (in_array($lang, $langArray))
	$found = true;

if (!$found)
	$lang = 'en';

$xml = simplexml_load_file('languages.xml') or die("xml not found!");
$title = $xml->title->$lang;
$text = $xml->text->$lang;
$home = $xml->home->$lang;
$support = $xml->support->$lang;
$account = $xml->account->$lang;
?>

<DIV><?php echo $title;?></DIV>
<DIV><?php echo $text;?></DIV>
<DIV><?php echo $home;?></DIV>
<DIV><?php echo $support;?></DIV>
<DIV><?php echo $account;?></DIV>
<DIV style="margin-top:50px;">
	Languages:
	<a href="?lang=en">En</a>
	<a href="?lang=ru">Ru</a>
</DIV>