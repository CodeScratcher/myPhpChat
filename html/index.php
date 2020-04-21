
<?php

session_start();
if (isset($_GET["logout"])){
	$fp = fopen("log.html", "a");
        fwrite($fp, "<p class='msgln'>User ". $_SESSION["name"] . " has left</p>");
        fclose($fp);
        session_destroy();
        header("Location: index.php");
}
function loginForm() {
echo '<div id="loginform"><form action="index.php" method="post"><p>Please enter your name.</p><label for="name">Name:</label><input id="name" name="name"><input type="submit" name="enter" id="enter" value="enter"></form></div> ';
}
if (isset($_POST['enter'])){
	if ($_POST['name'] != '') {
		$_SESSION['name'] = stripslashes(htmlspecialchars($_POST["name"]));
        }
	else {
		echo '<p class="error">Please try again</p>'; 
        }
}
?>
<!DOCTYPE html >
<html>
<head>
<link rel="icon" type="image/png" href="icon.png" sizes="16x16">
<title>Chat</title>
<meta charset="UTF-8">
  <meta name="description" content="A little chat app with an easy interface. Also open-source! Yay!">
  <meta name="keywords" content="php, chat, public,">
  <meta name="author" content="Ari">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="style.css">
</head>
 <?php if (!isset($_SESSION["name"])){
      header("Location: register.php");
}
else{?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <b><?php echo $_SESSION["name"] ?></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
	$handle = fopen("log.html", "r");
	$contents = fread($handle, filesize("log.html"));
        fclose($handle);
        echo $contents;
}
?></div>
     <form>
        <input name="usermsg" type="text" id="usermsg" size="63">
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send">
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
	function loadLog(){
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){
				$("#chatbox").html(html);
				//Auto-scroll
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}
		  	},
		});
	}
 $(document).ready(function(){
	setInterval(loadLog, 1000);
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit==true){window.location = 'index.php?logout=true';}		
	});
});
$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
</script><?php }?>
<a href="reset.php">Reset password?</a>
</body>
</html>


