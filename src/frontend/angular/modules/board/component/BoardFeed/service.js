(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('BoardFeed', factory)
  ;

  factory.$inject = [
    'BoardFeedRestResource',
    'ThreadService'
  ];

  function factory(BoardFeedRestResource, /* TODO:: remove this temp solution */ ThreadService) {
    function BoardFeed(board) {
      this.board = board;
      this.threads = [];
    }

    BoardFeed.prototype.fetch = fetch;
    BoardFeed.prototype.setup = setup;
    BoardFeed.prototype.reset = reset;
    BoardFeed.prototype.pushThread = pushThread;
    BoardFeed.prototype.getThreads = getThreads;

    return {
      create: function createInstance(board) {
        return new BoardFeed(board);
      }
    };

    /**
     * Fetch board feed
     * @param options
     */
    function fetch(options) {
      var boardFeedService = this;

      console.log(this.board);

      ThreadService.getThreadsByBoardId(this.board.sId).then(function(threads) {
        boardFeedService.setup({
          threads: threads
        });

        return threads;
      });

      /* BoardFeedRestResource.query({ boardId: this.board.id }, function(feedData) {
        boardFeedService.threads = feedData.threads;
      }); TODO:: uncomment this */
    }

    /**
     * Setup BoardFeed
     * @param BoardFeedData
     */
    function setup(BoardFeedData) {
      this.reset();

      (function setupThreads(boardFeed) {
        BoardFeedData.threads.forEach(function(thread) {
          boardFeed.pushThread(thread);
        });
      })(this);
    }

    /**
     * Reset BoardFeed
     */
    function reset() {
      while(this.threads.length > 0) {
        this.threads.pop();
      }
    }

    /**
     * Push a thread to the feed
     * @param thread
     */
    function pushThread(thread) {
      this.threads.push(thread);
    }

    /**
     * Returns threads from feed
     * @returns {Array|*}
     */
    function getThreads() {
      return this.threads;
    }
  }
})(angular);