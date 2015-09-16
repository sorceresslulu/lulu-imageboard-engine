(function(angular) {
  "use strict";

  angular
    .module('main')
    .controller('MainNotFoundController', factory)
  ;

  function factory() {
    function MainNotFoundController() {
    }

    return new MainNotFoundController();
  }
})(angular);