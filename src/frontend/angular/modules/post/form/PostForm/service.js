(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('PostFormService', factory)
  ;

  function factory() {
    function PostFormService(threadId) {
      this.threadId = threadId;
      this.formData = {
        author: '',
        email: '',
        content: ''
      }
    }

    PostFormService.prototype.getFormData = getFormData;
    PostFormService.prototype.reset = reset;

    return {
      create: function createInstance(threadId) {
        return new PostFormService(threadId);
      }
    };

    /**
     * Return formData
     * @returns {*}
     */
    function getFormData() {
      return this.formData;
    }

    /**
     * Reset form
     */
    function reset() {
      this.formData.author = '';
      this.formData.email = '';
      this.formData.content = '';
    }
  }
})(angular);