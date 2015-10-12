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
      this.currentPage = 0;
      this.boardFeed = $scope.boardFeed;

      $scope.status = this.boardFeed.status;
    }

    return {
      replace: true,
      restrict: 'E',
      controller: LiBoardFeed,
      templateUrl: 'modules/board/directive/BoardFeed/template.html',
      scope: {
        boardFeed: '='
      }
    }
  }
})(angular);