(function(angular, window, document) {
  var module = angular
    .module('lulu-imageboard', [
      'angularMoment',
      'ngResource',
      'ui.router',
      'templates'
    ])
  ;

  (function bootstrap() {
    var xmlHTTP;

    if (window.XMLHttpRequest) {
      xmlHTTP = new XMLHttpRequest();
    } else {
      xmlHTTP = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlHTTP.onreadystatechange = function() {
      if (xmlHTTP.readyState == XMLHttpRequest.DONE ) {
        if(xmlHTTP.status == 200){
          angularBootstrap(JSON.parse(xmlHTTP.responseText));
        }
        else if(xmlHTTP.status == 400) {
          alert('There was an error 400')
        }
        else {
          alert('something else other than 200 was returned')
        }
      }
    };

    xmlHTTP.open("GET", "/backend/main/bootstrap/", true);
    xmlHTTP.send();
  })();

  function angularBootstrap(bootstrap) {
    module
      .config(['LIConfigurationProvider', function(LIConfigurationProvider) {
        LIConfigurationProvider.preloadedConfiguration = bootstrap.configuration;
      }])
      .run(['BoardService', function(BoardService) {
        BoardService._applyBoards(bootstrap.boards);
      }])
    ;

    angular.bootstrap(document, ['lulu-imageboard']);
  }
})(angular, window, document);