const menuHamburger = document.querySelector('#menuHamburger');
const links = document.querySelector('.links');


menuHamburger.addEventListener('click', ()=>(
    links.classList.toggle('mobile-menu')
));