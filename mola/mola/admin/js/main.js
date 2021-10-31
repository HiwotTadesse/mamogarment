$(document).ready(function(){
  
        $(".clothe_img_con").slick({
    
    autoplay:true,
    autoplayspeed:1000,
    speed:1000,
    dots:true,
      slidesToShow: 1,
      slidesToScroll: 1
    
    
        });


        
        $('#button1').on('click', function(){

            $('#file-input1').trigger('click');
        })
       
        $('.editPost').on('click', function(){

            $('#file-input').trigger('click');
        });

$(window).bind('scroll', function() {
    if ($(window).scrollTop() > 100) {
        $('.nav').addClass('navbar-fixed-top');
    }
    else {
        $('.nav').removeClass('navbar-fixed-top');
    }
});

$(".mobile").click(function(){

$(".nav-bar nav").toggleClass('active');
$(".mobile").toggleClass('btnc');


});


$(".nav-bar nav li").click(function(){

if ($(".nav-bar nav li").hasClass('activeli')) {

$(".nav-bar nav li").removeClass("activeli");
$(this).addClass('activeli');
}
});


});