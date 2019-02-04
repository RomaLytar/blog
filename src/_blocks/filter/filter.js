(function() {
  class Filter  {
    constructor(item) {
      this.item = item;
      // this.type = this.item.dataset.filterItem;
      this.list = this.item.querySelector(`[data-filter-list]`);
      this.button = this.item.querySelector(`[data-filter-name]`);
      this.button.addEventListener(`click`, (e) => {
        this.drop();
      });
    }

    drop(){
      if (this.item.hasAttribute(`data-active`)){
        this.item.removeAttribute(`data-active`);
        this.list.style = ``;
      } else {
        // if(window.innerWidth < 768){

        //   let childrenArr = [...this.item.parentNode.children];
        //   childrenArr.forEach((itm) => {
        //     if(itm.hasAttribute(`data-active`)) {
        //      itm.removeAttribute(`data-active`);
        //     }
        //   });
        // }

        const heightToPageBottom = window.innerHeight - this.button.getBoundingClientRect().top - this.button.offsetHeight;
        if (heightToPageBottom < parseInt(window.getComputedStyle(this.list).maxHeight)) {
          this.list.style.maxHeight = `${heightToPageBottom}px`;
        }
        this.item.setAttribute(`data-active`, true);
      }
    }
  }

  [...document.querySelectorAll(`[data-filter-item]`)].map((item) => {
    if (!item) return false;
      return new Filter(item);
  });
})();

