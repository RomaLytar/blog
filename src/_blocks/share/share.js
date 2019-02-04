(() => {
  const btn = document.querySelector(`[data-share-btn]`);

  if(!btn) return false;

  btn.addEventListener(`click`, function(){
    this.classList.toggle(`share__btn-active`);
  })
})();
