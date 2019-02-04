(function() {
  class SelectPopular  {
    constructor(item) {
      this.item = item;
      this.btns = item.querySelector(`[data-popular-btns]`);
      this.btns.addEventListener("click", (e) => {
        let target = e.target.closest(`[data-popular-btn]`);
        if (!target) return false;

        this.clickBtn(target);
      });
    }

    clickBtn(target) {
      this.clearClassActive();
      this.addClassActive(target);
    }

    clearClassActive() {
      [...this.item.querySelectorAll(`[data-popular-btn]`)].forEach((item) => item.classList.remove(`active`));
      [...this.item.querySelectorAll(`[data-popular-block]`)].forEach((item) => item.classList.remove(`active`));
    }

    addClassActive(target) {
      target.classList.add(`active`);
      let btn = target.getAttribute(`data-popular-btn`);
      this.item.querySelector(`[data-popular-block=\"${btn}\"]`).classList.add(`active`);
    }
  }

  window.addEventListener(`load`, () => {
    const popular = document.querySelector(`[data-popular]`)
    if(!popular) return false;
    new SelectPopular(popular);
  });
})();
