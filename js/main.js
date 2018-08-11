//Scroll-Up
jQuery(document).ready(function($) {
    var MQL = 1170;

    //primary navigation slide-in effect
    if ($(window).width() > MQL) {
        
    }

    if($("#newsletter-form").length) 
    {
        jQuery("#newsletter-form, #sidebar-newsletter-form").on('submit',(function(e) {                
                e.preventDefault();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();
                curElement.find("#error").empty().slideUp();
                curElement.find("#confirm").empty().slideUp();
                curElement.find('#loading').show();                

                jQuery.ajax({
                url: "newsletter/register",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    curElement.find('#loading').hide();
                    curElement.find("#"+data.result).html(data.message).slideDown();                    
                    curElement.find(':submit').show();
                }
                });
        }));
    }

  var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: false,
        autoplay: 5000,
        autoplayDisableOnInteraction: true
  });


 $('.swiper-posts').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2        
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


 $('#swiper-slideshow').slick({
  dots: false,
  infinite: false,
  autoplay:true,
  autoplaySpeed:3000,
  arrows:true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1450,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2        
      }
    },
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2        
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


 $.cookieBar();



});
