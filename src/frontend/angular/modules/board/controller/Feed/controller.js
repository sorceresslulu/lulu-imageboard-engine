(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('BoardFeedController', factory)
  ;

  factory.$inject = [
    '$scope',
    '$stateParams',
    'BoardService',
    'BoardFeed'
  ];

  function factory($scope, $stateParams, BoardService, BoardFeed) {
    function BoardFeedController() {
      this.scope = $scope;
      this.boardURL = $stateParams.boardURL;

      $scope.ready = false;

      (function loadBoardFeed(controller, scope) {
        BoardService.promise.then(function(data) {
          controller.board = BoardService.getBoardByURL(controller.boardURL);
          controller.boardFeed = BoardFeed.create(controller.board);
          controller.boardFeed.fetch();

          (function setupScope() {
            scope.board = controller.board;
            scope.boardFeed = controller.boardFeed;
            scope.ready = true;
          })();

          return data;
        })
      })(this, $scope);
    }

    return new BoardFeedController();
  }
})(angular);