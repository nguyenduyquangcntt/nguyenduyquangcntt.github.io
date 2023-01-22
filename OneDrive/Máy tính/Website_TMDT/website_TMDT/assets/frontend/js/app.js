const carouselSlider = document.querySelector(".carousel-slide");
    const carouselSliderImg = document.querySelectorAll(".carousel-slide img");

    const btnPrev = document.querySelector("#prev");
    const btnNext = document.querySelector("#next");

    let counter = 1;
    const size = carouselSliderImg[0].clientWidth;
    carouselSlider.style.transform = "translateX(" + -size * counter + "px)";

    btnNext.addEventListener("click", () => {
      if (counter >= carouselSliderImg.length - 1) return(counter = 1);
      carouselSlider.style.transform = "transform, 0.4s ease-in-out";
      counter++;
      carouselSlider.style.transform = "translateX(" + -size * counter + "px)";
    });

    btnPrev.addEventListener("click", () => {
      if (counter <= 0) return;
      carouselSlider.style.transform = "transform, 0.4s ease-in-out";
      counter--;
      carouselSlider.style.transform = "translateX(" + -size * counter + "px)";
    });

    // carouselSlider.addEventListener("transitionend", () => {
    //   if (carouselSliderImg[counter].id === "lastClone") {
    //     carouselSlider.style.transition = "none";
    //     counter = carouselSliderImg.length - 2;
    //     carouselSlider.style.transform = "translateX(" + -size * counter + "px)";
    //   }
    //   if (carouselSliderImg[counter].id === "firstClone") {
    //     carouselSlider.style.transition = "none";
    //     counter = carouselSliderImg.length - counter;
    //     carouselSlider.style.transform = "translateX(" + -size * counter + "px)";
    //   }
    // });