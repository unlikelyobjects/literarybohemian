<?php

/**
 * The Literary Bohemian functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Literary_Bohemian
 */

if (!function_exists('literarybohemian_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function literarybohemian_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The Literary Bohemian, use a find and replace
		 * to change 'literarybohemian' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('literarybohemian', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			// 'comment-form',
			// 'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('literarybohemian_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		// add_theme_support('custom-logo', array(
		// 	'height'      => 250,
		// 	'width'       => 250,
		// 	'flex-width'  => true,
		// 	'flex-height' => true,
		// ));
	}
endif;
add_action('after_setup_theme', 'literarybohemian_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function literarybohemian_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('literarybohemian_content_width', 640);
}
add_action('after_setup_theme', 'literarybohemian_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function literarybohemian_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'literarybohemian'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'literarybohemian'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'literarybohemian_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function literarybohemian_scripts()
{
	wp_enqueue_style('literarybohemian-style', get_stylesheet_uri());

	// deregister default jQuery included with Wordpress
	wp_deregister_script( 'jquery' );

	$jquery_cdn = 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js';
	wp_enqueue_script( 'jquery', $jquery_cdn, array(), '3.4.1', true );

	// Enqueue global js
  wp_enqueue_script('literarybohemian-global', get_template_directory_uri() . '/js/global-min.js', array(), time(), true);

	// wp_enqueue_script('literarybohemian-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
	// wp_enqueue_script('literarybohemian-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
	// if (is_singular() && comments_open() && get_option('thread_comments')) {
	// 	wp_enqueue_script('comment-reply');
	// }
}
add_action('wp_enqueue_scripts', 'literarybohemian_scripts');

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


// add_action('init','destination_unknown_add_rewrite');
// function destination_unknown_add_rewrite() {
// 	global $wp;
// 	$wp->add_query_var('destination-unknown');
// 	add_rewrite_rule('destination-unknown/?$', 'index.php?destination-unknown=1', 'top');
// }
//
// add_action('template_redirect','destination_unknown_template');
// function destination_unknown_template() {
// 	if (get_query_var('destination-unknown') == 1) {
//
// 		$posts = get_posts( array(
// 			'post_type' => array('poetry', 'postcard_prose', 'travel_notes',),
// 			'post_status' => 'publish',
// 			'orderby' => 'rand',
// 			'numberposts' => '1',
// 		));
// 		foreach($posts as $post) {
// 			$link = get_permalink($post);
// 		}
// 		wp_redirect($link,307);
// 		exit;
// 	}
// }
