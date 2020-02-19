<?php  
include("db.php");

function getPublicSalles(){
	$db = connect();
	$query = "SELECT IDSalle,nomSalle,Categorie,taille,placeRestante FROM PB_Salle WHERE Public = 1;";
	$res = mysqli_query($db, $query);
	$rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    //session_write_close();
   	return $rows;
}


?>