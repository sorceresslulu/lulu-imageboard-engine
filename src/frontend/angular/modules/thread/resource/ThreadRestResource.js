(function(angular) {
  angular
    .module('thread')
    .factory('ThreadRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    var
      indexResource = $resource('/backend/rest/thread/:threadId', { 'threadId': '@id' }),
      byBoardResource = $resource('/backend/rest/thread/by-board/:boardId', { 'boardId': '@id' })
    ;

    return {
      index: indexResource,
      byBoard: byBoardResource
    };
  }
})(angular);