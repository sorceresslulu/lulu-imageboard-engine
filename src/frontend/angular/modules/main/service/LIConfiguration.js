(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .provider('LIConfiguration', provider)
  ;

  factory.$inject = [];

  function provider() {
    var provider = this;

    this.preloadedConfiguration = null;

    this.$get = function() {
      return factory(provider.preloadedConfiguration);
    };
  }

  function factory(preloadedConfiguration) {
    if(preloadedConfiguration === null) {
      return {};
    }else{
      return preloadedConfiguration;
    }
  }
})(angular);