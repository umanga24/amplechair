$(document).ready(function() {

    $(".home_owl_slider").owlCarousel({

        loop: true,
        // rewind: true,
        autoplay: false,
        speed: 10000,
        autoplayHoverPause:true,
        autoplaySpeed: 10000,
        // slideSpeed: 300,
        slideSpeed: 1000,
        paginationSpeed: 800,
        // autoPlayTimeout: 500,
        autoPlayHoverPause: true,
        rewindSpeed: 1000,
        // paginationSpeed: 10,
        margin: 20,
        // mouseDrag: false,
        // touchDrag: false,
        pullDrag: false,
        nav: true,
        dots: false,
        lazyLoad: true,
        lazyLoadEager: '800',
        animateOut: 'fadeOut',
        // animateIn: 'heartBeat',
        // smartSpeed: 1000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],

        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
        },
    })
})




$(window).scroll(function() {
    if ($(this).scrollTop() > 80) {
        $('header').addClass("sticky");
    } else {
        $('header').removeClass("sticky");
    }
});




$(function() { //run when the DOM is ready
    $(".top-menu-bar").click(function() { //use a class, since your ID gets mangled
        $(this).toggleClass("active"); //add the class to the clicked element
        $('.main-menu').toggleClass("open");
    });
});



// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
});
$('#return-to-top').click(function() { // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, 500);
});




wow = new WOW({
    boxClass: 'wow', // default
    animateClass: 'animated', // default
    offset: 0, // default
    mobile: true, // default
    live: true // default
})
wow.init();



$(document).ready(function() {
    $('.main-drop-link').click(function() {
        $('li.main_drop_item').each(function(div, index) {
            $(this).removeClass('make_main_menu_active');
        });

        $(this).parent('li.main_drop_item').addClass('make_main_menu_active');
        var main_menu = $(this).parent('li.make_main_menu_active');

        if ($(this).parent('li.main_drop_item').hasClass('make_main_menu_active')) {
            if (main_menu.find('.dropdown-icon.fa.fa-plus')) {
                // main_menu.find('.dropdown-icon').removeClass('fa-plus').addClass('fa-minus');

            } else {
                // main_menu.find('.dropdown-icon').addClass('fa-plus').removeClass('fa-minus');
            }
            main_menu.find('.sub-menu').slideToggle(500);

            // $(this).next().parent('li.make_main_menu_active').find(".sub-menu").slideToggle(500);
        } else {
            // $(this).toggle('slow');
        }
        return false;
    })



})


document.addEventListener("DOMContentLoaded", function(){
    // make it as accordion for smaller screens
//    if (window.innerWidth < 992) {
   
       document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
   
           element.addEventListener('click', function (e) {
   
               let nextEl = element.nextElementSibling;
               let parentEl  = element.parentElement;
               let allSubmenus_array =	parentEl.querySelectorAll('.submenu');
   
               if(nextEl && nextEl.classList.contains('submenu')) {	
                   e.preventDefault();	
                   if(nextEl.style.display == 'block'){
                       nextEl.style.display = 'none';
                   } else {
                       nextEl.style.display = 'block';
                   }
               }
           });
       })
//    }
   // end if innerWidth
   }); 
   // DOMContentLoaded  end