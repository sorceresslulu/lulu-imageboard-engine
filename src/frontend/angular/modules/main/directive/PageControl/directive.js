(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .directive('liPageControl', factory)
  ;

  factory.$inject = [];

  function factory() {
    PageControl.$inject = ['$scope'];

    function PageControl($scope) {
      var controller = this;

      $scope.totalPages = $scope.pageControl.maxPages;
      $scope.pages = [];

      $scope.$watch('totalPages', function(oldValue, newValue) {
        controller.updateRange(oldValue);
      });

      this.scope = $scope;
      this.pageControl = $scope.pageControl;
    }

    PageControl.prototype.updateRange = updateRange;

    return {
      replace: true,
      restrict: 'E',
      controller: PageControl,
      templateUrl: 'modules/main/directive/PageControl/template.html',
      scope: {
        'pageControl': '='
      }
    };

    function updateRange(numPages) {
      while(this.scope.pages.length) {
        this.scope.pages.pop();
      }

      for(var n = 0; n < parseInt(numPages); n++) {
        this.scope.pages.push({
          num: n,
          isActive: this.pageControl.getCurrentPage() === n
        });
      }
    }
  }
})(angular);
