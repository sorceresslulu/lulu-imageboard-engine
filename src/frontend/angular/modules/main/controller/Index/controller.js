(function(angular) {
  angular
    .module('main')
    .controller('MainIndexController', factory)
  ;

  function factory() {
    function MainIndexController() {
    }

    return new MainIndexController();
  }
})(angular);