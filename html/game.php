<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION["name"])) {
header("Location:register.php");
}
require_once("config.php");
$link->query("INSERT IGNORE INTO teams(score) VALUE (0);");
if ($prepared =$link->prepare(" INSERT IGNORE INTO players(username, team) VALUES (?, ?);")){
$prepared->bind_param("si", $name, $team);
$name=$_SESSION["name"];
$team=2;
$prepared->execute();
$prepared->close();
} else {
    $error = $link->errno . ' ' . $link->error;
    echo $error; 
}
  ?>
 <!DOCTYPE html>
<html>
<head>
<title>WIP: Game</title>
</head>
<body>
<input id="sender">
<button onclick="postChat(sending.value,false)">Send to group</button>
<button onclick="postChat(sending.value, true)">Send to all</button>
<br>
<div id="chat"><p>Welcome, <?php echo $_SESSION["name"];?> &nbsp; You are on team <?php echo $team ?></p><?php
 $chatbox = $link->query("SELECT text FROM chat WHERE team = 1 OR team = " . $team .";");
while ($toEcho = $chatbox->fetch_assoc()){
 echo "<p class='msg'>" .$toEcho["text"] ."</p>";
}
?></div>
<script src="game-1-1.js"></script>
</body>
</html>

