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

// ============ Script for register Page ===============
if (paramIndex('inscription') !== -1) {
    formVerification();
}

// ============== script for orga page ===========
if (paramIndex('organiser') !== -1) {
    dateFormat();
}

// ============ script for profile page ============
if (paramIndex('profil') !== -1) {
    displayProfilePart();
    displayInput();
}
// ============ script for admin page ==============
if (paramIndex('administration') !== -1) {
    displayAdminPart();
}


function formVerification() {
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
}

// display actual date in the date field
function dateFormat() {
    document.addEventListener('DOMContentLoaded', function() {

        let dateInput = document.querySelector('#dateInput');
        // get the current Date
        let currentDate = new Date();
        // format it to yyyy-mm-dd
        let formattedDate = currentDate.toISOString().split('T')[0];

        dateInput.value = formattedDate;
    });
} 

// display the selected profile part
function displayProfilePart() {
    let myInfo = document.querySelector('#myInfo');
    let myRides = document.querySelector('#myRides');
    let mySubscribedRides = document.querySelector('#mySubscribedRides');

    let myInfoBtn = document.querySelector('#myInfoBtn');
    let myRidesBtn = document.querySelector('#myRidesBtn');
    let mySubscribedRidesBtn = document.querySelector('#mySubscribedRidesBtn');

    myInfoBtn.addEventListener('click', function(){
        myInfo.style.display = 'block';
        myRides.style.display = 'none';
        mySubscribedRides.style.display = 'none';
    });
    myRidesBtn.addEventListener('click', function(){
        myInfo.style.display = 'none';
        myRides.style.display = 'block';
        mySubscribedRides.style.display = 'none';
    });
    mySubscribedRidesBtn.addEventListener('click', function(){
        myInfo.style.display = 'none';
        myRides.style.display = 'none';
        mySubscribedRides.style.display = 'block';
    });
}

function displayInput() {
    let inputs = [
    document.querySelector('#newEmail'),
    document.querySelector('#newPseudo'),
    document.querySelector('#newName'),
    document.querySelector('#newFirstname'),
    document.querySelector('#inputPasswordUpdate')
    ];
    
    let btns = [
    document.querySelector('#emailUpdateBtn'),
    document.querySelector('#pseudoUpdateBtn'),
    document.querySelector('#nameUpdateBtn'),
    document.querySelector('#firstnameUpdateBtn'),
    document.querySelector('#passwordUpdateBtn')
    ];
    
    // display corresponding input and hide the btn
    for (let i = 0; i < btns.length; i++) {   
        btns[i].addEventListener('click', function(event) {
            event.preventDefault();
            if (inputs[i].classList.contains('hiddenInput')) {
                inputs[i].classList.remove('hiddenInput');
                btns[i].style.display = 'none';
            }
        });
    }

    let resetBtn = document.querySelector('#resetBtn');
    // on reset button, display all buttons, delete inputs values and hid it
    resetBtn.addEventListener('click', function() {
        inputs.forEach(input => {
            if (input.value !== "") {
                input.value = "";
            }
            if (!input.classList.contains('hiddenInput')) {
                input.classList.add('hiddenInput');
            }
        });
        btns.forEach(btn => {
            if (btn.style.display !== 'block') {
                btn.style.display = 'block';
            }
        });
    });
}

function displayAdminPart() {
    let usersList = document.querySelector('#usersList');
    let ridesList = document.querySelector('#ridesList');

    let usersBtn = document.querySelector('#usersBtn');
    let ridesBtn = document.querySelector('#ridesBtn');

    usersBtn.addEventListener('click', function(){
        usersList.style.display = 'block';
        ridesList.style.display = 'none';
    });
    ridesBtn.addEventListener('click', function(){
        usersList.style.display = 'none';
        ridesList.style.display = 'block';
    });
}

function displayError(inputElement, errorMessage) {
    // Create p element to display the error message
    errorElement = document.createElement("p");
    errorElement.className = "error";
    errorElement.textContent = errorMessage;

    // insert error element after the corresponding input
    inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
}

// looking for the presence of an element in url
function paramIndex($param) {
    let url = window.location.href;
    let segments = url.split('/')
    let paramIndex = segments.indexOf($param);
    return paramIndex;
}





