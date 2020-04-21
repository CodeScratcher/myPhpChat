var sending = document.getElementById("sender");
var ajax = new XMLHttpRequest();
function postChat(text, toTeam) { 
	var toSend = new FormData();
	toSend.append("forTeam", toTeam);
 	toSend.append("text", text)
        ajax.open("POST", "gameChat.php", true);
	ajax.setRequestHeader("Content-type",  "application/x-www-form-urlencoded");
        ajax.send(toSend);
}
