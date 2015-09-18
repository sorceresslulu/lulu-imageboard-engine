(function(angular) {
  "use strict";

  angular.module('templates', []);

  angular
    .module('lulu-imageboard')
    .config(RouterConfig)
  ;

  RouterConfig.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider'];

  function RouterConfig($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode(true);

    $stateProvider
      .state('main-index', {
        url: '/',
        controller: 'MainIndexController',
        templateUrl: 'modules/main/controller/Index/template.html'
      })
      .state('main-not-found', {
        url: '/error/not-found/',
        controller: 'MainNotFoundController',
        templateUrl: 'modules/main/controller/NotFound/template.html'
      })
  }
})(angular);