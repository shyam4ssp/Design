$(document).ready(function() {
    var serviceSlider = $('.service-slider');
    if ($(serviceSlider).length>0) {
        $(serviceSlider).owlCarousel({
            items:4,
            nav:true,
            dots:false,
            responsive: {
                0:{
                    items:1,
                    margin:0
                },
                767:{
                    items:2,
                    margin:20
                },
                1190:{
                    items:4,
                    margin:30
                }
            }
        });
    }

    // testimonail
    var testimonail = $('.testimonail-slider');
    if ($(testimonail).length>0) {
        $(testimonail).owlCarousel({
            items:1,
            nav:true,
            dots:false
        });
    }

    // mobile menu
    $('.icon-menu').click(function(){
        $('.menu, body').toggleClass('active-menu');
    });

    
    $(window).scroll(function(){
        var scrollTop = $(window).scrollTop();
        //console.log(scrollTop);
        var offset = $('.header-sticky-wrapper').offset();
        if (scrollTop >= offset.top) {
            $('header').addClass('sticky');
        }else{
            $('header').removeClass('sticky');
        }
    });

    resize();
    function resize(){
        var stickysize = $('.header-sticky-wrapper').height();
        $('.header-sticky-wrapper').css('min-height', stickysize);
    }
});