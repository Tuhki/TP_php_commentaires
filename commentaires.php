<?php

	//début de session
	session_start();
		
	//on vérifie que l'utilisateur est bien connecté
	if (isset($_SESSION['pseudo'])){
		
		//création du cookie retenant le pseudo de l'utilisateur, détruit au bout de 30 minutes
		setcookie('pseudo', $_SESSION['pseudo'], time() + 1800, null, null, false, true);
		
		//Si la session est ouverte depuis plus de 30 minutes, l'utilisateur est déconnecté automatiquement
		if (isset($_SESSION['time'])){
			$heureActu= time();
			if ($heureActu - $_SESSION['time'] > 1800){
				session_destroy();
			}
		}else{
			$_SESSION['time']= time();
		}

		$i=0;
		
	/* GESTION DES ENTREES DU FORMULAIRE 
		BUT : RECUPERER LES DONNEES ENTREES DANS LE FORMULAIRE
		ENTREE : SAISIE UTILISATEUR
		SORTIE : SAISIE ENVOYEE DANS UN FICHIER TXT */
		
		if (isset($_SESSION['pseudo']) && isset($_POST['titre']) && isset($_POST['comm']))
		//si tous les champs du formulaire sont remplis
		{
			
			//recueil des données du formulaire
			$titre = htmlspecialchars($_POST['titre']);
			$comment = htmlspecialchars($_POST['comm']);
			
			//récupération de la date et de l'heure
			$quand = date ('d').'.'.date ('m').'.'.date ('Y').' - '.date ('H').':'.date ('i');
			
			
			//variable contenant le chemin du fichier à utiliser pour stocker les commentaires
			$file = 'stockCommentaires.txt';
			
			//variable contenant les données du formulaire
			$form = $titre.'¤'.$_SESSION['pseudo'].'¤'.$quand.'¤'.$comment.'§';
			
			//écriture des données dans le fichier
			file_put_contents($file, $form, FILE_APPEND | LOCK_EX);
			
			$_POST = array();
		}
		
	/* GESTION DES COMMENTAIRES */
		//récupération du contenu du fichier avec tous les commentaires
		$fichierForm = file_get_contents('stockCommentaires.txt', FILE_USE_INCLUDE_PATH);
		
		//séparation des résultats du formulaire
		$result = explode ('§' , $fichierForm);

		//séparation des commentaires en titre, pseudo, message et date
		for($i=0;$i<count($result);$i++){
			
			$test[$i] = explode ('¤',$result[$i]);
			
		}
		
	/* GESTION DES PAGES */
		//nombre de commentaires
		$pagemax = count($test) - 1;
		
		//nombre de commentaires affichés par page
		$comParPage = 5;
		
		//récupération de la page demandée
		if (isset($_GET['page'])){
			
			$pageActu = intval(htmlspecialchars($_GET['page']));
			
		}else{
			
			$pageActu = 1;
		}
		
		//empêche l'utilisateur d'entrer une page qui n'existe pas
		if ($pageActu > ceil($pagemax/5)){
			
			$pageActu = 1;
		}
		
		//affichage des commentaires structurés (5 par page)
		for($i=($pageActu-1)*$comParPage; ($i<$pageActu*$comParPage) && ($i<$pagemax);$i++){
			
			echo '<div class="commentaire">';
			echo '<h2>'.$test[$i][0].'<br/>';
			echo '<span id="pseudo">'.$test[$i][1].'</span>'.'<br/>';
			echo '<span id="date">'.$test[$i][2].'</span>'.'</h2>';
			echo '<p id="com">'.$test[$i][3].'</p>';
			echo '</div>';
		
		}
		
		//affichage du numéro de la page sur laquelle on est et le nombre de pages totales
		echo 'Page '.$pageActu.'/'.ceil($pagemax/5);
		
		//réaffichage du formulaire utilisable par l'utilisateur
		include ("formulaire.php");
		
		//affichage du bouton de déconnection
		include("deconnection.php");
		
	}else{ //si l'utilisateur n'est pas connecté, on le renvoie à la page de connection
		header("Location: pagePrincipale.html");
	}
?>