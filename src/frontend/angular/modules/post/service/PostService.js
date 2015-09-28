(function(angular) {
  angular
    .module('lulu-imageboard')
    .factory('PostService', factory)
  ;

  factory.$inject = ['PostRestResource'];

  function factory(PostRestResource) {
    function PostService() {
    }

    PostService.prototype.getPostById = getPostById;
    PostService.prototype.getPostsByThreadId = getPostsByThreadId;

    return new PostService();

    /**
     * Get post by Id
     * @param postId
     * @returns HttpPromise
     */
    function getPostById(postId) {
      return PostRestResource.index.get(postId).$promise;
    }

    /**
     * Get posts by thread Id
     * @param threadId
     * @returns {*|Function|promise|n|m}
     */
    function getPostsByThreadId(threadId) {
      return PostRestResource.byThreadId.query({ 'threadId': threadId }).$promise;
    }
  }
})(angular);