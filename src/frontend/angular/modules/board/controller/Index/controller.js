(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .controller('BoardIndexController', controller)
  ;

  controller.$inject = ['$scope', 'BoardService'];

  function controller($scope, BoardService) {
    $scope.boards = [];

    BoardService.getAllBoards().forEach(function(board) {
      $scope.boards.push(board);
    });
  }
})(angular);