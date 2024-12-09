/*
    validate form fields 
        can not be blank
        no numbers in first or last name
    run the submit method
*/

//form fields
let contactForm = document.querySelector("#contactForm");
let firstName = document.querySelector("#firstName");
let lastName = document.querySelector("#lastName");
let email = document.querySelector("#email");
let contactReason = document.querySelector("#contactReason");
let message = document.querySelector("#message");

//error message spans
let firstNameError = document.querySelector("#firstNameError");
let lastNameError = document.querySelector("#lastNameError");
let emailError = document.querySelector("#emailError");
let contactReasonError = document.querySelector("#contactReasonError");
let messageError = document.querySelector("#messageError");

function validateFormFields() {
    let validForm = true;

    // Clear all previous error messages
    firstNameError.innerHTML = "";
    lastNameError.innerHTML = "";
    emailError.innerHTML = "";
    contactReasonError.innerHTML = "";
    messageError.innerHTML = "";

    // Validate each field
    if (firstName.value.trim() === "") {
        firstNameError.innerHTML = "First name cannot be blank.";
        validForm = false;
    }
    if (lastName.value.trim() === "") {
        lastNameError.innerHTML = "Last name cannot be blank.";
        validForm = false;
    }
    if (email.value.trim() === "") {
        emailError.innerHTML = "Email cannot be blank.";
        validForm = false;
    }
    if (contactReason.value.trim() === "") {
        contactReasonError.innerHTML = "Please enter a contact reason.";
        validForm = false;
    }
    if (message.value.trim() === "") {
        messageError.innerHTML = "Message cannot be blank.";
        validForm = false;
    }

    // If all fields are valid, submit the form
    if (validForm) {
        //alert("Fields are valid!");
        contactForm.submit();
    }
}
