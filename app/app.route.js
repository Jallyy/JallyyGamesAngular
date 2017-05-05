(function(){ /* Afin de permettre de ne pas créer de conflit */
'use strict';
/**
 * Déclaration de l'application ctrlApp
 * Tous les modules de l'application seront fait avec la syntaxe suivante :
 * var xxx = angular.module('ctrlApp'); Ainsi je récupère les dépendances de ctrlApp.
**/
/* On déclare ici toutes les dépendances */
var ctrlApp = angular.module('ctrlApp', ['ngRoute', 'ngMaterial', 'ngMessages']);
/**
 * Configuration du module principal : ctrlApp
 * La configuration des routes de l'applications est faites dans la procédures suivante.
 * Si le chemin n'est pas trouvé l'application redirige l'utilisateur vers la page home.
**/
ctrlApp.config(['$routeProvider', function($routeProvider) { // $routeProvider essentiel pour la configuration des routes
        $routeProvider

        /* Les changements ou ajouts de route se font ici */
        .when('/home', { // Chemin de home
            templateUrl: 'app/components/home/homeView.html',
            controller: 'homeController' // Contrôleur de la page home
        })
        .when('/videos', {
            templateUrl: 'app/components/videos/videosView.html',
            controller: 'videosController'
        })
        .when('/videos/:id', {
            templateUrl: 'app/components/videos/videoDetailsView.html',
            controller: 'videoDetailsController'
        })
         .when('/stream', {
            templateUrl: 'app/components/stream/streamView.html',
            controller: 'streamController'
        })
         .when('/lolTrolling', {
            templateUrl: 'app/components/lolTrolling/lolTrollingView.html',
            controller: 'lolTrollingController'
        })
        .otherwise({
            redirectTo: '/home' // Redirection sur la page home
        });

    }
]);

ctrlApp.config(function($mdThemingProvider) {
 $mdThemingProvider.theme('default')
    .primaryPalette('pink')
    .accentPalette('blue');
});

})();


