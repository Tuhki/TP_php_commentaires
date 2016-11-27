<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8">
		<title>Blog</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
	</head>

	<body>
		
		<form action="connexion.php" method="POST">
			<h1>Se connecter</h1>
			
			<p>
				<label for="pseudo">Votre pseudo : </label><br/>
				<input type="text" name="pseudo" required="true"/>
			</p>
			
			<p>
				<label for="titre">Votre mot de passe : </label><br/>
				<input type="password" name="mdp" required="true"/>
			</p>
			
			<p>
				<input type="submit" value="Valider" />
			</p>
		</form>
		
		<form action="inscription.php" method="POST">
			<h1>S'inscrire</h1>
			
			<p>
				<label for="pseudo">Votre pseudo : </label><br/>
				<input type="text" name="pseudo" required="true"/>
			</p>
			
			<p>
				<label for="titre">Votre mot de passe : </label><br/>
				<input type="password" name="mdp" required="true"/>
			</p>
			
			<p>
				<input type="submit" value="Valider" />
			</p>
		</form>
	</body>
	
</html>
