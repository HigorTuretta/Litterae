const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');

    //toggle nav
    burger.addEventListener('click', () => {
        nav.classList.toggle('nav-active');


        //animate links
        navLinks.forEach((Link, index) => {
            if (Link.style.animation) {
                Link.style.animation = '';
            } else {
                Link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
            }
        });

        burger.classList.toggle('toggle');
    });

}


$('a[href^="#"]').on('click', function (event) {

    var target = $($(this).attr('href'));

    if (target.length) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 600);
    }

});

navSlide();


// JAVASCRIPT PARA O FUNCIONAMENTO DO SLIDER CLICANDO
$(window).on("load", function () {
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.navigation-button');

    let currentslide = 1;

    var manualNav = function (manual) {

        slides.forEach((slide) => {
            slide.classList.remove('active');

            btns.forEach((btn) => {
                btn.classList.remove('active');
            });
        });

        slides[manual].classList.add('active');
        btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
        btn.addEventListener('click', () => {
            manualNav(i);
            currentslide = i;
        })
    })

    // JAVASCRIPT PARA O FUNCIONAMENTO DO SLIDER AUTOMATICAMENTE
    var repeat = function(activeClass){
        let active = document.getElementsByClassName('active');
        let i = 1;

        var repeater = () => {
            setTimeout(() => {
                [...active].forEach((activeSlide) => {
                    activeSlide.classList.remove('active');
                });
                
                slides[i].classList.add('active');
                btns[i].classList.add('active');
                i++;

                if(slides.length == i){
                    i = 0
                }

                if( i >= slides.length){
                    return;
                }
                repeater();
            }, 5000);
        }
        repeater();
    }
    repeat();
});