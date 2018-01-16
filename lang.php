<?php
$lang = $_GET['lang'];
$langArray = array('en','lv','ru');
$found = false;

if (in_array($lang, $langArray))
	$found = true;

if (!$found)
	$lang = 'en';

$xml = simplexml_load_file('languages.xml') or die("xml not found!");
$title = $xml->title->$lang;
$text = $xml->text->$lang;
?>

<H1><?php echo $title;?></H1>
<DIV><?php echo $text;?></DIV>
<DIV style="margin-top:50px;">
	Lanquages:
	<a href="?lang=en">En</a>
	<a href="?lang=lv">Lv</a>
	<a href="?lang=ru">Ru</a>
</DIV>