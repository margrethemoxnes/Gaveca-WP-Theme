        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <h4>Kundeservice</h4>
                        <div class="footerCol">
                        	<p> <a href="mailto:post@gaveca.no"><span class="glyphicon glyphicon-envelope"></span> post@gaveca.no</a></p>
                            <p><span class="glyphicon glyphicon-phone"></span> &#43;47 478 13 047</p> 
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3" id="publikasjoner">
                        <h4>Siste publikasjoner</h4>
                        <ul class="footerCol">
                        	<?php global $post;
							$args = array(
								'post_type' => 'publikasjoner',
								'posts_per_page' => '5',
							);
							$pub = new WP_Query( $args );
							while ($pub->have_posts() ) : $pub -> the_post(); ?>
							
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							
							<?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <h4>Besøksadresse</h4>
                        <div class="footerCol">
                            <p>ARENDAL KUNNSKAPSPARK LONGUM</p>
                            <p>TEKNOLOGIVEIEN 1</p>
                            <p>4846 ARENDAL</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3" id="Facebook">
                        <h4>Facebook</h4>
                        <div class="fb-like-box" data-href="https://www.facebook.com/gavecaforlag" data-width="250" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
                    </div>
                </div>
            </div>
        </footer>
        <div id="bottomBar">
        	<div class="container">
            	© Forlag Gaveca
            </div>
        </div>
    </body>
</html>
