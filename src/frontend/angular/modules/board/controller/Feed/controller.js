(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('BoardFeedController', factory)
  ;

  factory.$inject = [
    '$scope',
    '$stateParams',
    'SpinnerService',
    'BoardService',
    'BoardFeed'
  ];

  function factory($scope, $stateParams, SpinnerService, BoardService, BoardFeed) {
    function BoardFeedController() {
      this.scope = $scope;
      this.boardUrl = $stateParams.boardUrl;

      $scope.ready = SpinnerService.enable();

      (function loadBoardFeed(controller, scope) {
        controller.board = BoardService.getBoardByUrl(controller.boardUrl);
        controller.boardFeed = BoardFeed.create(controller.board);
        controller.boardFeed.fetch().then(function(data) {
          (function setupScope() {
            scope.board = controller.board;
            scope.boardFeed = controller.boardFeed;
            scope.ready = SpinnerService.disable();
          })();

          return data;
        });
      })(this, $scope);
    }

    return new BoardFeedController();
  }
})(angular);