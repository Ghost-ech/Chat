<?php
	//démarrer la session
	session_start();
	if (!isset($_SESSION['user'])) {
		// si l'utilisateur n'est pas connecté
		// redirection vers la page de connexion
		header("location:index.php");
	}
	//destruction de toutes les sessions
	session_destroy();
	//redirection vers la page de connexion
	header("location:index.php");
?>