$(document).ready(function(){
	
	
	var menu_expand_btn = $('.menu_expand');
	menu_expand_btn.attr('href','javascript:void(1)');
var site_menu = $('.nav-menu');


menu_expand_btn.click(function(){//state-active
	//site_menu.slideToggle(140, function(){site_menu.removeAttr('style');site_menu.toggleClass('state-active')});
	site_menu.toggleClass('state-active');
	$(this).toggleClass('active');
	$("body").addClass('no_overflow');
	$("body").children(".overlay").addClass('active');
		$("body").css("position","relative");
		
	});
	$(".overlay").click(function(){
		$(this).removeClass('active');
	$("body").removeClass('no_overflow');
		$("#header_menu").removeClass("state-active");
	});

		
	//sub menu plus drop
	
	var item_with_children = $('.nav-menu li.menu-item-has-children');
	item_with_children.prepend('<span class="expand_plus"><i></i></span>');
	
	$('.expand_plus').click(function(){
		$(this).toggleClass('active');
		$(this).parent().children('.sub-menu').slideToggle(240, function(){$(this).parent().children('.sub-menu').removeAttr('style'); $(this).parent().children('.sub-menu').toggleClass('active-children');  });
		});
	

		

	
	}); 
	