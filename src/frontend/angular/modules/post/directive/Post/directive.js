(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPost', factory)
  ;

  function factory() {
    function liPost($scope) {
    }

    liPost.$inject = ['$scope'];

    return {
      replace: true,
      restrict: 'E',
      controller: liPost,
      templateUrl: 'modules/post/directive/Post/template.html',
      scope: {
        post: '='
      }
    };
  }
})(angular);