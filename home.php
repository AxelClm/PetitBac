<?php  
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("location: redirection.php?disconnect=true");
    exit();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Petit Bac - Home</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
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
						<div class="item" onclick="afficherSalleSelector()">
							<div class="text"> Rejoindre une Salle </div> 
							<div id="salleSelectorUT"class="underText"></div>
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
			<img src="data/loading.gif" class="loading" style="visibility: hide;display: none;">
		</div>
	</body>
	 <script src="js/Salle.js"></script> 
</html>