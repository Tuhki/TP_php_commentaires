<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Blog</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
	</head>

	<body>
		<form class="choixPage" action ="commentaires.php" method="GET">
			<label for="page">Page :</label>
			<input id="saisiepage" type="text" name="page" required="true"/>
			<input type="submit" value="Go !"/>
		</form>
		
		<form action="commentaires.php" method="POST">
			<h1>Ajouter un commentaire</h1>
			
			<p>
				<label for="pseudo">Votre pseudo : </label><br/>
				<input type="text" name="pseudo" required="true"/>
			</p>
			
			<p>
				<label for="titre">Titre : </label><br/>
				<input type="text" name="titre" required="true"/>
			</p>
			
			<p>			
				<label for="message">Votre message : </label><br/>
				<textarea id="message" name="comm" placeholder="Laisser un commentaire..." cols="60" rows="10" required="true"></textarea><br/>
			</p>
			
			<p>
				<input type="submit" value="Valider" />
			</p>
		</form>
	</body>
	
</html>
