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