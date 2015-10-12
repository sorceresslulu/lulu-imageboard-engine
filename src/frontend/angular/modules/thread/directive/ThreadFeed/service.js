(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('ThreadFeedFactory', factory)
  ;

  function factory() {
    function ThreadFeed(threadId) {
      this.threadId = threadId;
      this.posts = [];
    }

    ThreadFeed.prototype.getPosts = getPosts;
    ThreadFeed.prototype.setPosts = setPosts;
    ThreadFeed.prototype.pushPost = pushPost;
    ThreadFeed.prototype.reset = reset;

    return {
      create: function createInstance(threadId) {
        return new ThreadFeed(threadId);
      }
    };

    /**
     * Returns posts
     * @returns {Array}
     */
    function getPosts() {
      return this.posts;
    }

    /**
     * Set posts
     * @param posts
     */
    function setPosts(posts) {
      this.reset();

      (function(threadFeed) {
        posts.forEach(function(post) {
          threadFeed.pushPost(post);
        });
      })(this);
    }

    /**
     * Push new post to the feed
     * @param post
     */
    function pushPost(post) {
      this.posts.push(post);
    }

    /**
     * Reset ThreadFeed
     */
    function reset() {
      while(this.posts.length) {
        this.posts.pop();
      }
    }
  }
})(angular);