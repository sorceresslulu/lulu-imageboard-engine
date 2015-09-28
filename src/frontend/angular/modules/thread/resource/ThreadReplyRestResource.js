(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('ThreadReplyRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    var url = '/backend/rest/thread/:threadId/reply';
    var params = { 'threadId': '@id' };
    var definitions = {
      'save': { method: 'POST' }
    };

    return $resource(url, params, definitions);
  }
})(angular);