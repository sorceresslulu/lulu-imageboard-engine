(function(angular) {
  "use strict";

  angular
    .module('board', [
      'thread',
      'ui.router',
      'ngResource'
    ])
    .config(['$stateProvider', RouterConfig])
  ;

  function RouterConfig($stateProvider) {
    $stateProvider
      .state('board-index', {
        url: '/boards/',
        controller: 'BoardIndexController',
        templateUrl: 'modules/board/controller/Index/template.html'
      })
      .state('board-threads', {
        url: '/board/:boardURL/',
        controller: 'BoardThreadsController',
        templateUrl: 'modules/board/controller/Threads/template.html'
      })
  }
})(angular);
