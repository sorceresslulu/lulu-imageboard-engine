(function(angular) {
  "use strict";

  angular
    .module('main')
    .controller('MainNotFoundController', factory)
  ;

  function factory() {
    function MainNotFoundController() {
      alert('???');
    }

    return new MainNotFoundController();
  }
})(angular);