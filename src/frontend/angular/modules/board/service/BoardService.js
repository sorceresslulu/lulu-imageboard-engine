(function(angular, sprintf) {
  "use strict";

  angular
    .module('board')
    .factory('BoardService', factory)
  ;

  factory.$inject = ['BoardRestService'];

  function factory(BoardRestService) {
    function BoardService() {
      this.promise = null;
      this.boards = [];
    }

    BoardService.prototype.getAllBoards = getAllBoards;
    BoardService.prototype.getBoardById = getBoardById;
    BoardService.prototype.fetchBoards = fetchBoards;

    return {
      /**
       * Create and returns BoardService instance
       * @returns {BoardService}
       */
      create: function createInstance() {
        return new BoardService();
      }
    };

    /**
     * Returns all boards
     * @returns {Array}
     */
    function getAllBoards() {
      return this.boards;
    }

    /**
     * Fetch boards
     * @returns {HttpPromise}
     */
    function fetchBoards() {
      var service = this;

      return this.promise = BoardRestService.getAll().then(function(response) {
        angular.forEach(response.data, function(board) {
          service.boards.push(board);
        });

        return service.boards;
      });
    }

    /**
     * Returns board by Id
     * @param id
     * @returns {*}
     */
    function getBoardById(id) {
      for(var n in this.boards) {
        if(this.boards.hasOwnProperty(n)) {
          if(this.boards[n].id === id) {
            return this.boards[n];
          }
        }
      }

      throw new Error(sprintf("Board with ID %(id)s not found", {
        id: id
      }));
    }
  }
})(angular, sprintf);