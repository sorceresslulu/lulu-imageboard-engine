(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('BoardFeed', factory)
  ;

  factory.$inject = [
    'PageControlFactory',
    'ThreadService'
  ];

  function factory(PageControlFactory, ThreadService) {
    var THREADS_PER_PAGE = 3;

    function BoardFeed(board) {
      var boardFeedService = this;

      this.status = {
        ready: false
      };
      this.board = board;
      this.threads = [];
      this.pageControl = PageControlFactory.create(THREADS_PER_PAGE, function(offset, limit) {
        boardFeedService.status.ready = false;

        ThreadService.getThreadsByBoardId(boardFeedService.board.sId, {
          offset: offset,
          limit: limit
        }).then(function(queryList) {
          boardFeedService.setup({
            threads: queryList.items
          });

          boardFeedService.pageControl.setTotal(queryList.total);
          boardFeedService.status.ready = true;

          return queryList;
        });
      });
    }

    BoardFeed.prototype.fetch = fetch;
    BoardFeed.prototype.setup = setup;
    BoardFeed.prototype.reset = reset;
    BoardFeed.prototype.pushThread = pushThread;
    BoardFeed.prototype.getThreads = getThreads;
    BoardFeed.prototype.getPageControl = getPageControl;

    return {
      create: function createInstance(board) {
        return new BoardFeed(board);
      }
    };

    /**
     * Fetch board feed
     */
    function fetch() {
      this.pageControl.update();
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
      thread.link = ThreadService.getThreadLink(this.board.url, thread.id);

      this.threads.push(thread);
    }

    /**
     * Returns threads from feed
     * @returns {Array|*}
     */
    function getThreads() {
      return this.threads;
    }

    /**
     * Returns page control
     * @returns {*}
     */
    function getPageControl() {
      return this.pageControl;
    }
  }
})(angular);