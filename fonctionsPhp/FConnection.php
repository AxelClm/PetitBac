<?php  
include("db.php");

function tryConnect($username,$password){
	$db = connect();
	$username = mysqli_real_escape_string($db, $username);
	$password = mysqli_real_escape_string($db, $password);
	$password = md5($password);

	$query = "SELECT * FROM PB_User WHERE username='$username' AND password='$password'";
	$result = mysqli_query($db, $query);

	if (mysqli_num_rows($result) == 1) {
		foreach($result as $enr) {
	  		$_SESSION['id'] = $enr['id'];
	  	}	
		$_SESSION['message'] = "Connecté";
		$_SESSION['username'] = $username;
		mysqli_close($db);
		header("location: home.php");
		exit();

	} else {
		$_SESSION['message'] = "Invalide";
		mysqli_close($db);
	}
	
}
function tryRegister($username,$password,$confirm){
	$db = connect();
	$username = mysqli_real_escape_string($db, $username);
	$query = "SELECT * FROM PB_User WHERE username='$username'";
	$result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['message'] = "Pseudo déjà existant";
	}
	else if (!ctype_alnum($username)) {
		$_SESSION['message'] = "L'identifiant doit être alphanumérique";
	}
	else {
		$password = mysqli_real_escape_string($db, $password);
		$confirm = mysqli_real_escape_string($db, $confirm);
		if ($password == $confirm) {
			$password = md5($password);
			$query = "INSERT INTO PB_User(username, password) VALUES('$username', '$password')";
			mysqli_query($db, $query);
			$query = "SELECT id FROM PB_User WHERE username='$username'";
			$result = mysqli_query($db, $query);
				
			if (mysqli_num_rows($result) == 1) {
				foreach($result as $enr) {
	  		 		$_SESSION['id'] = $enr['id'];
				}
			}
			$_SESSION['message'] = "Connecté";
			$_SESSION['username'] = $username;	
			header("location: home.php");
			exit();
		}
		else{
			$_SESSION['message'] = "Le mdp ne correspond pas";
		}
	}

}

?>