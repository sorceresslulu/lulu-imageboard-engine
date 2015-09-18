(function(angular) {
  angular
    .module('lulu-imageboard')
    .controller('MainIndexController', factory)
  ;

  function factory() {
    function MainIndexController() {
    }

    return new MainIndexController();
  }
})(angular);