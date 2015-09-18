(function(angular) {
  angular
    .module('thread')
    .directive('createNewThreadForm', factory)
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