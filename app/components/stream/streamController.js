var ctrlApp = angular.module('ctrlApp');

ctrlApp.controller('streamController', function($scope, $rootScope, $http, $location) {

	//déclaration des variables et scopes

	$scope.onCreate = function () {
        console.log ("onCreate du streamController");
	}

    //lancement des controles initiales
    $scope.onCreate();

});
