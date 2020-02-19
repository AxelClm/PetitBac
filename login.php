<?php  
session_start();
include("fonctionsPhp/FConnection.php");
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
		header("location: home.php");
		exit();
	}
if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
	tryConnect($_POST['pseudo'],$_POST['mdp']);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Petit Bac - Connexion</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<?php
			if (isset($_SESSION['message'])) {
				echo "<div id='error'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		<form method="post" action="login.php">
			<div class="login-box">
				<h1>S'identifier</h1>
				<div class="textbox">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input type="text" placeholder="Utilisateur" name="pseudo" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input type="password" placeholder="Mot de passe" name="mdp"/>
				</div>
				<input type="submit" value="Se connecter" class="btn"/>
				<a href="register.php" id="register" ><input type="button" value="S'inscrire" class="btn" /></a>
			</div>
		</form>
	</body>
</html>