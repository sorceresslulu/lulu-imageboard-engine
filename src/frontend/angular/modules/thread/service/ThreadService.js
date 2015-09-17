(function(angular) {
  angular
    .module('thread')
    .factory('ThreadService', factory)
  ;

  factory.$inject = ['ThreadRestResource'];

  function factory(ThreadRestResource) {
    function ThreadService() {
    }

    ThreadService.prototype.getThreadsByBoardId = getThreadsByBoardId;

    return new ThreadService();

    /**
     * Returns threads by board Id
     * @param boardId
     * @returns {*|Function|promise|n}
     */
    function getThreadsByBoardId(boardId /* TODO:: limit, offset */) {
      return ThreadRestResource.byBoard.query({
        'boardId': boardId
      }).$promise;
    }
  }
})(angular);