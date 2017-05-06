<?php

require_once("MySQLManager.php");

class ChampionDAO {

	public static function getChampions() {
		$db = MySQLManager::get();
		$query = "SELECT cha_id, cha_nom, cha_image, cha_jeu_id FROM jal_champion";
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($cha_id, $cha_nom, $cha_image, $cha_jeu_id);
			/* Récupération des valeurs */
			$array = array();
			$obj = [];
			while($stmt->fetch()) {
			    	$obj = [];
			    	$obj['id'] = $cha_id;
			    	$obj['nom'] = $cha_nom;
			    	$obj['image'] = $cha_image;
			    	$obj['idJeu'] = $cha_jeu_id;
			    	
					$array[] = $obj; // L'ajouter au tableau d'objet
		    	}
		  	$stmt->close();
		  	MySQLManager::close();
	  		return $array;
		}
		MySQLManager::close();
		return null;
	}

	public static function getChampionsLimit($nbRecord) {
		$db = MySQLManager::get();
		$query = "SELECT cha_id, cha_nom, cha_image, cha_jeu_id 
					FROM jal_champion
					ORDER BY RAND()
					LIMIT 5";
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($cha_id, $cha_nom, $cha_image, $cha_jeu_id);
			/* Récupération des valeurs */
			$array = array();
			$obj = [];
			while($stmt->fetch()) {
			    	$obj = [];
			    	$obj['id'] = $cha_id;
			    	$obj['nom'] = $cha_nom;
			    	$obj['image'] = $cha_image;
			    	$obj['idJeu'] = $cha_jeu_id;
			    	
					$array[] = $obj; // L'ajouter au tableau d'objet
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