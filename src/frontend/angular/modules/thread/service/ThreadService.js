(function(angular) {
  angular
    .module('lulu-imageboard')
    .factory('ThreadService', factory)
  ;

  factory.$inject = ['ThreadRestResource'];

  function factory(ThreadRestResource) {
    function ThreadService() {
    }

    ThreadService.prototype.getThreadFeed = getThreadFeed;
    ThreadService.prototype.getThreadsByBoardId = getThreadsByBoardId;

    return new ThreadService();

    /**
     * Returns threads by board Id
     * @param boardId
     * @returns promise
     */
    function getThreadsByBoardId(boardId /* TODO:: limit, offset */) {
      return ThreadRestResource.byBoard.query({
        'boardId': boardId
      }).$promise;
    }

    /**
     * Returns thread feed
     * @param threadId
     * @returns promise
     */
    function getThreadFeed(threadId) {
      return ThreadRestResource.feed.query({ 'threadId': threadId }).$promise;
    }
  }
})(angular);