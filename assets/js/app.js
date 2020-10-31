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

//formulario

$(document).ready(function($) {
    const $formulario = $("#formulario");
   $formulario.submit(e => {
      e.preventDefault();      
      
      const $action = $formulario.attr('action');
      const $data = $formulario.serialize();
      $.post($action, $data).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Mensagem Enviada!',
            text: 'Muito obrigado!',
            footer: '<a href="/">Voltar para home</a>'
          });
      });
    });
  });


  $('a[href^="#"]').on('click', function(event) {

    var target = $( $(this).attr('href') );

    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 600);
    }

});


function navbarFixed(){
    if ( $('.header_area').length ){ 
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();   
            if (scroll >= nav_offset_top ) {
                $(".header_area").addClass("navbar_fixed");
            } else {
                $(".header_area").removeClass("navbar_fixed");
            }
        });
    };
};
navbarFixed();

navSlide();