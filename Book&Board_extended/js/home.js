// Array of background image URLs - used to rotate the background image on the homepage
const images = [
  "url(../resources/balloon.webp)",
  "url(../resources/mountains.webp)",
  "url(../resources/boats.webp)",
  "url(../resources/ski.webp)",
  "url(../resources/petra.webp)",
  "url(../resources/maldives.webp)",
  "url(../resources/japan.webp)",
  "url(../resources/venice.webp",
  "url(../resources/paradise.webp)",
  "url(../resources/ankor.webp)",
  "url(../resources/santorini.webp)",
  "url(../resources/inca.webp)",
];

// Function to rotate background image
function rotateBackground() {
  // Get a random image URL from the array
  const randomIndex = Math.floor(Math.random() * images.length);
  const imageUrl = images[randomIndex];

  // Set the background image of the page
  document.documentElement.style.backgroundImage = imageUrl;
}

// Initial call to rotate background on page load
rotateBackground();

// Set interval to rotate background every minute (60 seconds)
// Rotating the image inspires users with possible destinations and adventure
setInterval(rotateBackground, 60000); // 60000 milliseconds = 1 minute

// Allow users to click on the lastest offers and go straigh to the more details screen
const allOffers = document.getElementsByClassName("offer-card"); // get all the offer cards on screen

// create an array from the HTML collection so that is can be looped over declaratively
Array.from(allOffers).forEach((offer) => {
  // We need to make sure these elements are navigatable without a mouse for WCAG 2.0 accessiblity standards
  // Ensure the element is focusable
  offer.setAttribute("tabindex", "0");
  // Add an ARIA role
  offer.setAttribute("role", "button");
  // Add an accessible label
  offer.setAttribute("aria-label", `Offer ${offer.dataset.id}`);

  const navigateToOffer = () => {
    const offerId = offer.dataset.id; // get the ID from the data attribute
    window.location.href = `./offer.php?id=${offerId}`; // navigate to offer.php with the ID as a URL parameter
  };

  offer.addEventListener("click", navigateToOffer);

  // Add keyboard event listener for Enter and Space keys
  offer.addEventListener("keydown", (event) => {
    if (event.key === "Enter" || event.key === " ") {
      event.preventDefault(); // Prevent default behavior for Space key
      navigateToOffer();
    }
  });
});
