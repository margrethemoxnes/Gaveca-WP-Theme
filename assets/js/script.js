// JavaScript Document
jQuery(document).ready(function() {
    
	// Meny
	jQuery('.search.menu-item').on('click', function(){
		//jQuery('#search.input-group').toggle('fast');
	});
	
	jQuery('.nav.nav-pills li.home').addClass('active');
	
	jQuery('.nav.nav-pills li').on('click', function(){
		event.preventDefault();
		var menuItem = jQuery(this).find('a');
		var href = jQuery(menuItem).attr('href');
		var target = href.substr(1);
		jQuery('.nav.nav-pills li').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('html, body').animate({
        scrollTop: $(href).offset().top
    }, 500);
	});
	
});