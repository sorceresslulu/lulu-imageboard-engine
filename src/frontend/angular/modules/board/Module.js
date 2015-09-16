(function(angular) {
  "use strict";

  angular
    .module('board', ['ui.router'])
    .config(['$stateProvider', '$urlRouterProvider', RouterConfig])
  ;

  function RouterConfig($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('board-index', {
        url: '/boards/',
        controller: 'BoardIndexController',
        templateUrl: 'modules/board/controller/Index/template.html'
      })
  }
})(angular);