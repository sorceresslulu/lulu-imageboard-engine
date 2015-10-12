(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('SpinnerService', factory)
  ;

  factory.$inject = [];

  function factory() {
    function SpinnerService() {
      this.spinner = {
        enabled: false
      };
    }

    SpinnerService.prototype.enable = enable;
    SpinnerService.prototype.disable = disable;
    SpinnerService.prototype.isEnabled = isEnabled;

    return new SpinnerService();

    /**
     * Enable spinner
     */
    function enable() {
      return !(this.spinner.enabled = true);
    }

    /**
     * Disable spinner
     */
    function disable() {
      return !(this.spinner.enabled = false);
    }

    /**
     * Returns true if spinner is enabled
     * @returns {*}
     */
    function isEnabled() {
      return this.spinner.enabled;
    }
  }
})(angular);