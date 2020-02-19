<?php  
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("location: redirection.php?disconnect=true");
    exit();
}

$cate = 1;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Petit Bac - Créer une salle</title>
		<link rel="stylesheet" type="text/css" href="css/createsalle.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<header>
			<div class="container">
					<div class="navLeft">
						<div class="imgContainer">
							<img src="data/logo.png">
						</div>
					</div>
					<div class="navCenter">
						<div class="item">
							<div class="text"> Rejoindre une Salle </div> 
							<div class="underText"></div>
						</div>
						<div class="item"> 
							<div class="text"> Nouvelle Partie </div>
							<div class="underText"></div>
						</div>
						<div class="item"> 
							<div class="text"> A Propos </div>
							<div class="underText"></div>
						</div>
					</div>
					<div class="navRight">
						<div id=itemProfil>
							<i class="far fa-user"></i>
							<p><?php echo $_SESSION["username"]?></p>
						</div>
						<a id="itemDisco" href="redirection.php?disconnect=true">
							<i class="fas fa-sign-out-alt"></i>
							<div class="underText"></div>
						</a>
					</div>
			</div>
		</header>

		<div class="trigger">
			<div class="salleContainer">
				<div class="salleHeader">
					<h2>Créer une salle</h2>
				</div>
				<form>
					<div>Nom de la salle <input type="text" required name="nomSalle" value="Salle de <?php echo $_SESSION["username"]?>"></div><br/>
					<div>Nombre de joueurs <input type="number" required name="nbJoueur" value="4" min="2" max="99"></div><br/>
					<div>Partie Privée <input type="radio" required name="prive" value="Oui">Oui <input type="radio" name="prive" value="Non" checked>Non </div><br/>
					<div id="categorie">Catégorie : <input type="button" value="+" onClick="addCategorie()"><br/>
						<div id="Cat1"><input type="text" value="Animaux"></div>
					</div><br/>
					<input type="submit" value="Créer la Partie">
				</form>
			</div>
		</div>
	</body>
	 <script src="createsalle.js"></script> 
</html>