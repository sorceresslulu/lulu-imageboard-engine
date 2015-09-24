(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liBoardFeed', factory)
  ;

  factory.$inject = [];

  function factory() {
    LiBoardFeed.$inject = ['$scope'];

    function LiBoardFeed($scope) {
      this.boardFeed = $scope.boardFeed;
    }

    return {
      replace: true,
      restrict: 'E',
      controller: LiBoardFeed,
      templateUrl: 'modules/board/component/BoardFeed/template.html',
      scope: {
        boardFeed: '='
      }
    }
  }
})(angular);