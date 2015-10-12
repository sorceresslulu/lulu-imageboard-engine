(function(angular, sprintf) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('BoardService', factory)
  ;

  factory.$inject = ['BoardRestService'];

  function factory(BoardRestService) {
    function BoardService() {
      this.promise = null;
      this.boards = [];
      this.urlMap = {};
    }

    BoardService.prototype.getAllBoards = getAllBoards;
    BoardService.prototype.getBoardById = getBoardById;
    BoardService.prototype.getBoardByUrl = getBoardByUrl;
    BoardService.prototype.fetchBoards = fetchBoards;
    BoardService.prototype._applyBoards = _applyBoards;

    return new BoardService();

    /**
     * Returns all boards
     * @returns {Array}
     */
    function getAllBoards() {
      return this.boards;
    }

    /**
     * Returns board by URL
     * @param boardURL
     * @returns {*}
     */
    function getBoardByUrl(boardURL) {
      if(this.urlMap.hasOwnProperty(boardURL)) {
        return this.urlMap[boardURL];
      }else{
        throw new Error(sprintf('Board with url %(boardURL)s not found', {
          'boardURL': boardURL
        }));
      }
    }

    /**
     * Setup boards
     * @param boards
     * @private
     */
    function _applyBoards(boards) {
      var service = this;

      angular.forEach(boards, function(board) {
        service.boards.push(board);
        service.urlMap[board.url] = board;
      });
    }

    /**
     * Fetch boards
     * @returns HttpPromise
     */
    function fetchBoards() {
      var service = this;

      return this.promise = BoardRestService.query(function(response) {
        service._applyBoards(response);

        return service.boards;
      }).$promise;
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