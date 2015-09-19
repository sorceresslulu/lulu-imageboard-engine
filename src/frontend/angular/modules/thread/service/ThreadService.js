(function(angular) {
  angular
    .module('lulu-imageboard')
    .factory('ThreadService', factory)
  ;

  factory.$inject = ['ThreadRestResource'];

  function factory(ThreadRestResource) {
    function ThreadService() {
    }

    ThreadService.prototype.createNewThread = createNewThread;
    ThreadService.prototype.getThreadFeed = getThreadFeed;
    ThreadService.prototype.getThreadsByBoardId = getThreadsByBoardId;

    return new ThreadService();

    /**
     * Create new thread
     * @param boardId
     * @param post
     * @returns {*|Function|promise|n}
     */
    function createNewThread(boardId, post) {
      return ThreadRestResource.create.save({ 'boardId': boardId }, {
        post: post
      }).$promise;
    }

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