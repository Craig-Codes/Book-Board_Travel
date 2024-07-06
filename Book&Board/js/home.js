// Array of background image URLs
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

  // Set the background image of the body or specific element
  document.documentElement.style.backgroundImage = imageUrl;
}

// Initial call to rotate background on page load
rotateBackground();

// Set interval to rotate background every minute (60 seconds)
setInterval(rotateBackground, 60000); // 60000 milliseconds = 1 minute
