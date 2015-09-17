(function(angular) {
  "use strict";

  angular
    .module('board')
    .factory('BoardRestService', factory)
  ;

  factory.$inject = ['$resource'];

  function factory($resource) {
    return $resource('/backend/rest/board/:boardId', { boardId: '@id' })
  }
})(angular);