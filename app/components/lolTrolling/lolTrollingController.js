var ctrlApp = angular.module('ctrlApp');

ctrlApp.controller('lolTrollingController', function($scope, $rootScope, $http, $location) {

	//déclaration des variables et scopes
    var data = {};
    $scope.nbJoueur;
    $scope.champRandom;
    $scope.equipRandom;
    $scope.sortInvoRandom;
    $scope.roleRandom;

	$scope.onCreate = function () {
        $scope.initVariables();
	}

    $scope.initVariables = function () {
        $scope.nbJoueur = true;
        $scope.champRandom = true;
        $scope.equipRandom = true;
        $scope.sortInvoRandom = true;
        $scope.roleRandom = true;
    }

    $scope.getSelections = function () {
        data = {nbJoueur : $scope.nbJoueur, 
                champion: $scope.champRandom,
                equipement: $scope.equipRandom,
                sortInvo: $scope.sortInvoRandom,
                role: $scope.roleRandom};
        console.log(data);
    }

    //lancement des controles initiales
    $scope.onCreate();

});
