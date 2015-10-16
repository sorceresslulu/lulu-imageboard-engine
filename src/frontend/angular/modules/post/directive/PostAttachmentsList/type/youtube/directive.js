(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPostAttachmentYoutube', factory)
  ;

  factory.$inject = [];

  function factory() {
    PostAttachmentYoutube.$inject = ['$scope', '$sce', 'LIConfiguration'];

    function PostAttachmentYoutube($scope, $sce, LIConfiguration) {
      this.attachment = $scope.attachment;
      this.videoID = $scope.attachment.v;

      $scope.player = LIConfiguration.post.attachment.youtube.player;
      $scope.videoURL = $sce.trustAsResourceUrl(this.getVideoURL());
    }

    PostAttachmentYoutube.prototype.getVideoURL = getVideoURL;

    return {
      replace: true,
      restrict: 'E',
      controller: PostAttachmentYoutube,
      templateUrl: 'modules/post/directive/PostAttachmentsList/type/youtube/template.html',
      scope: {
        'attachment': '='
      }
    };

    function getVideoURL() {
      return "http://www.youtube.com/embed/" + this.videoID;
    }
  }
})(angular);