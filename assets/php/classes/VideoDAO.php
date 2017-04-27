<?php

require_once("MySQLManager.php");

class VideoDAO {

	public static function getVideos() {
		$db = MySQLManager::get();
		$query = "SELECT vid_id, vid_date, vid_titre, vid_image, vid_description, vid_url, vid_uti_id, vid_jeu_id, uti_nom
					FROM jal_video
					JOIN jal_utilisateur ON uti_id = vid_uti_id
				";
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($vid_id, $vid_date, $vid_titre, $vid_image, $vid_description, $vid_url, $vid_uti_id, $vid_jeu_id, $uti_nom);
			/* Récupération des valeurs */
			$array = array();
			$video = [];
			while($stmt->fetch()) {
			    	$video = [];
			    	$video['id'] = $vid_id;
			    	$video['date'] = $vid_date;
			    	$video['titre'] = $vid_titre;
			    	$video['image'] = $vid_image;
			    	$video['description'] = $vid_description;
			    	$video['url'] = $vid_url;
			    	$video['idUti'] = $vid_uti_id;
			    	$video['idJeu'] = $vid_jeu_id;
			    	$video['nomUti'] = $uti_nom;

					$array[] = $video; // L'ajouter au tableau d'objet
		    	}
		  	$stmt->close();
		  	MySQLManager::close();
	  		return $array;
		}
		MySQLManager::close();
		return null;
	}


	public static function getVideosFiltre($data) {
		$db = MySQLManager::get();
		$query = "SELECT vid_id, vid_date, vid_titre, vid_image, vid_description, vid_url, vid_uti_id, vid_jeu_id, uti_nom
					FROM jal_video
					JOIN jal_utilisateur ON uti_id = vid_uti_id
					JOIN jal_jeu ON vid_jeu_id = jeu_id
					";

		$where = false;
		if ($data['youtuber'] != 0) {
			$query .= " WHERE uti_id = " . $data['youtuber'];
			$where = true;
		}

		if (($data['jeu'] != 0)){
			if ($where) {
				$query .= " AND jeu_id = " . $data['jeu'];
			}else {
				$query .= " WHERE jeu_id = " . $data['jeu'];
			}
		}
		//return $query;

		if ($stmt = $db->prepare($query)) {
			//$stmt->bind_param('ss', $data['youtuber'], $data['jeu']);
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($vid_id, $vid_date, $vid_titre, $vid_image, $vid_description, $vid_url, $vid_uti_id, $vid_jeu_id, $uti_nom);
			/* Récupération des valeurs */
			$array = array();
			$video = [];
			while($stmt->fetch()) {
			    	$video = [];
			    	$video['id'] = $vid_id;
			    	$video['date'] = $vid_date;
			    	$video['titre'] = $vid_titre;
			    	$video['image'] = $vid_image;
			    	$video['description'] = $vid_description;
			    	$video['url'] = $vid_url;
			    	$video['idUti'] = $vid_uti_id;
			    	$video['idJeu'] = $vid_jeu_id;
			    	$video['nomUti'] = $uti_nom;

					$array[] = $video; // L'ajouter au tableau d'objet
		    	}
		  	$stmt->close();
		  	MySQLManager::close();
	  		return $array;
		}
		MySQLManager::close();
		return null;
	}

	public static function getVideo($idVideo) {
		$db = MySQLManager::get();
		$query = "SELECT vid_id, vid_date, vid_titre, vid_image, vid_description, vid_url, vid_uti_id, vid_jeu_id, uti_nom
					FROM jal_video
					JOIN jal_utilisateur ON uti_id = vid_uti_id
					WHERE vid_id = ".$idVideo;
		if ($stmt = $db->prepare($query)) {
			/* Exécution de la requête */
			$stmt->execute();
			/* Lecture des variables résultantes */
			$stmt->bind_result($vid_id, $vid_date, $vid_titre, $vid_image, $vid_description, $vid_url, $vid_uti_id, $vid_jeu_id, $uti_nom);
			/* Récupération des valeurs */
			$array = array();
			$vid = [];
			while($stmt->fetch()) {
			    	$vid = [];
			    	$vid['id'] = $vid_id;
			    	$vid['date'] = $vid_date;
			    	$vid['titre'] = $vid_titre;
			    	$vid['image'] = $vid_image;
			    	$vid['description'] = $vid_description;
			    	$vid['url'] = $vid_url;
			    	$vid['idUti'] = $vid_uti_id;
			    	$vid['idJeu'] = $vid_jeu_id;
			    	$vid['nomUti'] = $uti_nom;

					$array[] = $vid; // L'ajouter au tableau d'objet
		    	}
		  	$stmt->close();
		  	MySQLManager::close();
	  		return $array;
		}
		MySQLManager::close();
		return null;
	}

	public static function getJeuId ($vid_id) {
		$db = MySQLManager::get();
		$query = "SELECT vid_jeu_id FROM jal_video WHERE vid_id = $vid_id";
		if ($stmt = $db->prepare($query)) {
			$stmt->execute();
			$stmt->bind_result($vid_jeu_id);
			while($stmt->fetch()) {
				return $vid_jeu_id;
			}
		  	$stmt->close();
		  	MySQLManager::close();
		}
		MySQLManager::close();
		return null;
	}

	public static function getVideosSimilaires($data) {
		$vid_jeu_id = VideoDAO::getJeuId($data['idVideo']);
		$db = MySQLManager::get();
		$query = "SELECT vid_id, vid_date, vid_titre, vid_image, vid_description, vid_url, vid_uti_id, vid_jeu_id, uti_nom
					FROM jal_video
					JOIN jal_utilisateur ON vid_uti_id = uti_id
					WHERE vid_id <> ".$data['idVideo']." AND vid_jeu_id = ".$vid_jeu_id;
		if ($stmt = $db->prepare($query)) {
			// Exécution de la requête
			$stmt->execute();
			// Lecture des variables résultantes 
			$stmt->bind_result($vid_id, $vid_date, $vid_titre, $vid_image, $vid_description, $vid_url, $vid_uti_id, $vid_jeu_id, $uti_nom);
			// Récupération des valeurs 
			$array = array();
			$video = [];
			while($stmt->fetch()) {
		    	$video = [];
		    	$video['id'] = $vid_id;
		    	$video['date'] = $vid_date;
		    	$video['titre'] = $vid_titre;
		    	$video['image'] = $vid_image;
		    	$video['description'] = $vid_description;
		    	$video['url'] = $vid_url;
		    	$video['idUti'] = $vid_uti_id;
		    	$video['idJeu'] = $vid_jeu_id;
		    	$video['nomUti'] = $uti_nom;

				$array[] = $video; // L'ajouter au tableau d'objet
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