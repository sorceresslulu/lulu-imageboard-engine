(function(angular) {
  "use strict";

  angular
    .module('board')
    .factory('BoardRestService', factory)
  ;

  factory.$inject = ['$http'];

  function factory($http) {
    function BoardRestService() {
    }

    BoardRestService.prototype.getAll = getAll;
    BoardRestService.prototype.getById = getById;

    return new BoardRestService();

    /**
     * Fetch all boards
     * @returns {HttpPromise}
     */
    function getAll() {
      return $http.get('/backend/rest/board/');
    }

    /**
     * Fetch boards by Id
     * @param id
     * @returns {HttpPromise}
     */
    function getById(id) {
      return $http.get('/backend/rest/board/:id', {
        id: id
      });
    }
  }
})(angular);