(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liCreateThreadForm', factory)
  ;

  function factory() {
    CreateThreadForm.$inject = ['$scope'];

    function CreateThreadForm($scope) {
      this.formData = {

      };

      (function setupScope(directive) {
        $scope.submit = directive.submit();
        $scope.formData = directive.formData;
      })(this);
    }

    CreateThreadForm.prototype.submit = submit;

    return {
      replace: true,
      restrict: 'E',
      controller: CreateThreadForm,
      templateUrl: 'modules/thread/form/CreateThreadForm'
    };

    function submit($event) {
      $event.preventDefault();
    }
  }
})(angular);