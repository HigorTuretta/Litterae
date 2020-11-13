
import swal from 'sweetalert';

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

// formulario

$(document).ready(function(){
    $('#formulario').on('submit',function(e) {  //Don't foget to change the id form
    $.ajax({
        url:'contato.php', //===PHP 
        data:$(this).serialize(),
        type:'POST',
        success:function(data){
          console.log(data);
          //Success Message == 'Title', 'Message body', Last one leave as it is
          swal("Sucesso!", "Sua mensagem pfoi enviada! Não se preucupe, você será respondido o mais breve possível. Muito obrigado pela preferência!", "success");
        },
        error:function(data){
          //Error Message == 'Title', 'Message body', Last one leave as it is
          swal("Oops...", "Alguma coisa deu errada! :(", "error");
        }
      });
      e.preventDefault(); 
    });
  });


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
