(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('ThreadViewThreadController', factory)
  ;

  factory.$inject = ['$scope', '$stateParams', 'ThreadService', 'ThreadFeedFactory'];

  function factory($scope, $stateParams, ThreadService, ThreadFeedFactory) {
    function ThreadViewThreadController() {
      $scope.ready = false;
      $scope.threadId = $stateParams.threadId;
      $scope.threadFeed = ThreadFeedFactory.create();

      ThreadService.getThreadFeed($scope.threadId).then(function(threadDTO) {
        $scope.ready = true;
        $scope.threadFeed.setPosts(threadDTO.posts);

        return threadDTO;
      });
    }

    return new ThreadViewThreadController();
  }
})(angular);