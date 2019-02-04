(function(){
  const year = document.querySelector(`#current-year`);

  if (!year) return false;

  year.textContent = new Date().getFullYear();
})();
