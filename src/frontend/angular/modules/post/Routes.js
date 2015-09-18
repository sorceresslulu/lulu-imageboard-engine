(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .config(RouterConfig)
  ;

  RouterConfig.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider'];

  function RouterConfig($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
      .state('posts-by-thread-id', {
        url: '/posts/:threadId',
        controller: 'PostsByThreadId',
        templateUrl: 'modules/post/controller/ByThreadId/template.html'
      })
  }
})(angular);