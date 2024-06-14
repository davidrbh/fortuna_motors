/**
 * Validates that only numbers are entered.
 *
 * @param {Event} e - The key event.
 * @returns {boolean} - Returns true if the input is a valid number.
 */
function controlTag(e) {
  const tecla = e.key;
  return /[0-9\s]/.test(tecla);
}

/**
 * Validates that only letters are entered.
 *
 * @param {string} txtString - The input string.
 * @returns {boolean} - Returns true if the input contains only letters.
 */
function testText(txtString) {
  const stringText = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
  return stringText.test(txtString);
}

/**
 * Validates that only integers are entered.
 *
 * @param {string} intCant - The input string representing an integer.
 * @returns {boolean} - Returns true if the input is a valid integer.
 */
function testInt(intCant) {
  const intCant_ = /^[0-9]+$/;
  return intCant_.test(intCant);
}

/**
 * Validates that a complete email address is entered.
 *
 * @param {string} email - The email address.
 * @returns {boolean} - Returns true if the email address is valid.
 */
function fntEmailValidate(email) {
  const stringEmail =
    /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return stringEmail.test(email);
}

/**
 * Sets up event listeners for text validation.
 */
function fntValidText() {
  const validText = document.querySelectorAll(".validText");
  validText.forEach(function (input) {
    input.addEventListener("input", function () {
      const inputValue = this.value;
      this.classList.toggle("is-invalid", !testText(inputValue));
    });
  });
}

/**
 * Sets up event listeners for number validation.
 */
function fntValidNumber() {
  const validNumber = document.querySelectorAll(".validNumber");
  validNumber.forEach(function (input) {
    input.addEventListener("input", function () {
      const inputValue = this.value;
      this.classList.toggle("is-invalid", !testInt(inputValue));
    });
  });
}

/**
 * Sets up event listeners for email validation.
 */
function fntValidEmail() {
  const validEmail = document.querySelectorAll(".validEmail");
  validEmail.forEach(function (input) {
    input.addEventListener("input", function () {
      const inputValue = this.value;
      this.classList.toggle("is-invalid", !fntEmailValidate(inputValue));
    });
  });
}

// Initialize validation functions when the page loads
window.addEventListener(
  "load",
  function () {
    fntValidText();
    fntValidEmail();
    fntValidNumber();
  },
  false
);
