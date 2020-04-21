<?php
session_start();
if (isset($_SESSION["name"])){
	$text = $_POST["text"];
	$fp = fopen("log.html", "a");
	fwrite($fp, "<p class='msgln'>On ".date("g:i A").", ".$_SESSION["name"]." wrote: ".stripslashes(htmlspecialchars($text))."</p>");
        fclose($fp);
}
?>
