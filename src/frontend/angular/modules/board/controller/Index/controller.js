(function(angular) {
  "use strict";

  angular
    .module('board')
    .controller('BoardIndexController', factory)
  ;

  factory.$inject = ['$scope', 'BoardService'];

  function factory($scope, BoardService) {
    var boardServiceInstance = BoardService.create();
        boardServiceInstance.fetchBoards();

    function BoardIndexController() {
      $scope.ready = false;
      $scope.boards = [];

      boardServiceInstance.promise.then(function(boards) {
        boards.forEach(function(board) {
          $scope.boards.push(board);
        });

        $scope.ready = true;
      });
    }

    return new BoardIndexController();
  }
})(angular);