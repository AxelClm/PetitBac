<?php  
session_start();
include("fonctionsPhp/FConnection.php");
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
	header("location: home.php");
	exit();
}
if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
	tryRegister($_POST['pseudo'],$_POST['mdp'],$_POST['confirm']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Petit Bac - Inscription</title>
		<link rel="stylesheet" type="text/css" href="css/register.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<?php
			if (isset($_SESSION['message'])) {
				echo "<div id='error'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		<form method="post" action="register.php">
			<div class="register-box">
				<h1>Inscription</h1>
				<div class="textbox">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input required type="text" placeholder="Utilisateur" name="pseudo" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input required type="password" placeholder="Mot de passe" name="mdp" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input required type="password" placeholder="Confirmation" name="confirm" />
				</div>
				<input type="submit" value="S'inscrire" class="btn"/>
				<a href="login.php" id="accueil" ><input type="button" value="Retour à l'accueil" class="btn" /></a>
			</div>
		</form>
	</body> 
</html>
