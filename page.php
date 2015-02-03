<?php get_header(); ?>
<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
       <div class="row hovedinnhold">
            <div class="col-lg-12">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <?php edit_post_link('Rediger siden', '<p>', '</p>'); ?>
        </div>
    </div>
<?php get_footer(); ?>