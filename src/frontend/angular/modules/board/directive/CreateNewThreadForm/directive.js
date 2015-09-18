(function(angular) {
  angular
    .module('lulu-imageboard')
    .directive('liCreateNewThreadForm', factory)
  ;

  function factory() {
    function CreateNewThreadForm() {

    }

    CreateNewThreadForm.prototype.reset = reset;

    return {
      replace: true,
      restrict: 'E',
      controller: CreateNewThreadForm,
      scope: {
        boardId: '='
      }
    };

    function reset() {

    }
  }
})(angular);