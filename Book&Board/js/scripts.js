const navbar = document.querySelector(".header");

// Listen for the scroll event
window.addEventListener("scroll", () => {
  // Check if page has scrolled more than 50px
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled"); // Apply the 'scrolled' class
  } else {
    navbar.classList.remove("scrolled"); // Remove the 'scrolled' class
  }
});
