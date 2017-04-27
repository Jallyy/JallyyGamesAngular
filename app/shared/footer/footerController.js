/**
* Module qui gère les directives du Menu 
* Il possède une directive ngMenu qui affichera le menu dans l'application 
* lorsqu'elle est utilisé comme suit : <ng-menu></ng-menu>
**/
var ctrlApp = angular.module('ctrlApp');

ctrlApp.directive('ngFooter', function() {
	return {
		restrict : 'E', // Ici se limite à la balise si on veut pour un attribut = A
		templateUrl : 'app/shared/footer/footerView.html', // Template à utiliser lorsque la balise est utilisé
		controller: 'footer'
	};
});

ctrlApp.controller('footer', function ($scope) {

});

