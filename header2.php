<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo wp_title(). ' | ' .get_bloginfo('name'); ?></title>
	<link href="<?php echo get_stylesheet_uri(); ?>" type="text/css" rel="stylesheet">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-1.11.2.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/modernizr.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.mixitup.js"></script>
    <link rel="icon" type="image/ico" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico"/>
</head>
<body  <?php if(is_front_page()){echo 'class="home"';}  ?>>
<!-- Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=319418674890445&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>