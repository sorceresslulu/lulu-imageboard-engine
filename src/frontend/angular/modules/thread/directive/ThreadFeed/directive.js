(function(angular) {
  angular
    .module('lulu-imageboard')
    .directive('liThreadFeed', factory)
  ;

  function factory() {
    function ThreadFeed($scope) {
    }

    ThreadFeed.$inject = ['$scope'];

    return {
      replace: true,
      restrict: 'E',
      controller: ThreadFeed,
      templateUrl: 'modules/thread/directive/ThreadFeed/template.html',
      scope: {
        threadFeed: '='
      }
    };
  }
})(angular);