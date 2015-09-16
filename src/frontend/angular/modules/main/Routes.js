(function (angular) {
  "use strict";

  angular
    .module('main')
    .config(['$stateProvider', '$urlRouterProvider', router])
  ;

  function router($stateProvider, $urlRouterProvider) {
    $urlRouterProvider
      .otherwise('main.not-found');

    $stateProvider
      .state('main.index', {
        url: '/',
        templateUrl: 'modules/main/controller/Index/template.html'
      })
      .state('main.not-found', {
        templateUrl: 'modules/main/controller/NotFound/template.html'
      })
  }
})(angular);