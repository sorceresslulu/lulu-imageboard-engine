(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liBoardLayoutHeader', factory)
  ;

  factory.$inject = [];

  function factory() {
    BoardLayoutHeader.$inject = ['$scope'];

    function BoardLayoutHeader($scope) {
    }

    return {
      replace: true,
      restrict: 'E',
      controller: BoardLayoutHeader,
      templateUrl: 'modules/board/directive/BoardLayoutHeader/template.html',
      scope: {
        'board': '='
      }
    }
  }
})(angular);