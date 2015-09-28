(function(angular) {
  angular
    .module('lulu-imageboard')
    .directive('liReplyForm', factory)
  ;

  factory.$inject = ['ThreadReplyService', 'PostFormService'];

  function factory(ThreadReplyService, PostFormService) {
    LiReplyForm.$inject = ['$scope'];

    function LiReplyForm($scope) {
      this.threadId = $scope.threadId;
      this.threadFeed = $scope.threadFeed;
      this.postFormService = PostFormService.create();

      (function setupScope($scope, controller) {
        $scope.postFormService = controller.postFormService;

        $scope.submit = function($event) {
          controller.submit($event);
        }
      })($scope, this);
    }

    LiReplyForm.prototype.submit = submit;

    return {
      replace: true,
      restrict: 'E',
      controller: LiReplyForm,
      templateUrl: 'modules/thread/form/ReplyForm/template.html',
      scope: {
        threadId: '=',
        threadFeed: '='
      }
    };

    /**
     * Submit form
     * (Robert Martin completely dislikes *doc like this one)
     */
    function submit($event) {
      var directive = this;

      $event.preventDefault();

      ThreadReplyService.reply(this.threadId, this.postFormService.getFormData()).then(function(data) {
        directive.threadFeed.pushPost(data);

        return data;
      });
    }
  }
})(angular);