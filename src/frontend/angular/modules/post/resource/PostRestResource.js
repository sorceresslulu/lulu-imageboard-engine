(function(angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('PostRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    var
      indexResource = $resource('/backend/rest/post/:postId', { 'postId': '@id' }),
      byIdsResource = $resource('/backend/rest/post/by-ids/:postIds', { 'postIds': '@id' }),
      byThreadIdResource =  $resource('/backend/rest/post/by-thread/:threadId', { 'threadId': '@id' })
    ;

    return {
      index: indexResource,
      byIds: byIdsResource,
      byThreadId: byThreadIdResource
    };
  }
})(angular);