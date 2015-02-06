<?php 
/*
*
Template Name: Home
*
*/
get_header(); ?>
<?php $this_post = $post->ID;?>
	<?php // the query
		$the_query = new WP_Query( array('post_type' => 'page', 'post__not_in' => array($this_post), 'orderby' => 'menu_order', 'order'=>'ASC') ); ?>
		<?php if ( $the_query->have_posts() ) : ?>
			<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="container-fluid pages page-<?php echo $post->ID ?>" id="<?php echo $post->post_name ?>">	
                	<div class="container">
					<h2 class="<?php echo $post->post_name ?>"><?php the_title(); ?></h2>
                    	<div class="content">
                    		<?php the_content(); ?>
                    	</div>
                    </div>
                 </div>
				<?php endwhile; ?>
			<!-- end of the loop -->
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
<?php get_footer(); ?>