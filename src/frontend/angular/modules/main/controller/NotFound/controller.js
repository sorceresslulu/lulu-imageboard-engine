(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('MainNotFoundController', factory)
  ;

  function factory() {
    function MainNotFoundController() {
    }

    return new MainNotFoundController();
  }
})(angular);