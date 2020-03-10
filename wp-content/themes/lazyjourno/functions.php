<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_index = 0;

function lazyconsole( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log(`$output`);</script>";
}

// Add scripts and stylesheets
function lazyjourno_scripts() {
	wp_enqueue_style( 'lazy', get_template_directory_uri() . '/css/lazyjourno.css' );
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.7.1/css/all.css');
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/default.js', '', '', true);
	wp_enqueue_script( 'gauge', '//cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.2/all/gauge.min.js');
}

function lazyjourno_load_fonts() {
				wp_register_style('OpenSans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
				wp_enqueue_style( 'OpenSans');
		}

add_action('wp_print_styles', 'lazyjourno_load_fonts');

// Custom settings
function custom_settings_add_menu() {
  add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}

function custom_settings_page() { ?>
	<div class="wrap">
		<h1>Custom Settings</h1>
		<form method="post" action="options.php">
			<?php
           settings_fields('section');
           do_settings_sections('theme-options');      
           submit_button(); 
       ?>
		</form>
	</div>
	<?php }

// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function setting_rss() { ?>
  <input type="text" name="rss" id="rss" value="<?php echo get_option('rss'); ?>" />
<?php }

function setting_copyright() { ?>
  <input type="text" style="width: 300px;" name="copyright" id="copyright" value="<?php echo get_option('copyright'); ?>" />
<?php }

function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
  add_settings_field( 'rss', 'RSS Feed URL', 'setting_rss', 'theme-options', 'section' );
  add_settings_field( 'copyright', 'Site Copyright Information', 'setting_copyright', 'theme-options', 'section' );

  register_setting('section', 'twitter');
  register_setting('section', 'rss');
    register_setting('section', 'copyright');
}

// Support Featured Images
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'html5', array( 'search-form' ) );
add_theme_support( 'custom-logo', apply_filters( 'lazyjourno_logo_args', array(
	'height'      => 45,
	'width'       => 164,
	'flex-height' => true,
	'flex-width'  => true,
) ) );
add_image_size( 'sticky', 300, 200, true );

add_action( 'admin_menu', 'custom_settings_add_menu' );
add_action( 'admin_init', 'custom_settings_page_setup' );
add_action( 'wp_enqueue_scripts','lazyjourno_scripts');

// NAVIGATION

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('section-menu',__( 'Section Menu' ));
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );

// Set active page

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
require_once( 'logic/avatar.php' );
add_filter('get_avatar', 'replace_twitter_default_avatar', 100001, 5);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

// ATTEMPT AT SPONSOR MENU

function lazyjourno_add_sponsor_menu() {
    add_menu_page( 
        __( 'Set Site Sponsor', 'textdomain' ), // Page <title>
        'Site Sponsor', // Menu Label
        'manage_options', // Admin level for use
        'sitesponsor', // Slug
        'lazyjourno_create_sponsor_page', // Callback when clicked
        'dashicons-businessman', // Icon
        61 // Position on admin menuß
    ); 

    add_action( 'admin_init', 'lazyjourno_start_sponsor_page' ); 
}

function lazyjourno_start_sponsor_page() {
	require_once( get_template_directory() . '/sponsor/functions.php');
	lazyjourno_sponsor_custom_settings();
}

add_action( 'admin_menu', 'lazyjourno_add_sponsor_menu' );

function wpdocs_custom_excerpt_length( $length ) {
    return 76;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// SETUP DIFFERENT CATEGORY PAGES FOR SINGLES

add_filter('single_template', 'category_singles');

function category_singles($t) {
	foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(get_template_directory() . "/single-{$cat->slug}.php") ) 
			return get_template_directory() . "/single-{$cat->slug}.php"; 
		} 
		return $t;
}

// ALLOW ADDING CLASSES TO THE CUSTOM LOGO

require_once get_template_directory() . '/lib/class_wp_bootstrap_navwalker.php';

add_filter( 'get_custom_logo', 'change_logo_class' );


function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'img-fluid', $html );
    $html = str_replace( 'custom-logo-link', 'your-custom-class', $html );

    return $html;
}

//add_action( 'wp_enqueue_scripts', 'my_deregister_styles' );

//function my_deregister_styles() {
//	wp_deregister_style( 'mediaelement' );
//	wp_deregister_style( 'wp-mediaelement' );
//}

// Remove default position for Jetpack's Related Articles

function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

function wpb_jp_posts() {
	echo do_shortcode(' [jetpack-related-posts] ');
}

/* Custom Default Avatar Start */
add_filter( 'avatar_defaults', 'newCustomGravatar' );
function newCustomGravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/img/lazy-avatar.png';
    $avatar_defaults[$myavatar] = "Lazy Avatar";
    return $avatar_defaults;
}
/* Custom Default Avatar End */