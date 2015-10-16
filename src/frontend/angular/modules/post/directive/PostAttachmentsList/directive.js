(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPostAttachmentsList', factory)
  ;

  factory.$inject = [];

  function factory() {
    PostAttachmentsList.$inject = ['$scope'];

    function PostAttachmentsList($scope) {
      this.attachment = $scope.attachment;
    }

    return {
      replace: true,
      restrict: 'E',
      controller: PostAttachmentsList,
      templateUrl: 'modules/post/directive/PostAttachmentsList/template.html',
      scope: {
        'attachments': '='
      }
    };

  }
})(angular);