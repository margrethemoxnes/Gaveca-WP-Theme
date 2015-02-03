<?php 
/* Login page */

/* Logg ut -> Redirect til Home */
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

/* Legg til Gaveca Logo i login */
function custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('. get_bloginfo( 'template_directory' ) .'/img/weblogo.jpg) !important; 
		-webkit-background-size: 220px 70px !important;
background-size: 220px 70px !important;
height: 70px !important;
width: 220px !important; 
		}
		
		.wp-core-ui .button-primary {
background: #CC2E2E !important;
border-color: #A20000 !important;
-webkit-box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15) !important;
box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15)!important;
		}
    </style>';
}

add_action('login_head', 'custom_login_logo');


/* Theme */
setlocale(LC_ALL, 'no_NO');


/* Registrer Meny */
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Menu' ));
}
add_action( 'init', 'register_my_menu' );


/* Cropping and resize images */
add_theme_support( 'post-thumbnails', array( 'post', 'product') );
add_image_size( 'bok', 103, 999, false ); 

add_image_size( 'pubSmall', 134, 999, false ); 
add_image_size( 'pubBig', 300, 999, false ); 

update_option('thumbnail_size_w', 103);
update_option('thumbnail_size_h', 999);
update_option('thumbnail_crop', 0);




?>