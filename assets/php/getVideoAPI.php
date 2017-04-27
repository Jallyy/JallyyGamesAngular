<?php
	require_once("classes/Sanitizer.php");
	//require_once("classes/UserAuthentication.php");

	$data = Sanitizer::getSanitizedJSInput();
	/*$authentified = UserAuthentication::checkAuthentication($data['user_id'], $data['user_token']);

	if ($authentified == false) {
		// Utilisateur non autorisé 
		echo("Vous n'avez pas le droit d'appeler cette requete ou requete invalide");
	} else {*/
		// Utilisateur autorisé 
		require_once("classes/VideoDAO.php");
		$res = VideoDAO::getVideo($data['idVideo']); // Récupère le résulat obtenu
		
		echo(json_encode($res));
	//}
?>