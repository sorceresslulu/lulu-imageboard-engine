(function(angular) {
  "use strict";

  angular
    .module('thread')
    .controller('ThreadViewThreadController', factory)
  ;

  factory.$inject = ['$scope', '$stateParams', 'PostService'];

  function factory($scope, $stateParams, PostService) {
    function ThreadViewThreadController() {
      $scope.threadId = $stateParams.threadId;
    }

    return new ThreadViewThreadController();
  }
})(angular);