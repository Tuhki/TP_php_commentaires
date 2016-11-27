<?php
	//début de session
	session_start();
	
	//appel du fichier css qui gère l'apparence du site
	echo '<link rel="stylesheet" href="style.css"/>';
	
	if (isset($_POST['pseudo']) && isset($_POST['mdp']))
	//si tous les champs du formulaire sont remplis
	{
		
		//recueil des données du formulaire
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdp= htmlspecialchars($_POST['mdp']);
		$identifiants= $pseudo.$mdp;

		$fichierInfos = file_get_contents('parametresConnexion.txt', FILE_USE_INCLUDE_PATH);
		
		$casse = explode('%' , $fichierInfos);
		
		$i=0;
		for($i=0;$i<count($casse);$i++){
			if ($identifiants == $casse[$i]){
				echo 'Identifiants déjà utilisés';
				header("Location: formulaire_connexion.php");
				exit();
			}	
		}
		
		$_SESSION['pseudo']=$pseudo;
		echo 'Inscription réussie';
				
		//variable contenant le chemin du fichier à utiliser pour stocker les commentaires
		$file = 'parametresConnexion.txt';
				
		//écriture des données dans le fichier
		file_put_contents($file, $identifiants.'%', FILE_APPEND | LOCK_EX);
			
		//redirection vers la page de commentaires
		header("Location: commentaires.php");
		break;
		
	}

?>