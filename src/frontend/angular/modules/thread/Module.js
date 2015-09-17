(function(angular) {
  angular
    .module('thread', ['ngResource'])
    .config(RouterConfig)
  ;

  RouterConfig.$inject = ['$stateProvider'];

  function RouterConfig($stateProvider) {
    $stateProvider
      .state('thread.view', {
        url: '/thread/:id/',
        controller: 'ThreadViewController',
        templateUrl: 'modules/thread/controller/View/template.html'
      })
    ;
  }
})(angular);