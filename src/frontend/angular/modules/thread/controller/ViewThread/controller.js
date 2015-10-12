(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('ThreadViewThreadController', factory)
  ;

  factory.$inject = [
    '$scope',
    '$stateParams',
    'SpinnerService',
    'BoardService',
    'ThreadService',
    'ThreadFeedFactory'
  ];

  function factory($scope, $stateParams, SpinnerService, BoardService, ThreadService, ThreadFeedFactory) {
    function ThreadViewThreadController() {
      $scope.ready = SpinnerService.enable();
      $scope.threadId = $stateParams.threadId;
      $scope.board = BoardService.getBoardByUrl($stateParams.boardUrl);
      $scope.threadFeed = ThreadFeedFactory.create();

      ThreadService.getThreadFeed($scope.threadId).then(function(threadDTO) {
        $scope.ready = SpinnerService.disable();
        $scope.threadFeed.setPosts(threadDTO.posts);

        return threadDTO;
      });
    }

    return new ThreadViewThreadController();
  }
})(angular);