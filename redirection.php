<?php  
session_start();
if (isset($_GET['disconnect'])) {
    // Détruit toutes les variables de session
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
    }

    // Finalement, on détruit la session.
    session_destroy();
    header("location: login.php");
    exit();
}
if (isset($_GET['IDSalle'])){
	if (!isset($_SESSION['num_user']) || !isset($_SESSION['login'])) {
    	header("location: redirection.php?disconnect=true");
    	exit();
	}
}

?>