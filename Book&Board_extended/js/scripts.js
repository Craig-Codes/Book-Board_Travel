// Script adds the scrolled class to the navbar when the user scrolls the y axis 50px or more
// This allows the transparent navbar to have a background colour set, creating more contrast
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
