// validates the registration form
function validateRegistration() {
  const form = document.forms["registration"];
  const requiredFields = [
    "first-name",
    "last-name",
    "email",
    "password",
    "confirm-password",
  ];

  //validate that the text fields are non-empty
  let hasEmptyField = false;
  for (const field of requiredFields) {
    if (form[field].value === "") {
      if (!form[field].parentNode.classList.contains("form-error"))
        form[field].parentNode.classList.add("form-error");
      hasEmptyField = true;
    }
  }
  //check if user consented to terms
  const consent = form["consent"].checked ? true : false;
  if (!consent && !form["consent"].parentNode.classList.contains("form-error"))
    form["consent"].parentNode.classList.add("form-error");

  // ensure passwords match
  const passwordsMatch =
    form["password"].value === form["confirm-password"].value;
  if (!passwordsMatch) {
    if (!form["password"].parentNode.classList.contains("form-error"))
      form["password"].parentNode.classList.add("form-error");
    if (!form["confirm-password"].parentNode.classList.contains("form-error"))
      form["confirm-password"].parentNode.classList.add("form-error");
  }

  // validate email address (the html also does a more basic check)
  let emailValid = validateEmail(form["email"].value);
  if (!emailValid && !form["email"].parentNode.classList.contains("form-error"))
    form["email"].parentNode.classList.add("form-error");

  // add error messages
  const errorMessages = [];
  if (hasEmptyField) errorMessages.push("Please complete all required fields");
  if (!consent) errorMessages.push("Please agree to the terms and conditions");
  if (!passwordsMatch) errorMessages.push("Passwords do not match");
  if (!emailValid) errorMessages.push("Please enter a valid email address");

  //Add dialog box with error messages
  if (errorMessages.length) {
    if (document.contains(document.getElementById("errors")))
      document.getElementById("errors").remove();
    form.insertAdjacentHTML("afterbegin", `<div id="errors"></div>`);
    errorMessages.forEach((err) => {
      document
        .getElementById("errors")
        .insertAdjacentHTML("beforeend", `<p>${err}</p>`);
    });
  }

  return consent && !hasEmptyField && passwordsMatch && emailValid;
}

// remove class that emphasizes form error
const removeErrorState = (element) =>
  element.parentNode.classList.remove("form-error");

//validate email with regex
const validateEmail = (email) => {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return email === "" || re.test(String(email).toLowerCase());
};
