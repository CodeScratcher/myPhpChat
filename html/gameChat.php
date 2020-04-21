<?php 

session_start();
$post =$link->prepare("INSERT INTO chat ('text', 'team') VALUES (?, ?)");
if ($_POST["forChat"]) {
$teamToPost = 1;
}
else {
$teamToPost=$team;
}
$post->bind_param("si", $_POST["text"] $teamToPost);
$post->execute();
echo "Sent successfully!";
?>
