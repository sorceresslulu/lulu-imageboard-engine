(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liSpinner', factory)
  ;

  factory.$inject = [];

  function factory() {
    Spinner.$inject = ['$scope', 'SpinnerService'];

    function Spinner($scope, SpinnerService) {
      $scope.service = SpinnerService;
    }

    return {
      replace: true,
      restrict: 'E',
      controller: Spinner,
      templateUrl: 'modules/main/directive/Spinner/template.html'
    }
  }
})(angular);