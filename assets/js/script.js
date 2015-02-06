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
		jQuery('html, body').animate({scrollTop: $(href).offset().top-55}, 500, 'linear');
		console.log(jQuery(href).offset().top-55);
	});
	
	var hjem = jQuery('a#home').position().top-100;
	var boker = jQuery('h2.boker').position().top-100;
	var forfattere = jQuery('h2.forfattere').position().top-100;
	var bb = jQuery('h2.bestille-boker').position().top-100;
	var kontakt = jQuery('h2.kontakt').position().top-100;
	
	var vindu = jQuery(window);
	vindu.scroll(function(){
		if(kontakt < vindu.scrollTop()){
			console.log('Kontakt');
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.kontakt').addClass('active');
		}
		else if(bb < vindu.scrollTop()){
			console.log('Bestille bøker');
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.bestille-boker').addClass('active');
			
		}
		else if(forfattere < vindu.scrollTop()){
			console.log('Forfattere');
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.forfattere').addClass('active');
		}
		else if(boker < vindu.scrollTop()){
			console.log('Bøker');
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.boker').addClass('active');
		}
		else if(hjem < vindu.scrollTop()) {
			console.log('Home');
			jQuery('.nav.nav-pills li').removeClass('active');
			jQuery('.nav.nav-pills li.home').addClass('active');
		}
	});
	
});


/*
Home: -55
Bøker: 623
Forfattere: 742.375
Bestille bøker: 861.75
Kontakt: 1513.3125
*/