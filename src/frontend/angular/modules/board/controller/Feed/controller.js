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
      this.boardUrl = $stateParams.boardUrl;

      $scope.ready = false;

      (function loadBoardFeed(controller, scope) {
        controller.board = BoardService.getBoardByUrl(controller.boardUrl);
        controller.boardFeed = BoardFeed.create(controller.board);
        controller.boardFeed.fetch();

        (function setupScope() {
          scope.board = controller.board;
          scope.boardFeed = controller.boardFeed;
          scope.ready = true;
        })();
      })(this, $scope);
    }

    return new BoardFeedController();
  }
})(angular);