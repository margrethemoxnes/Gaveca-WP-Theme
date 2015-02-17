<?php include('header3.php'); ?>
<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
       <div class="row hovedinnhold">
            <div class="col-lg-12">
            	<h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
   </div>
<?php get_footer(); ?>