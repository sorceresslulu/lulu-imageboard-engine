(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('BoardIndexController', factory)
  ;

  factory.$inject = ['$scope', 'BoardService'];

  function factory($scope, BoardService) {
    function BoardIndexController() {
      $scope.boards = [];

      BoardService.getAllBoards().forEach(function(board) {
        $scope.boards.push(board);
      });
    }

    return new BoardIndexController();
  }
})(angular);