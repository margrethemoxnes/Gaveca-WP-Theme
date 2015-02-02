<?php get_header(); ?>
<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
       <div class="row hovedinnhold">
            <div class="col-lg-12">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
    <?php if(is_front_page()){
	echo '
		</div> <!-- end Container -->
		<div id="mailingliste">
			Meld deg på vår mailingliste: <input type="text" id="mailing" /><input type="submit" value="Meld inn" />
		</div>
		<div class="container">
		<h1>Forfattere</h1>
		';
} 
else {
}?>
    <div class="row">
        <div class="col-lg-12">
            <?php edit_post_link('Rediger siden', '<p>', '</p>'); ?>
        </div>
    </div>
<?php get_footer(); ?>