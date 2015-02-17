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
                    </div>
                    	<div class="content">
                    		<?php the_content(); ?>
                    	</div>

                 </div>
				<?php endwhile; ?>
			<!-- end of the loop -->
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
        </div>
        <!-- Kart -->
        <div class="google-maps">
        	<div class="overlay" onClick="style.pointerEvents='none'"></div>
        	<iframe scrolling="no" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2085.2987826636727!2d8.760046599999999!3d58.48948240000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4647945e885d7b9d%3A0xe52c96fbf4bfd376!2sTeknologiveien+1%2C+4846+Arendal!5e0!3m2!1sen!2sno!4v1422969161824" width="100%" height="300px" frameborder="0" style="border:0"></iframe>
        </div>
<?php get_footer(); ?>