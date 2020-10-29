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



navSlide();