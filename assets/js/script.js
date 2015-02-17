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
		//var target = href.substr(1);
		jQuery('.nav.nav-pills li').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('html, body').animate({scrollTop: $(href).offset().top-55}, 500, 'linear');
	});
	
	jQuery('#front #bestill.btn a').on('click', function(){
		event.preventDefault();
		var href = jQuery(this).attr('href');
		jQuery('html, body').animate({scrollTop: $(href).offset().top-55}, 500, 'linear');
	});
	
	var avstand = 250;
	var hjem = jQuery('a#home').position().top-avstand;
	var boker = jQuery('h2.boker').position().top-avstand;
	var forfattere = jQuery('h2.forfattere').position().top-avstand;
	var bb = jQuery('h2.bestille-boker').position().top-avstand;
	var kontakt = jQuery('h2.kontakt').position().top-avstand;
	
	var vindu = jQuery(window);
	vindu.scroll(function(){
		if(kontakt < vindu.scrollTop()){
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.kontakt').addClass('active');
		}
		else if(bb < vindu.scrollTop()){
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.bestille-boker').addClass('active');
			
		}
		else if(forfattere < vindu.scrollTop()){
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.forfattere').addClass('active');
		}
		else if(boker < vindu.scrollTop()){
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.boker').addClass('active');
		}
		else if(hjem < vindu.scrollTop()) {
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.home').addClass('active');
		}
	});
	
	/* MixUp */
	jQuery(function(){
	$('#boker .Container').mixItUp();
	});
	
	
});

