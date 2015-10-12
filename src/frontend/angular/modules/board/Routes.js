(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .config(['$stateProvider', RouterConfig])
  ;

  function RouterConfig($stateProvider) {
    $stateProvider
      .state('board-index', {
        url: '/boards/',
        controller: 'BoardIndexController',
        templateUrl: 'modules/board/controller/Index/template.html'
      })
      .state('board-feed', {
        url: '/board/:boardUrl/',
        controller: 'BoardFeedController',
        templateUrl: 'modules/board/controller/Feed/template.html'
      })
  }
})(angular);
