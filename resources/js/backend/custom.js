$(document).ready(function(){
    $(".open-left").click(function(){
        $('#admin-person').toggleClass('person-minimize');
    });
    $('#form').parsley('removeItem', '.remove');


    // click on minus
    $('#minus-1').on('click',function(){
        $('#body-1').slideToggle();
    });
    $('#minus-2').on('click',function(){
        $('#body-2').slideToggle();
    });
    $('#minus-3').on('click',function(){
        $('#body-3').slideToggle();
    });
    $('#minus-4').on('click',function(){
        $('#body-4').slideToggle();
    });
    $('#minus-5').on('click',function(){
        $('#body-5').slideToggle();
    });
    $('#minus-6').on('click',function(){
        $('#body-6').slideToggle();
    });
    $('#minus-7').on('click',function(){
        $('#body-7').slideToggle();
    });
    $('#minus-8').on('click',function(){
        $('#body-8').slideToggle();
    });
    $('#minus-9').on('click',function(){
        $('#body-9').slideToggle();
    });
    $('#minus-10').on('click',function(){
        $('#body-10').slideToggle();
    });

    //for tooltip
    $('.form-group').tooltip({
        position: {
            my: "bottom-5",
            at: "left top",
            using: function( position, feedback ) {
              $( this ).css( position );
              $( "<div>" )
                .addClass( "arrow" )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal )
                .appendTo( this );
            }
          }
    });
    var rangeSlider = function(){
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');

        slider.each(function(){
          range.on('input', function(){
              var percent = Math.round(this.value) + '0%';
            $(this).next(value).html(percent);
          });
        });
      };

      rangeSlider();
});

// for custom nav
$('.is-active .list-unstyled').addClass('is-down');
$('.is-active .waves-effect').addClass('subdrops');  
$('.is-active .waves-effect').on('click',function(){
    $(this).removeClass('subdrops');  
    $('.is-active .list-unstyled').removeClass('is-down'); 
});  
