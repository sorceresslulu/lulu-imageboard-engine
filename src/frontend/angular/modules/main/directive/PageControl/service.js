(function (angular) {
  "use strict";

  angular
    .module('lulu-imageboard')
    .factory('PageControlFactory', factory)
  ;

  factory.$inject = [];

  function factory() {
    function PageControlFactory(itemsPerPage, loadHandler) {
      this.total = 0;
      this.maxPages = 0;
      this.currentPage = 0;
      this.itemsPerPage = itemsPerPage;
      this.loadHandler = loadHandler;
    }

    PageControlFactory.prototype.setTotal = setTotal;
    PageControlFactory.prototype.getTotal = getTotal;
    PageControlFactory.prototype.getCurrentPage = getCurrentPage;
    PageControlFactory.prototype.canGoNextPage = canGoNextPage;
    PageControlFactory.prototype.maxPages = maxPages;
    PageControlFactory.prototype.getMaxPages = getMaxPages;
    PageControlFactory.prototype.canGoPreviousPage = canGoPreviousPage;
    PageControlFactory.prototype.goNextPage = goNextPage;
    PageControlFactory.prototype.goPreviousPage = goPreviousPage;
    PageControlFactory.prototype.goPage = goPage;
    PageControlFactory.prototype.update = update;

    return {
      create: function createInstance(itemsPerPage, loadHandler) {
        return new PageControlFactory(itemsPerPage, loadHandler);
      }
    };

    function setTotal(total) {
      this.total = total;
      this.maxPages = Math.ceil(this.total / this.itemsPerPage);
    }

    function getTotal() {
      return this.total;
    }

    function getCurrentPage() {
      return this.currentPage;
    }

    function getMaxPages() {
      return this.maxPages;
    }

    function canGoPreviousPage() {
      return this.page > 0;
    }

    function canGoNextPage() {
      return this.page < this.getMaxPages();
    }

    function goNextPage() {
      if(this.canGoNextPage()) {
        this.page += 1;
        this.update();
      }
    }

    function goPreviousPage() {
      if(this.page > 0) {
        this.page -= 1;
        this.update();
      }
    }

    function goPage(page) {
      if(page >= 0 && page <= this.maxPages) {
        this.page = page;
        this.update();
      }
    }

    function update() {
      var offset = this.page * this.itemsPerPage;
      var limit = this.itemsPerPage;

      return this.loadHandler(offset, limit);
    }

    function maxPages() {
      return this.maxPages;
    }
  }
})(angular);