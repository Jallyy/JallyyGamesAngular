var ctrlApp = angular.module('ctrlApp');

ctrlApp.controller('videoDetailsController', function($routeParams, $scope, $rootScope, $http, $location, $sce) {

	//déclaration des variables et scopes
	$scope.videosSimilaires = [];
    $scope.video = [];
    $scope.videoSimilaireCount = 1333;

    $scope.onCreate = function () {
   		$scope.getVideo();
        $scope.getVideosSimilaires();
	}

	$scope.getVideosSimilaires = function () {
        var data = {idVideo : $routeParams.id};
        $scope.videosSimilaires = [];
    	var $promise = $http.post('assets/php/getVideosSimilairesAPI.php', data);
    	$promise.then(function (message) {
    		var tab = message.data;
            if (tab.length == 0) {
                $scope.videoSimilaireCount = 0;
            }else {
                $scope.videoSimilaireCount = 1;
                for (var i = 0; i < tab.length; i++) {
                    var vid = tab[i];
                    $scope.videosSimilaires.push({
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
            }
    		
    	});
    }

    $scope.getVideo = function () {
        var data = {idVideo : $routeParams.id};
        $scope.video = [];
        var $promise = $http.post('assets/php/getVideoAPI.php', data);
        $promise.then(function (message) {
            var tab = message.data;
            for (var i = 0; i < tab.length; i++) {
                var vid = tab[i];
                $scope.video.push({
                    id : vid.id,
                    date : vid.date,
                    titre : vid.titre,
                    image : vid.image,
                    description : vid.description,
                    url : $sce.trustAsResourceUrl(vid.url),
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
