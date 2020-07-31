$(document).ready(function () {

    /* Browser fullscreen experience on double click */
    if (self == top) {
        $('body').on('dblclick', function (e) {

            if (!document.fullscreenElement && // alternative standard method
                !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }

        });
    } else {
        
    }


    /* float label checking input is not empty */
    $('.float-label .form-control').on('blur', function () {
        if ($(this).val() || $(this).val().length != 0) {
            $(this).closest('.float-label').addClass('active');
        } else {
            $(this).closest('.float-label').removeClass('active');
        }
    })

    /* menu open close wrapper screen click close menu */
    $('.menu-btn').on('click', function (e) {
        e.stopPropagation();
        if ($('body').hasClass('sidemenu-open') == true) {
            $('body, html').removeClass('sidemenu-open');
            setTimeout(function () {
                $('body, html').removeClass('menuactive');
            }, 500);
        } else {
            $('body, html').addClass('sidemenu-open menuactive');
        }
    });
    $('.wrapper').on('click', function () {

        if ($('body').hasClass('sidemenu-open') == true) {

            $('body, html').removeClass('sidemenu-open');
            setTimeout(function () {
                $('body, html').removeClass('menuactive');
            }, 500);
        }
    });

    /* filter click open filter */
    if ($('body').hasClass('filtermenu-open') == true) {
        $('.filter-btn').find('i').html('close');
    }
    $('.filter-btn').on('click', function () {
        if ($('body').hasClass('filtermenu-open') == true) {
            $('body').removeClass('filtermenu-open');
            $(this).find('i').html('filter_list')

        } else {
            $('body').addClass('filtermenu-open');
            $(this).find('i').html('close')
        }
    });


    /* background image to cover */
    $('.background').each(function () {
        var imagewrap = $(this);
        var imagecurrent = $(this).find('img').attr('src');
        imagewrap.css('background-image', 'url("' + imagecurrent + '")');
        $(this).find('img').remove();
    });


    /* drag and scroll like mobile remove while creating mobile app */
    (function ($) {
        $.dragScroll = function (options) {
            var settings = $.extend({
                scrollVertical: true,
                scrollHorizontal: true,
                cursor: null
            }, options);

            var clicked = false,
                clickY, clickX;

            var getCursor = function () {
                if (settings.cursor) return settings.cursor;
                if (settings.scrollVertical && settings.scrollHorizontal) return 'url(img/touch.png), move';
                if (settings.scrollVertical) return 'row-resize';
                if (settings.scrollHorizontal) return 'col-resize';
            }

            var updateScrollPos = function (e, el) {
                $('html').css('cursor', getCursor());
                var $el = $(el);
                settings.scrollVertical && $el.scrollTop($el.scrollTop() + (clickY - e.pageY));
                settings.scrollHorizontal && $el.scrollLeft($el.scrollLeft() + (clickX - e.pageX));
            }

            $(document).on({
                'mousemove': function (e) {
                    clicked && updateScrollPos(e, this);
                },
                'mousedown': function (e) {
                    clicked = true;
                    clickY = e.pageY;
                    clickX = e.pageX;
                },
                'mouseup': function () {
                    clicked = false;
                    $('html').css('cursor', 'url(img/logo-cursor.png), auto');
                }
            });
        }
    }(jQuery))

    $.dragScroll();
    /* End of drag and scroll like mobile remove while creating mobile app */
});


$(window).on('load', function () {
    $('.loader-screen').fadeOut('slow');

    /* header active on scroll more than 50 px*/
    if ($(this).scrollTop() >= 30) {
        $('.header').addClass('active')
    } else {
        $('.header').removeClass('active')
    }

    $(window).on('scroll', function () {
        /* header active on scroll more than 50 px*/
        if ($(this).scrollTop() >= 30) {
            $('.header').addClass('active')
        } else {
            $('.header').removeClass('active')
        }
    });



});

function validate_input() {
	
	cname = $("#name").val();
	caddr = $("#addr").val();
	cemail = $("#email").val();
	cphone = $("#phone").val();
	cfood = $("#chkfood").val();
	cprice = $("#chkprice").val();
	
	if(cname != "" && caddr != "" && cemail != "" && cphone != "") {
		
		$.ajax({
			url: 'process_order.php',
			type: 'POST',
			data: {order_info: 'info', name: cname, addr: caddr, email: cemail, phone: cphone, food: cfood, price: cprice},
			success: function(data) {
				
				if(data == 'success') {
					window.location = "thankyou.php";
				}else{
					alert(data);
				}	
			}
		});
		
	}else{
		alert('Incomplete form data');	
	}
	
}


function update_qty(id) {
	
	var qty = document.getElementById(id).value;
	var price = 'ajax_qty_'+id;
	
	$.ajax({
					
		url: 'process_order.php',
		type: 'POST',
		data: {item_id_qty : qty},
		success: function(data) {
			//alert(data);
			document.getElementById(price).innerHTML = data;
		}
	});
	
}

$(obtener_registros());

function obtener_registros(food)
{
    $.ajax({
        url: 'php/consulta.php',
        type: 'POST',
        dataType: 'html',
        data :{food: food},
    })

    .done(function(resultado){
        $("#resultado").html(resultado);
    })
}

$(document).on( 'keyup', '#busqueda', function(){

    var valorBusqueda=$(this).val();
    if(valorBusqueda!=""){
        obtener_registros(valorBusqueda);
    }else{
        obtener_registros();
    }
})







