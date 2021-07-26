<?php // silence is golden

// add custom fields to REST API
function add_acf_fields_to_rest( $data, $post, $request ) {
  $_data = $data->data;
  $_data['myfield'] = get_field('myfield', $post->ID);
 /* add more fields here if necessary */
  $data->data = $_data;
  return $data;
}
add_filter( 'rest_prepare_post', 'add_acf_fields_to_rest', 10, 3 );

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

if ( ! function_exists( 'blank_theme_setup' ) ) {
	function blank_theme_setup() {
    add_theme_support( 'block-templates' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'blank_theme_setup' );




function blank_styles() {
	wp_enqueue_style(
		'blank-theme',
		get_stylesheet_uri(),
		'',
		wp_get_theme()->get( 'Version' )
	);

}
add_action( 'wp_enqueue_scripts', 'blank_styles' );









function gbp_wp_block_patterns() {
    register_block_pattern(
        'block-pattern/serif-heading',
         array(
             'title' => __( 'Serif Heading', 'blank-theme' ),
             'description' => _x( 'Header that render in the theme\'s serif font', 'blank-theme' ),
             'content' => '<!-- wp:heading {"className":"ff-2"} -->
			 <h2 class="ff-2"></h2>
			 <!-- /wp:heading -->',
             'categories' => array('header'),
         )
    );
}
add_action( 'init', 'gbp_wp_block_patterns' );