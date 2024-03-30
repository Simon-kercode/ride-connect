// Open/close and show/hide burger menu
let burger = document.querySelector('#burger');
let closeBurger = document.querySelector('#closeBurger');
let menuLinks = document.querySelector('#menuLinks');

closeBurger.style.display = 'none';

burger.addEventListener('click', function() {
    menuLinks.classList.add('navOn');
    burger.style.display = 'none';
    closeBurger.style.display = 'block';
})

closeBurger.addEventListener('click', function() {
    menuLinks.classList.remove('navOn');
    burger.style.display = 'block';
    closeBurger.style.display = 'none';
})

// lock the submit button if checkbox is not checked
let checkbox = document.querySelector('.checkbox');
checkbox.addEventListener('change', function() {
    let formBtn = document.querySelector('.formBtn');
    if (checkbox.checked) {
        formBtn.disabled = false;
    }
    else formBtn.disabled = true;
})

// Client side registering verification

let form = document.querySelector("#registerForm");
let errorElement = null;
form.addEventListener("submit", function(event) {


    let emailInput = document.getElementsByName("email")[0];
    let passwordInput = document.getElementsByName("password")[0];
    let pseudoInput = document.getElementsByName("pseudo")[0];
    let nameInput = document.getElementsByName("name")[0];
    let firstnameInput = document.getElementsByName("firstname")[0];
    let rgpdCheckbox = document.getElementsByName("rgpd")[0];

    // clear all errors fields
    let errorElements = document.querySelectorAll(".error");
    errorElements.forEach(function(element) {
        element.remove();
    });

    let errors = [];

    if (emailInput.value.trim() === "") {
        displayError(emailInput, "Veuillez saisir votre adresse email.");
        errors.push("Veuillez saisir votre adresse email.");
    }

    if (passwordInput.value.trim() === "") {
        displayError(passwordInput, "Veuillez saisir un mot de passe.");
        errors.push("Veuillez saisir votre mot de passe.");
    }

    if (pseudoInput.value.trim() === "") {
        displayError(pseudoInput, "Veuillez choisir un pseudo.");
        errors.push("Veuillez choisir un pseudo.");
    }

    if (nameInput.value.trim() === "") {
        displayError(nameInput, "Veuillez saisir votre nom.");
        errors.push("Veuillez saisir votre nom.");
    }

    if (firstnameInput.value.trim() === "") {
        displayError(firstnameInput, "Veuillez saisir votre prénom.");
        errors.push("Veuillez saisir votre prénom.");
    }

    if (!rgpdCheckbox.checked) {
        displayError(rgpdCheckbox, "Veuillez accepter les conditions d'utilisation.");
        errors.push("Veuillez accepter les conditions d'utilisation.");
    }

    if (errors.length > 0) {
        // preventing form submission
        event.preventDefault();
    }
});

function displayError(inputElement, errorMessage) {
    // Create p element to display the error message
    errorElement = document.createElement("p");
    errorElement.className = "error";
    errorElement.textContent = errorMessage;

    // insert error element after the corresponding input
    inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
}

// display actual date in the date field
document.addEventListener('DOMContentLoaded', function() {

    let dateInput = document.querySelector('#dateInput');
    // get the current Date
    let currentDate = new Date();
    // format it to yyyy-mm-dd
    let formattedDate = currentDate.toISOString().split('T')[0];

    dateInput.value = formattedDate;
});



