(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('ThreadReplyService', factory)
  ;

  factory.$inject = ['ThreadReplyRestResource'];

  function factory(ReplyResource) {
    function ThreadReplyService() {
    }

    ThreadReplyService.prototype.reply = reply;

    return new ThreadReplyService();

    /**
     * Reply
     * @param threadId
     * @param formData
     * @returns {promise}
     */
    function reply(threadId, formData) {
      console.log('reply', threadId, formData);
      return ReplyResource.save({ threadId: threadId }, formData).$promise;
    }
  }
})(angular);