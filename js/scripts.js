<<<<<<< HEAD

window.addEventListener('DOMContentLoaded', event => {

    
=======
/*!
* Start Bootstrap - Creative v7.0.3 (https://startbootstrap.com/theme/creative)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
>>>>>>> 90101a92221527a27cacc4b0c2666786c1b32584
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

<<<<<<< HEAD
   
    navbarShrink();

    document.addEventListener('scroll', navbarShrink);

=======
    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
>>>>>>> 90101a92221527a27cacc4b0c2666786c1b32584
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

<<<<<<< HEAD

=======
    // Collapse responsive navbar when toggler is visible
>>>>>>> 90101a92221527a27cacc4b0c2666786c1b32584
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

<<<<<<< HEAD
    
=======
    // Activate SimpleLightbox plugin for portfolio items
>>>>>>> 90101a92221527a27cacc4b0c2666786c1b32584
    new SimpleLightbox({
        elements: '#portfolio a.portfolio-box'
    });

});

<<<<<<< HEAD
=======

$('#password, #confpwd').on('keyup', function () {
  if ($('#pwd').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
>>>>>>> 90101a92221527a27cacc4b0c2666786c1b32584
