(function(angular) {
  angular
    .module('lulu-imageboard')
    .config(RouterConfig)
  ;

  RouterConfig.$inject = ['$stateProvider'];

  function RouterConfig($stateProvider) {
    $stateProvider
      .state('thread-view-by-thread-id', {
        url: '/:boardUrl/thread/:threadId/',
        controller: 'ThreadViewThreadController',
        templateUrl: 'modules/thread/controller/ViewThread/template.html'
      })
    ;
  }
})(angular);