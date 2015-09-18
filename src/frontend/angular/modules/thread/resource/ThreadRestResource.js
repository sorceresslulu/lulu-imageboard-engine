(function(angular) {
  angular
    .module('lulu-imageboard')
    .factory('ThreadRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    var
      indexResource = $resource('/backend/rest/thread/:threadId', { 'threadId': '@id' }),
      byBoardResource = $resource('/backend/rest/thread/by-board/:boardId', { 'boardId': '@id' }),
      feedResource = $resource('/backend/rest/thread/feed/:threadId', { 'threadId': '@id' }, {
        query: { isArray: false }
      })
    ;

    return {
      index: indexResource,
      byBoard: byBoardResource,
      feed: feedResource
    };
  }
})(angular);