<?php
include("../res/x5engine.php");
$nameList = array("hj8","6dj","xj5","8tf","yx7","62a","uvz","za4","z8p","zhm");
$charList = array("5","G","D","Z","8","8","K","6","W","F");
$cpt = new X5Captcha($nameList, $charList);
//Check Captcha
if ($_GET["action"] == "check")
	echo $cpt->check($_GET["code"], $_GET["ans"]);
//Show Captcha chars
else if ($_GET["action"] == "show")
	echo $cpt->show($_GET['code']);
// End of file x5captcha.php
