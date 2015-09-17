(function(angular) {
  "use strict";

  angular
    .module('board')
    .controller('BoardThreadsController', factory)
  ;

  factory.$inject = [
    '$scope',
    '$stateParams',
    'BoardService',
    'ThreadService'
  ];

  function factory($scope, $stateParams, BoardService, ThreadService) {
    function BoardThreadsController() {
      BoardService.promise.then(function() {
        $scope.board = BoardService.getBoardByURL($stateParams.boardURL);

        ThreadService.getThreadsByBoardId($scope.board.id).then(function(threads) {
          $scope.threads = threads;

          return threads;
        });
      });
    }

    return new BoardThreadsController();
  }
})(angular);