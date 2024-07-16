//  Function uses classes to hide both tabs, the display the one selected
// This allows the single page to be both a login and register page
const openTab = (evt, elementToDisplay) => {
  // take in the event, and the selected tab button name
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
};

// By default, start on the login tab and hide the register content
document.getElementById("login-content").style.display = "flex";
document.getElementById("register-content").style.display = "none";
// Start the login tab highlighted so users know where they are
document.getElementById("login-tab").classList.add("active");

// On submit register, check that passwords match
const handleRegisterSubmit = (event) => {
  event.preventDefault(); // Stop the form from submitting until validated
  // Check passwords match,
  const password = document.getElementById("register-password").value;
  const confirmPassword = document.getElementById("confirm-password").value;
  if (password !== confirmPassword) {
    const errorBox = document.getElementById("confirm-password-error");
    errorBox.innerText = "error: passwords do not match";
  } else {
    const form = document.getElementById("register-form");
    form.submit();
  }
  // submit form
};
