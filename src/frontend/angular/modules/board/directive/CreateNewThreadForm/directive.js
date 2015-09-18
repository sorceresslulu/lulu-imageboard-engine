(function(angular) {
  angular
    .module('lulu-imageboard')
    .directive('liCreateNewThreadForm', factory)
  ;

  function factory() {
    function CreateNewThreadForm() {

    }

    return {
      replace: true,
      restrict: 'E',
      controller: CreateNewThreadForm,
      scope: {
        boardId: '='
      }
    }
  }
})(angular);