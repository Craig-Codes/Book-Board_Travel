//  Function uses classes to hide both tabs, the display the one selected
// This allows the single page to be both a login and register page
function openTab(evt, elementToDisplay) {
  // take in the event, and the selected tab button name
  console.log("clicked");
  // Get all elements with class="tabcontent" and hide them
  const tabcontent = document.getElementsByClassName("tab-content");
  Array.from(tabcontent).forEach((element) => {
    element.style.display = "none";
  });

  // Get all elements with class="tablinks" and remove the class "active"
  const tabLinks = document.getElementsByClassName("tab-links");
  Array.from(tabLinks).forEach((element) => {
    element.classList.remove("active");
  });

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(elementToDisplay).style.display = "flex";
  evt.currentTarget.classList.add("active");
}

// By default, start on the login tab and hide the register content
document.getElementById("login-content").style.display = "flex";
document.getElementById("register-content").style.display = "none";
// Start the login tab highlighted so users know where they are
document.getElementById("login-tab").classList.add("active");
