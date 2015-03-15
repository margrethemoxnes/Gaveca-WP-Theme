<?php 
/* Login page */

/* Logg ut -> Redirect til Home */
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

/* Legg til Gaveca Logo i login */
function custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('. get_bloginfo( 'template_directory' ) .'/assets/images/gaveca-logo_200x64.png) !important; 
		-webkit-background-size: 200px 64px !important;
background-size: 200px 64px !important;
height: 64px !important;
width: 200px !important; 
		}
		
		.wp-core-ui .button-primary {
background: #CC2E2E !important;
border-color: #A20000 !important;
-webkit-box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15) !important;
box-shadow: inset 0 1px 0 rgba(120,200,230,.5),0 1px 0 rgba(0,0,0,.15)!important;
		}
    </style>';
}

add_action('login_head', 'custom_login_logo');

/* Logg ut -> Redirect til Home */ 
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));


/* Endre link på Logo i Login */
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Forlag Gaveca';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/* Fjern errormessage om riktig brukernavn */
add_filter('login_errors',create_function('$a', "return null;"));


/* Theme */
setlocale(LC_ALL, 'no_NO');


/* Registrer Meny */
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Menu' ));
  register_nav_menu('top-menu',__( 'Forfatter' ));
}
add_action( 'init', 'register_my_menu' );


/* Cropping and resize images */
 add_theme_support( 'post-thumbnails', array( 'post', 'product') );
add_image_size( 'bok', 163, 999, false ); 
add_image_size( 'forfatter', 390, 510, false ); 
add_image_size( 'pris', 195, 195, true ); 
add_image_size( 'pubSmall', 134, 999, false ); 
add_image_size( 'pubBig', 300, 999, false ); 

update_option('thumbnail_size_w', 103);
update_option('thumbnail_size_h', 999);
update_option('thumbnail_crop', 0);


// Publikasjoner Post Type
add_action('init','gaveca_register_publikasjoner');

function gaveca_register_publikasjoner(){
		
		$publikasjoner_label =  array(
			  		'name' => 'Publikasjoner',
					'menu_name' => 'Publikasjoner',
					
					'singular_name' => _x('Publikasjon', 'post type singular name'),
					'add_new' => _x('Legg til bok', 'boker'),
					'add_new_item' => __('Legg til bok'),
					'edit_item' => __('Rediger bok'),
					'new_item' => __('Ny publikasjon'),
					'view_item' => __('Vis publikasjon'),
					'search_items' => __('Søk etter bok'),
					'not_found' =>  __('Ingen bøker funnet'),
					'not_found_in_trash' => __('Ingen bøker funnet i søppelbøtte'),
					'parent_item_colon' => '',
			  );
			  
			  $publikasjoner = array(
			  'labels' => $publikasjoner_label,
			  'public' => 'true',
			  'has_archives' => true,
			  'menu_position' => 5,
			  'show_in_nav_menus' => true,
			'can_export' => true,
			'show_ui' => true,
			'_builtin' => false,
			'capability_type' => 'post',
			//'menu_icon' => get_bloginfo('template_url').'/_/images/bok.png',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'boker' ),
			'supports'=> array('title', 'thumbnail', 'editor') ,
			'taxonomies' => array( 'tax_forfatter')
			  );
		
	register_post_type('publikasjoner', $publikasjoner);	
}

if (class_exists('MultiPostThumbnails')) {

new MultiPostThumbnails(array(
'label' => 'Pris',
'id' => 'secondary-image',
'post_type' => 'publikasjoner'
 ) );

 }

// Dersom bok er utsolgt
/*
add_action( 'admin_init', 'g_utsolgt_create' );
 
function g_utsolgt_create() {
    add_meta_box('g_utsolgt_meta', 'Utsolgt (Under utvikling)', 'g_utsolgt_meta', 'publikasjoner');
}
 
function g_utsolgt_meta () {
 
// - grab data -
 
	global $post;
	$values = get_post_custom($post->ID);
	$utsolgtDato = isset( $values['lagerDato'] ) ? $values['lagerDato'] : '';
	$check = isset( $values['utsolgt'] ) ? esc_attr( $values['utsolgt'] ) : '';
    
    // - security -
 
	echo '<input type="hidden" name="g-utsolgt-nonce" id="g-utsolgt-nonce" value="' .wp_create_nonce( 'g-utsolgt-nonce' ) . '" />'; ?>
    
	<p><label>Utsolgt: </label> <input type="checkbox" name="utsolgt" <?php checked( $check, 'on' ); ?>  /></p>
    <p><label>På lager f.o.m.</label> <input type="text" name="lagerDato" placeholder="Måned, År" value="<?php echo $utsolgtDato; ?>"  /></p>
<?php
}

// Save Utsolgt Metadata
 
add_action ('save_post', 'save_g_utsolgt');
 
function save_g_utsolgt(){
 
	global $post;
	 
	// - still require nonce
	 
	if ( !wp_verify_nonce( $_POST['g-utsolgt-nonce'], 'g-utsolgt-nonce' )) {
		return $post->ID;
	}
	 
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	 
	// - convert back to unix & update post
	 
	if(!isset($_POST['utsolgt'])):
	return $post;
	endif;
	update_post_meta($post->ID, 'utsolgt', $check );
	 
	if(!isset($_POST['lagerDato'])):
	return $post;
	endif;
	update_post_meta($post->ID, 'lagerDato', $utsolgtDato );
	 
}
*/
function create_forfattere_taxonomy() {
 
$forfatter_labels = array(
    'name' => _x( 'Forfattere', 'taxonomy general name' ),
    'singular_name' => _x( 'Forfatter', 'taxonomy singular name' ),
    'search_items' =>  __( 'Søk etter forfatter' ),
    'popular_items' => __( 'Populære forfattere' ),
    'all_items' => __( 'Alle forfattere' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Rediger forfatter' ),
    'update_item' => __( 'Oppdater forfatter' ),
    'add_new_item' => __( 'Legg til forfatter' ),
    'new_item_name' => __( 'Nytt forfatternavn' ),
    'separate_items_with_commas' => __( 'Separer forfattere med komma' ),
    'add_or_remove_items' => __( 'Legg til eller fjern forfattere' ),
    'choose_from_most_used' => __( 'Velg av mest valgte forfattere' ),
);
  
 
register_taxonomy('tax_forfatter','publikasjoner', array(
    'label' => __('Forfattere'),
    'labels' => $forfatter_labels,
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'forfatter' )
));
}
 
add_action( 'init', 'create_forfattere_taxonomy', 0 );


	// Legg til excerpt
	function forfatter_taxonomy_add_new_meta_field() { ?>
		<div class="form-field">
			<label for="term_meta[custom_term_meta]"><?php _e( 'Undertittel', 'forfatter_undertittel' ); ?></label>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
			<p class="description"><?php _e( 'Skriv inn en undertittel','forfatter_undertittel' ); ?></p>
		</div>
	<?php
	}
	add_action( 'tax_forfatter_add_form_fields', 'forfatter_taxonomy_add_new_meta_field', 10, 2 );
	
	
	
	// Rediger Excerpt
	function forfatter_taxonomy_edit_meta_field($term) {
	 
		$t_id = $term->term_id;
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Undertittel', 'forfatter_undertittel' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" 
                value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
				<p class="description"><?php _e( 'Skriv inn en undertittel','forfatter_undertittel' ); ?></p>
			</td>
		</tr>
	<?php
	}
	add_action( 'tax_forfatter_edit_form_fields', 'forfatter_taxonomy_edit_meta_field', 10, 2 );


	// Lagre
	function save_forfatterUndertittel_custom_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}  
	add_action( 'edited_tax_forfatter', 'save_forfatterUndertittel_custom_meta', 10, 2 );  
	add_action( 'create_tax_forfatter', 'save_forfatterUndertittel_custom_meta', 10, 2 );
	


	// Kolonner
	
	add_filter ("manage_edit-publikasjoner_columns", "publikasjoner_edit_columns");
	add_action ("manage_posts_custom_column", "publikasjoner_custom_columns");
	
	function publikasjoner_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"g_col_pub_thumb" => "Cover",
			"title" => "Tittel",
			"g_col_forf_cat" => "Forfatter",
		);
		return $columns;
	}
	
	function publikasjoner_custom_columns($column) {
		global $post;
		$custom = get_post_custom();
		switch ($column) {
			case "g_col_forf_cat":
			// - show taxonomy terms -
			$forfattere = get_the_terms($post->ID, "tax_forfatter");
			$forfattere_html = array();
			if ($forfattere) {
				foreach ($forfattere as $forfatter)
				array_push($forfattere_html, $forfatter->name);
				echo implode($forfattere_html, ", ");
			} else {
				_e('None', 'themeforce');;
			}
			break;
	
			case "g_col_pub_thumb":
			// - show thumb -
			$post_image_id = get_post_thumbnail_id(get_the_ID());
			if ($post_image_id) {
				$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
				if ($thumbnail) (string)$thumbnail = $thumbnail[0];
				echo '<img src="';
				echo bloginfo('template_url');
				echo '/_/timthumb/timthumb.php?src=';
				echo $thumbnail;
				echo '&w=100&zc=1" />';
			}
			break;
		}
	}




	// 6. Customize Update Messages
	 
	add_filter('post_updated_messages', 'dato_oppdater_messages');
	
	function dato_oppdater_messages( $messages ) {
		global $post, $post_ID; 
		$messages['publiseringer'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('Bok oppdatert. <a href="%s">Vis side</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Felt oppdatert.'),
			3 => __('Felt slettet.'),
			4 => __('Bok oppdatert.'),
			/* translators: %s: date and time of the revision  */
			5 => isset($_GET['revision']) ? sprintf( __('Bok gjennoprettet fra %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Bok er lagt ut. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Bok lagret.'),
			8 => sprintf( __('Bok er lagret. <a target="_blank" href="%s">Se side</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Bok er planlagt for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Vis side</a>'),
			  // translators: Publish box date format, see http://php.net/date
			  date_i18n( __( "%d. %b %G" ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Kladd oppdatert. <a target="_blank" href="%s">Vis side</a>'), 
			esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
		return $messages;
	}



// Shortcode for bøker
add_shortcode('publikasjoner','g_publikasjon_loop');
function g_publikasjon_loop(){ ?>

	<div class="row buttons">
		<?php 
		
		$AuthorArray = array(
			'hide_empty' => true,
		);
		$authors = get_terms( 'tax_forfatter', $AuthorArray );
 if ( ! empty( $authors ) && ! is_wp_error( $authors ) ){
     echo '<button class="filter" data-filter="all">Alle forfattere</button>';
     foreach ( $authors as $author ) {
       echo '<button class="filter forfattere '.$author->slug.'" data-filter=".'.$author->slug.'">'.$author->name.'</button>';
        
     }
    
 }
	?>
    </div>  <!--End Author Tax Row -->

    <div class="container booksMix">
		<ul>
                <?php 
                global $post;
                $i = 0;
                $MixNumb = 1;
                $args = array(
                    'post_type' => 'publikasjoner',
                    'posts_per_page' => '16',
                );
                $wp_query = new WP_Query( $args );
                while ($wp_query->have_posts() ) : $wp_query -> the_post();
                
					foreach(get_the_terms($wp_query->post->ID, 'tax_forfatter') as $term)
						
						 $AuthorSlug = $term->slug; 
						 print '<li class="'.$AuthorSlug.' publikasjoner mix" data-myorder="'.$MixNumb.'">';
						 print '<a href="'. get_permalink().'">';
						 the_post_thumbnail( 'bok', array( 'class' => 'post-'.$post->ID) ); 
						 echo '</a><a class="bookTitle" href="'. get_permalink().'">'.get_the_title().'</a></li>';
						 $MixNumb++; 
					?>
                <?php endwhile; wp_reset_postdata(); ?>
    	</ul> <!-- End Row --> 
    </div> <!-- End Container --> 
<?php }

// Shortcode for Forfattere
add_shortcode('forfattere','g_forfatter_loop');

function g_forfatter_loop(){
	
		global $post;
		$i = 0;
		$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
    			'image_size'   => 'bok',
				'taxonomy' => 'tax_forfatter',) );
if ( ! empty( $terms ) ) {
    print '<div class="row rowAuthors">';
	
		foreach( (array) $terms as $term ) {
				$taxID = $term->term_id;
				$term_meta = get_option( "taxonomy_{$taxID}" );
				if($i < 4 ){
					$i++;
				}
				else {
					$i = 1;
					print '</div><div class="row rowAuthors">';
				}
				print '<div class="col-md-3 colAuthor" data-value="'.$i.'">
				<a href="' . esc_url( get_term_link( $term, $taxID ) ) . '">' 
				. wp_get_attachment_image( $term->image_id, 'bok') . '</a>'; 
				print '<h4>'.$term->name.'</h4>';
				print '<p>'. $term_meta['custom_term_meta'].'</p>';
				print '<a href="' . esc_url( get_term_link( $term, $taxID ) ) . '" class="btn btn-danger btn-sm">Les mer <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>';
				print '</div>';
    	}
	print '</div>';
}
 }
?>