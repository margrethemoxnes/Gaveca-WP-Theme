<header>
	<div id="backMenu"></div>
	<div class="container">
		<a href="<?php echo home_url(); ?>">
        	<img id="logo" alt="Gaveca-Logo" class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/gaveca-logo.jpg">
		</a>
	</div>
	<div class="row menu-row">
		<div class="col-xs-12">
			<nav class="navbar navbar-default">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
						</button>
					</div>
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav nav-pills ', 
					'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1' ) ); ?>
				</div><!-- /.container-fluid -->
			</nav>	
		</div>
	</div>
</header>
<a id="<?php echo $post->post_name ?>" class="<?php echo 'post-'.$post->ID ?>"></a>