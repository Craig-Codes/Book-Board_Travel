// This file controls the offer image carousel
// This enables users to cycle though an offers image array dyanamically

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides((slideIndex = n));
}

// this function controls which image is shown, replacing the current image with the number provided
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  // If the slide number is greater than the total number of images
  if (n > slides.length) {
    // update the slideIndex variable, moving it back to 1
    slideIndex = 1;
  }
  // If the slide number is less than 1, we want to loop back to the end
  if (n < 1) {
    // Update the slideIndex variable, setting it to the last number possible
    slideIndex = slides.length;
  }
  // hide each image
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  // remove the active class from each image number market dot
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  // Set the correct image and marker dot for that image
  slides[slideIndex - 1].style.display = "block"; // show the image
  dots[slideIndex - 1].className += " active"; // highlight the marker dot by adding the active class
}
