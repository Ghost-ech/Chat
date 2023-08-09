<?php 
	//connexion à la bd
	$con = mysqli_connect("localhost","root","","chat");
	//gérer les accents et autres caractères français
	$req = mysqli_query($con, "SET NAMES UTF8");
	if (!$con){
		//si connexion echoue
	}

?>