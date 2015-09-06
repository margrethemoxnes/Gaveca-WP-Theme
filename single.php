<?php include('header2.php'); ?>
	<div class="container-fluid" id="theContent">
		<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$currentID = get_the_ID(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="row contentInfo">
					<div class="col-xs-12">
						<?php the_post_thumbnail('sisteNytt', array( 'class' => 'post-'.$post->ID.' img-responsive SisteNyttImageSingle')); ?>
					</div>
                                    <div class="postDateSingle">Skrevet <?php the_date(); ?> av <?php  the_author();?></div>

                    </div>
                    <div class="row">
					<div class="col-xs-12">
						<div class="contentDesc"><?php the_content(); ?></div>
						<div class="row">
							<div class="col-xs-12 col-md-2">
								<?php if (class_exists('MultiPostThumbnails')) {
									$pris = MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image');
									$image = wp_get_attachment_image( $pris, 'pris', false);
									echo $image;
								} ?>
							</div>
                            </div>
                            
					</div>
				</div>
                <div class="row">
                                <div class="col-xs-6">
                                    <a href="" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left"></span> Forrige</a>
                                </div>
                                <div class="col-xs-6" style="text-align:right;">
                                    <a href="" class="btn btn-danger">Neste <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
						</div>
			<?php endwhile; endif; ?>
			<hr>
			<div class="row moreBooks">
				<div  class="moreBooksTitle">Siste nyheter fra Gaveca</div>
				<?php global $post;
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => '3',
					'post__not_in' => array($currentID),
					'orderby'=>'rand',
				);
				$wp_query = new WP_Query( $args );
				while ($wp_query->have_posts() ) : $wp_query -> the_post(); ?>
					<div class="col-xs-12 col-md-4 moreBook">
						<?php print '<a href="'. get_permalink().'">';
							the_post_thumbnail( 'bok', array( 'class' => 'post-'.$post->ID) ); 
						print '</a>'; ?>
						<div class="moreBookTitle"><?php the_title(); ?></div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<script>
    jQuery('.attachment-post-thumbnail').addClass('img-responsive');
    </script>
<?php get_footer(); ?>