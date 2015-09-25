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
     * @param options
     */
    function getThreadsByBoardId(boardId, options) {
      return ThreadRestResource.byBoard.query(angular.extend({
        'boardId': boardId
      }, options)).$promise;
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