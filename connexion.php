<?php
	//début de session
	session_start();
	
	//appel du fichier css qui gère l'apparence du site
	echo '<link rel="stylesheet" href="style.css"/>';
	
	if (isset($_POST['pseudo']) && isset($_POST['mdp']))
	//si tous les champs du formulaire sont remplis
	{
		
		//recueil des données du formulaire
		$pseudo = $_POST['pseudo'];
		$mdp= $_POST['mdp'];
		$identifiants= $pseudo.$mdp;

		$fichierInfos = file_get_contents('parametresConnexion.txt', FILE_USE_INCLUDE_PATH);
		
		$casse = explode('%' , $fichierInfos);
		
		$i=0;
		for($i=0;$i<count($casse);$i++){
			if ($identifiants == $casse[$i]){
				$_SESSION['pseudo']=$pseudo;
				echo 'Connection réussie';
				header("Location: commentaires.php");
				break;
			}else{
				echo 'Identifiants inconnus';
			}
			
		}
		
	}

?>