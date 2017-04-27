<?php

require_once("MySQLManager.php");

class JeuDAO {

	public static function getJeux() {
		$db = MySQLManager::get();
		$query = "SELECT jeu_id, jeu_nom FROM jal_jeu";
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($jeu_id, $jeu_nom);
			/* Récupération des valeurs */
			$array = array();
			$jeu = [];
			while($stmt->fetch()) {
			    	/* Stocker l'absence */
			    	$jeu = [];
			    	$jeu['id'] = $jeu_id;
			    	$jeu['nom'] = $jeu_nom;

					$array[] = $jeu; // L'ajouter au tableau d'objet
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