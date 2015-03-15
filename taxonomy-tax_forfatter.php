<?php include('header2.php'); ?>
<div class="container-fluid" id="theContent">
	<div class="container">
		<div class="row contentInfo">
			<?php global $post;
			$authorName = get_queried_object()->name;
			$authorDesc = get_queried_object()->description;
			$authorSlug = get_queried_object()->slug;

			$terms = apply_filters( 'taxonomy-images-get-terms', '', 
				array(
					'image_size'   => 'full',
					'taxonomy' => 'tax_forfatter'
				) 
			);
			if ( ! empty( $terms ) ) {
				foreach( (array) $terms as $term ) {
					$termName = $term->name;
					if($termName == $authorName){
						$authorImg = wp_get_attachment_image( $term->image_id, 'forfatter', false, array( 'class' => 'img-responsive' ) );
					}
				}
			}
			print '<h2>'.$authorName.'</h2>';
			print '<div class="col-xs-12 col-md-4">';
				print $authorImg;
			print '</div>';
			print '<div class="col-xs-12 col-md-8">';
				print '<div class="contentDesc">'.$authorDesc.'<hr><div class="row moreBooks">'; ?>
				<?php global $post;
				$args = array(
					'post_type' => 'publikasjoner',
				);
				$wp_query = new WP_Query( $args );
				$i = 0;
				while ($wp_query->have_posts() ) : $wp_query -> the_post();
					foreach(get_the_terms($wp_query->post->ID, 'tax_forfatter') as $term)
						$AuthorSlug = $term->slug; 
						if($AuthorSlug  == $authorSlug){
							if($i < 4){$i++;} else{print '</div><div class="row moreBooks">'; $i = 1;}
							print '<div class="col-xs-12 col-md-3 moreBook">';	
								print '<a href="'. get_permalink().'">';
									the_post_thumbnail( 'bok', array( 'class' => 'post-'.$post->ID.' img-responsive') );
								print '</a>';
							print '</div>'; 
						}?>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php print '</div>';
			print '</div></div>';?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>