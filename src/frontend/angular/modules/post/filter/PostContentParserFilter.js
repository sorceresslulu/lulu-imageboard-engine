(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .filter('PostContentParser', factory)
  ;

  factory.$inject = ['$sce'];

  function factory($sce) {
    function replaceNewLinesWithBr(input) {
      return input.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    }

    function escapeHTML(input) {
      var entityMap = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': '&quot;',
        "'": '&#39;',
        "/": '&#x2F;'
      };

      return input.replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
      });
    }

    return function(input) {
      input = escapeHTML(input);
      input = replaceNewLinesWithBr(input);

      return $sce.trustAsHtml(input);
    }
  }
})(angular);