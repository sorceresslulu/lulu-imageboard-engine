(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPostAttachmentImage', factory)
  ;

  factory.$inject = [];

  function factory() {
    PostAttachmentImage.$inject = ['$scope'];

    function PostAttachmentImage($scope) {
      this.attachment = $scope.attachment;

      $scope.preview = this.getThumbnailURL();
      $scope.fullLink = this.getAttachmentURL();
    }

    PostAttachmentImage.prototype.getAttachmentURL = getAttachmentURL;
    PostAttachmentImage.prototype.getThumbnailURL = getThumbnailURL;

    return {
      replace: true,
      restrict: 'E',
      controller: PostAttachmentImage,
      templateUrl: 'modules/post/directive/PostAttachmentsList/type/image/template.html',
      scope: {
        'attachment': '='
      }
    };

    function getThumbnailURL() {
      return this.attachment.thumbnail;
    }

    function getAttachmentURL() {
      return this.attachment.url;
    }
  }
})(angular);