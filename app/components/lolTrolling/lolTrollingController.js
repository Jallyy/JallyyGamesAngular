var ctrlApp = angular.module('ctrlApp');

ctrlApp.controller('lolTrollingController', function($scope, $rootScope, $http, $location) {

	//déclaration des variables et scopes
    

    
    $scope.joueurs = [];
    
    $scope.nbJoueur;
    $scope.champRandom;
    $scope.equipRandom;
    $scope.sortInvoRandom;
    $scope.roleRandom;
    $scope.filtrage;

    var data = {};
    $scope.championsLimit;
    

	$scope.onCreate = function () {
        $scope.initVariables();
        $scope.cleanResultFiltres();
        $scope.traiterFiltres();
	}

    $scope.initVariables = function () {
        $scope.nbJoueur = true;
        $scope.champRandom = true;
        $scope.equipRandom = true;
        $scope.sortInvoRandom = true;
        $scope.roleRandom = true;
        $scope.cleanResultFiltres;
    }

    $scope.cleanResultFiltres = function () {
        $scope.filtrage = false;
    }

    $scope.getChampionsLimit = function () {
        $scope.championsLimit = [];
        var $promise = $http.post('assets/php/getChampionsLimitAPI.php', data);
        $promise.then(function (message) {
            var tab = message.data;
            for (var i = 0; i < tab.length; i++) {
                var obj = tab[i];
                $scope.championsLimit.push({
                    id : obj.id,
                    nom : obj.nom,
                    image : obj.image,
                    idJeu : obj.idJeu
                });
            }
        });
        console.log($scope.championsLimit); //le tableau se remplit
        console.log($scope.championsLimit[0]); //affiche undefined alors qu'il existe -_-
        console.log($scope.championsLimit.length); //Affiche 0
    }

    $scope.traiterFiltres = function () {      
        
        data = {
            nbJoueur: $scope.nbJoueur, 
            champion: $scope.champRandom,
            equipement: $scope.equipRandom,
            sortInvo: $scope.sortInvoRandom,
            role: $scope.roleRandom
        };

        $scope.getChampionsLimit();

        /*console.log($scope.championsLimit); //le tableau se remplit
        console.log($scope.championsLimit[0]); //affiche undefined alors qu'il existe -_-
        console.log($scope.championsLimit.length); //Affiche 0
*/

        /*for(var i=0; i<data['nbJoueur']; i++) {
            $scope.joueurs.push(
                {
                    indice: i,
                    nomChamp: $scope.championsLimit[0] + " asdf", 
                    imageChampion: "imageeee"
                }
            );
        } */
        $scope.filtrage = true;
    };
        
    //lancement des controles initiales
    $scope.onCreate();

});
