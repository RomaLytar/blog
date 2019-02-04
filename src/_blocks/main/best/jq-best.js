
(function() {
  let timer;
  class InnitMainPageBestArticleSlider  {
    constructor(item) {
      this.item = item;
      this.slider = this.item.querySelector(`[data-best-article-slider]`)
      this.sliderItemLength = this.slider.querySelectorAll(`[data-slider-item]`).length;
      this.slickSliderActive = this.slider.getAttribute(`data-slick-active`);

      this.innitSlick();
      this.setSumSlides(this.sliderItemLength);
      this.changeSlide();
    }

    setSumSlides(sum) {
      document.querySelector(`[data-sum]`).innerHTML = sum;
    }

    setCounterSlides(slide) {
      document.querySelector(`[data-counter]`).innerHTML = slide;
    }

    changeSlide(){
      $(this.slider).on('afterChange', (event, slick, currentSlide) => {
        let currentCounter = document.querySelector(`[data-counter]`).textContent;
        if (currentSlide + 1 == currentCounter) return false;

        this.setCounterSlides(currentSlide+1);
      });
    }

    innitSlick() {
      if(this.slickSliderActive) return false;
      $(this.slider).slick({
            dots: false,
            autoplay: true,
            arrows: true,
            slidesToShow: 1,
            infinite: false,
            slidesToScroll: 1,
            autoplay: false,
            prevArrow: $("#best-slider-btn-prev"),
            nextArrow: $("#best-slider-btn-next"),
            // responsive: [
            //   {
            //     breakpoint: 768,
            //     settings: {
            //       centerMode: true,
            //       slidesToShow: 1,
            //       centerPadding: `80px`,
            //     }
            //   },
            //   {
            //     breakpoint: 481,
            //       settings: {
            //       centerMode: false,
            //       slidesToShow: 1,
            //     }
            //   }
            // ]
          });

      this.slider.setAttribute(`data-slick-active`, true);
      calcHeightSlick($(this.slider));

    }

  }

  window.addEventListener(`load`, () => {
    let bestArticlesBlock = document.querySelector(`[data-best-articles]`);
    if (!bestArticlesBlock) return false;
    new InnitMainPageBestArticleSlider(bestArticlesBlock);
  });

  window.addEventListener(`resize`, () => {
    let slider = document.querySelector(`[data-best-articles]`);
    if(!slider) return false;
    if(!slider.hasAttribute(`data-slick-active`)) return false;
    clearTimeout(timer);

    timer = setTimeout(calcHeightSlick($(slider)), 3000)
  });
})();
