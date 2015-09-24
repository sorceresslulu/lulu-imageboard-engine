(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('BoardFeedRestResource', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    return $resource('/backend/rest/board-feed/:boardId', { boardId: '@id' })
  }
})(angular);