(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPostForm', factory)
  ;

  function factory() {
    function LiPostForm() {
    }

    return {
      replace: true,
      restrict: 'E',
      controller: LiPostForm,
      templateUrl: 'modules/post/form/PostForm/template.html',
      scope: {
        postFormService: '='
      }
    };
  }
})(angular);