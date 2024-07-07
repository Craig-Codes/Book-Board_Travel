// Script allows users to navigate home on button click

const homeButon = document.getElementById("home"); // get the button in the DOM

homeButon.addEventListener("click", () => {
  window.location.href = "./home.php"; // on click, navigate home
});
