(function() {
  class ToggleLang  {
    constructor(item) {
      this.item = item;
      this.list = item.querySelector(`[data-toggle-list]`);
      this.link = item.querySelector(`[data-toggle-link]`);
      this.langCurrent = this.item.querySelector(`[data-lang-current]`);
      this.langListOpened = false;
      this.str = "";
      this.userLang = document.querySelector(`html`).lang;
      // this.getLang();
      this.item.addEventListener("click", this.langListToggle.bind(this));
      this.a = this.checkClick.bind(this);

      this.wpLang = document.querySelector(`[data-wp-lang] select`);
      this.wpLangItems = [...this.wpLang.querySelectorAll(`option`)];
      this.wpLangItems.forEach((item) => this.getData(item));
      this.setData();
      // this.setLang(lang);

    }

    getData(el) {
      let lang = el.textContent,
          langVal = el.value,
          currentLang = false;

      if (langVal == this.userLang) {
        currentLang = true;

        // console.log(el.textContent);
        this.setLang(el.textContent);
      }
      this.str += `<li><a href="#" class="${currentLang ? "current" : ""}" data-lang-value="${langVal}">${lang}</a></li>`
    }

    setData() {
      this.list.innerHTML = this.str;
    }

    langListToggle(e) {

      let target = e.target.closest(`[data-toggle-link]`),
          targetLang = e.target.closest(`[data-toggle-list] a`);
      // console.log(target);
      e.preventDefault();
      if(target) {
        target.dataset.submenuActive == `true` ? this.langListClose() : this.langListOpen();
      }

      if (targetLang) {
        this.selectLang(targetLang);
        this.langListClose();
      }
    }

    langListOpen() {
      this.link.dataset.submenuActive = true;
      this.langListOpened = true;
      window.addEventListener("click", this.a);
    };

    langListClose() {
      this.link.removeAttribute(`data-submenu-active`);
      this.langListOpened = false;
    };

    selectLang(target) {
      this.list.querySelector(`.current`).classList.remove(`current`);
      target.classList.add(`current`);
      this.setDataToWpSelect(target.getAttribute(`data-lang-value`));
    }

    setLang(lang) {
      this.langCurrent.innerHTML = `${lang}`;
    }

    setDataToWpSelect(value) {
      this.wpLangItems.forEach((item) => {
        if(item.value == value) {
          item.selected = true;

          var evt = new Event("change", {
              bubbles: true,
              cancelable: true
            });
          this.wpLang.dispatchEvent(evt);
        };
      })
    }

    checkClick(e) {
      let target = e.target.closest(`[data-lang]`);
      if(!target && this.langListOpened == true) {
        this.langListClose();
        window.removeEventListener("click", this.a);
      }
    }


  }

  window.addEventListener(`load`, () => {
    [...document.querySelectorAll(`[data-lang]`)].forEach(item => new ToggleLang(item))
  });
})();
