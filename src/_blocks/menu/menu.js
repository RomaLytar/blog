(function() {
  class ToggleSubMunu  {
    constructor(item) {
      this.item = item;
      this.list = item.querySelector([`data-toggle-list`]);
      this.link = item.querySelector(`[data-toggle-link]`);
      this.subMenuOpened = false;
      this.item.addEventListener("click", this.subMenuToggle.bind(this));
      this.a = this.checkClick.bind(this);
    }

    subMenuToggle(e) {
      let target = e.target.closest(`[data-toggle-link]`);
      // console.log(target);
      if(target) {
      e.preventDefault();
        target.dataset.submenuActive == `true` ? this.subMenuClose(target) : this.subMenuOpen(target);
      }
    }

    checkClick(e) {
      let target = e.target.closest(`[data-toggle]`);
      if(!target && this.subMenuOpened == true) {
        this.subMenuClose();
        window.removeEventListener("click", this.a);
      }
    }

    subMenuOpen() {
      this.link.dataset.submenuActive = true;
      this.subMenuOpened = true;
      window.addEventListener("click", this.a);
    };

    subMenuClose() {
      this.link.removeAttribute(`data-submenu-active`);
      this.subMenuOpened = false;
    };
  }

  window.addEventListener(`load`, () => {
    [...document.querySelectorAll(`[data-toggle]`)].forEach(item => new ToggleSubMunu(item))
  });
})();
