<?php

	$i=0;
	
	if (isset($_POST['pseudo']) AND isset($_POST['titre']) AND isset($_POST['comm']))
	//si tous les champs du formulaire sont remplis
	{
		
		//recueil des données du formulaire
		$titre = htmlspecialchars($_POST['titre']);
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$comment = htmlspecialchars($_POST['comm']);
		
		//récupération de la date et de l'heure
		$quand = date ('d').'.'.date ('m').'.'.date ('Y').' - '.date ('H').':'.date ('i');
		
		
		//variable contenant le chemin du fichier à utiliser pour stocker les commentaires
		$file = 'stockCommentaires.txt';
		
		//variable contenant les données du formulaire
		$form = $titre.'¤'.$pseudo.'¤'.$quand.'¤'.$comment.'§';
		
		//écriture des données dans le fichier
		file_put_contents($file, $form, FILE_APPEND | LOCK_EX);
	
	}
	
	//récupération du contenu du fichier avec tous les commentaires
	$fichierForm = file_get_contents('stockCommentaires.txt', FILE_USE_INCLUDE_PATH);
	
	//séparation des résultats du formulaire
	$result = explode ('§' , $fichierForm);
	
	//séparation des commentaires en titre, pseudo, message et date
	for($i=0;$i<count($result);$i++){
		
		$test[$i] = explode ('¤',$result[$i]);
		
	}
	
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
	if ($pageActu > $pagemax/5){
		
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
	
	//réaffichage du formulaire utilisable par l'utilisateur
	include ("formulaire.php");
	
?>