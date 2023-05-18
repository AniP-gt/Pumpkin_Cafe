<?php
/**
 * pumpkin_cafe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pumpkin_cafe
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pumpkin_cafe_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on pumpkin_cafe, use a find and replace
		* to change 'pumpkin_cafe' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pumpkin_cafe', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'pumpkin_cafe' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pumpkin_cafe_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pumpkin_cafe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pumpkin_cafe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pumpkin_cafe_content_width', 640 );
}
add_action( 'after_setup_theme', 'pumpkin_cafe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pumpkin_cafe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pumpkin_cafe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pumpkin_cafe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pumpkin_cafe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pumpkin_cafe_scripts() {
	wp_enqueue_style( 'reset-style', get_template_directory_uri() . './reset.css', array(), _S_VERSION );
	wp_enqueue_style( 'pumpkin_cafe-style', get_stylesheet_uri(), array('reset-style'), _S_VERSION );
	wp_style_add_data( 'pumpkin_cafe-style', 'rtl', 'replace' );

	wp_enqueue_script( 'pumpkin_cafe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'pumpkin_cafe-main', get_template_directory_uri() . '/js/main.js', array('pumpkin_cafe-navigation'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pumpkin_cafe_scripts' );

/**
 * Enqueue jQuery
 */
function use_wp_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', includes_url('/js/jquery/jquery.min.js'), array(), '3.6.0', false);
}
add_action('wp_enqueue_scripts', 'use_wp_jquery');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Enqueue jQuery
 */
function add_jquery_map() {

}
add_action( 'wp_enqueue_scripts', 'add_jquery_map' );


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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// blogのarchiveのURIの設定
function post_has_archive($args, $post_type) {
	if ('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog';
		$args['label'] = 'ブログ';
	}
	return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// the_archive_descriptionを文字制限するカスタマイズ
function custom_archive_description() {
	$description = get_the_archive_description();
	$trimmed_description = wp_trim_words( $description, 20, '...' ); // 20は制限したい文字数です。適宜変更してください。
	echo '<div class="archive-description">' . $trimmed_description . '</div>';
}

/* the_archive_title 余計な文字を削除 */
add_filter( 'get_the_archive_title', function ($title) {
	if (is_category()) {
			$title = single_cat_title('',false);
	} elseif (is_tag()) {
			$title = single_tag_title('',false);
	} elseif (is_tax()) {
			$title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
			$title = get_the_time('Y年n月');
	} elseif (is_search()) {
			$title = '検索結果：'.esc_html( get_search_query(false) );
	} elseif (is_404()) {
			$title = '「404」ページが見つかりません';
	} else {
		// なにもしない
	}
		return $title;
});
