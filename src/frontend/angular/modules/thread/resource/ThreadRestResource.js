(function(angular) {
  angular
    .module('lulu-imageboard')
    .factory('ThreadRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    var
      indexResource = $resource('/backend/rest/thread/:threadId', { 'threadId': '@id' }),
      byBoardResource = $resource('/backend/rest/thread/by-board/:boardId', { 'boardId': '@id' }, {
        'query': { method: 'GET', isArray: false }
      }),
      feedResource = $resource('/backend/rest/thread/feed/:threadId', { 'threadId': '@id' }, {
        query: { isArray: false }
      }),
      createNewThreadResource = $resource('/backend/rest/thread/create/:boardId', { 'boardId': '@id' })
    ;

    return {
      index: indexResource,
      byBoard: byBoardResource,
      feed: feedResource,
      create: createNewThreadResource
    };
  }
})(angular);