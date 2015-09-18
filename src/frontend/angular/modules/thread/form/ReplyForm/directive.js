(function(angular) {
  angular
    .module('lulu-imageboard')
    .directive('liReplyForm', factory)
  ;

  factory.$inject = ['PostService'];

  function factory(PostService) {
    LiReplyForm.$inject = ['$scope'];

    function LiReplyForm($scope) {
      this.threadId = $scope.threadId;
      this.threadFeed = $scope.threadFeed;
      this.reset();
      this.setupScope($scope);
    }

    LiReplyForm.prototype.submit = submit;
    LiReplyForm.prototype.setupScope = setupScope;
    LiReplyForm.prototype.reset = reset;

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
     * Setup scope
     * (Robert Martin completely dislikes *doc like this one)
     */
    function setupScope($scope) {
      var controller = this;

      $scope.formData = this.formData;

      $scope.submit = function($event) {
        controller.submit($event);
      }
    }

    /**
     * Reset form
     */
    function reset() {
      this.formData = {
        threadId: this.threadId,
        author: '',
        email: '',
        content: ''
      };
    }

    /**
     * Submit form
     * (Robert Martin completely dislikes *doc like this one)
     */
    function submit($event) {
      var directive = this;

      $event.preventDefault();

      PostService.createPost(this.threadId, this.formData).then(function(data) {
        console.log(data);
        directive.threadFeed.pushPost(data);

        return data;
      });
    }
  }
})(angular);