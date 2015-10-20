(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('BoardFeedController', controller)
  ;

  controller.$inject = [
    '$scope',
    '$stateParams',
    'SpinnerService',
    'BoardService',
    'BoardFeed'
  ];

  function controller($scope, $stateParams, SpinnerService, BoardService, BoardFeed) {
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
})(angular);