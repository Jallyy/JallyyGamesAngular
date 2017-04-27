var ctrlApp = angular.module('ctrlApp');

ctrlApp.controller('videosController', function($scope, $rootScope, $http, $location) {

	//déclaration des variables et scopes
	$scope.jeux = [];
	$scope.youtubers = [];
	$scope.videos = [];
	var data = {};

	$scope.onCreate = function () {
		$scope.getJeux();
   		$scope.getYoutubers();
   		$scope.getVideos();
	}

	$scope.getJeux = function () {
    	var $promise = $http.post('assets/php/getJeuxAPI.php', data);
    	$promise.then(function (message) {
    		var tab = message.data;
    		for (var i = 0; i < tab.length; i++) {
    			var jeu = tab[i];
    			$scope.jeux.push({
    				id : jeu.id,
    				nom : jeu.nom
    			});
    		}
    	});
    }

    $scope.getYoutubers = function () {
    	var $promise = $http.post('assets/php/getYoutubersAPI.php', data);
    	$promise.then(function (message) {
    		var tab = message.data;
    		for (var i = 0; i < tab.length; i++) {
    			var uti = tab[i];
    			$scope.youtubers.push({
    				id : uti.id,
    				nom : uti.nom
    			});
    		}
    	});
    }

    $scope.getVideos = function () {
    	var $promise = $http.post('assets/php/getVideosAPI.php', data);
    	$promise.then(function (message) {
    		var tab = message.data;
     		for (var i = 0; i < tab.length; i++) {
    			var vid = tab[i];
    			$scope.videos.push({
    				id : vid.id,
    				date : vid.date,
    				titre : vid.titre,
    				image : vid.image,
    				description : vid.description,
    				url : vid.url,
    				idUti : vid.idUti,
    				idJeu : vid.idJeu,
    				nomUti : vid.nomUti
    			});
    		}
    	});
    }

    $scope.getVideosFiltre = function () {
        data = {youtuber : $scope.selectYoutuber, jeu: $scope.selectJeu};
        $scope.videos = [];
    	var $promise = $http.post('assets/php/getVideosFiltreAPI.php', data);
    	$promise.then(function (message) {
    		var tab = message.data;
    		for (var i = 0; i < tab.length; i++) {
    			var vid = tab[i];
    			$scope.videos.push({
    				id : vid.id,
    				date : vid.date,
    				titre : vid.titre,
    				image : vid.image,
    				description : vid.description,
    				url : vid.url,
    				idUti : vid.idUti,
    				idJeu : vid.idJeu,
    				nomUti : vid.nomUti
    			});
    		}
    	});
    }

    //lancement des controles initiales
    $scope.onCreate();

});
