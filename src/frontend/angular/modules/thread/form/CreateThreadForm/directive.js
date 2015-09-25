(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liCreateThreadForm', factory)
  ;

  factory.$inject = ['PostFormService', 'ThreadService'];

  function factory(PostFormService, ThreadService) {
    CreateThreadForm.$inject = ['$scope'];

    function CreateThreadForm($scope) {
      this.boardId = $scope.boardId;
      this.boardFeed = $scope.boardFeed;
      this.postFormService = PostFormService.create();

      (function setupScope(directive) {
        $scope.submit = directive.submit;
        $scope.postFormService = directive.postFormService;
      })(this);
    }

    CreateThreadForm.prototype.submit = submit;

    return {
      replace: true,
      restrict: 'E',
      controller: CreateThreadForm,
      templateUrl: 'modules/thread/form/CreateThreadForm/template.html',
      scope: {
        board: '=',
        boardFeed: '='
      }
    };

    /**
     * Submit / Create New Thread action
     * @param $event
     */
    function submit($event) {
      $event.preventDefault();

      var boardFeed = this.boardFeed;
      var promise = ThreadService.createNewThread(this.board.sId, this.postFormService.getFormData());

      promise.then(function(thread) {
        boardFeed.pushThread(thread);

        return thread;
      });
    }
  }
})(angular);