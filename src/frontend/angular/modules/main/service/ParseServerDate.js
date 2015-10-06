(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('ParseServerDate', factory)
  ;

  factory.$inject = ['amMoment'];

  function factory(amMoment) {
    return {
      parse: function(sDate) {
        return amMoment(sDate);
      }
    }
  }
})(angular);