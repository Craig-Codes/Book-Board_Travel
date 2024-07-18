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

// function does basic front end email validation
// More advanced checking is conducted using php server side
const validateEmail = (email) => {
  // Define the regular expression for validating an email
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(email); // test against the regex
};

document.getElementById("register-form").addEventListener("submit", (event) => {
  let isValid = true; // Boolean controls if error is displayed

  const usernameInput = document.getElementById("register-username"); // Get the username input
  const usernameError = document.getElementById("register-username-error"); // Get the username error message
  if (usernameInput.value.length < 5) {
    // Check that user input has a length greater than 5
    usernameError.style.display = "block"; // If error, show pass error message to user
    isValid = false;
  } else {
    usernameError.style.display = "none";
  }

  const passwordInput = document.getElementById("register-password"); // Get the password user input
  const passwordError = document.getElementById("password-error"); // Get the password error message
  if (passwordInput.value.length < 5) {
    // Check that user input has a length greater than 5
    passwordError.style.display = "block"; // If error, show pass error message to user
    isValid = false;
  } else {
    passwordError.style.display = "none";
  }

  const confirmPasswordInput = document.getElementById("confirm-password");
  const confirmPasswordError = document.getElementById(
    "confirm-password-error"
  );
  if (confirmPasswordInput.value !== passwordInput.value) {
    // Check to see if the password inputs match
    confirmPasswordError.style.display = "block"; // If they do not match, display error to user
    isValid = false;
  } else {
    confirmPasswordError.style.display = "none";
  }

  const emailInput = document.getElementById("email");
  const emailError = document.getElementById("email-error");
  if (!validateEmail(emailInput.value)) {
    // check that the email is a valis email address
    emailError.style.display = "block";
    isValid = false;
  } else {
    emailError.style.display = "none";
  }

  if (!isValid) {
    event.preventDefault(); // Prevent form submission if validation fails
  } else {
    this.submit(); // Submit validated form
  }
});
