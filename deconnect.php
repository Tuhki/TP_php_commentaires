<?php
	session_destroy();
	unset($_COOKIE['pseudo']);
	header("Location: pagePrincipale.html");
?>