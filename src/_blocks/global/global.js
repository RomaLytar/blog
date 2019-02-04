// Add/Remove overflow
;(function(){
  let objOpenArr = [];

  window.addEventListener("bodyOverflow", (e) => {
    const open = e.detail.opened;

    if (open) {

      document.body.classList.add("body-popup");
    } else {
      document.body.classList.remove("body-popup");
    }
  });
})();
