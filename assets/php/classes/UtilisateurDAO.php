<?php

require_once("MySQLManager.php");

class UtilisateurDAO {

	//récupère les utilisateurs ayant publié des vidéos dans la base de données
	public static function getYoutubers() {
		$db = MySQLManager::get();
		$query = "SELECT DISTINCT(uti_id), uti_nom
					FROM jal_utilisateur
					JOIN jal_video ON uti_id = vid_uti_id";
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($uti_id, $uti_nom);
			/* Récupération des valeurs */
			$array = array();
			$uti = [];
			while($stmt->fetch()) {
			    	$uti = [];
			    	$uti['id'] = $uti_id;
			    	$uti['nom'] = $uti_nom;

					$array[] = $uti; // L'ajouter au tableau d'objet
		    	}
		  	$stmt->close();
		  	MySQLManager::close();
	  		return $array;
		}
		MySQLManager::close();
		return null;
	}

}

?>