<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

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
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

	function my_custom_post_download() {
		$labels = array(
			'name' => '资料下载'
		);
		$args = array(
			'labels'        => $labels,
			'public' => true,
			'menu_position' => 2,
			'supports'      => array('title','excerpt', 'editor','thumbnail','page-attributes'),
			'taxonomies' => array('post_tag'),
			'has_archive' => true
		);
		register_post_type( 'download', $args );
	}
	add_action( 'init', 'my_custom_post_download' );
	
	function my_custom_post_story() {
		$labels = array(
			'name' => '昆杜故事'
		);
		$args = array(
			'labels'        => $labels,
			'public' => true,
			'menu_position' => 2,
			'supports'      => array('title','excerpt', 'editor','thumbnail','page-attributes'),
			'taxonomies' => array('post_tag'),
			'has_archive' => true
		);
		register_post_type( 'story', $args );
	}
	add_action( 'init', 'my_custom_post_story' );

	function my_taxonomies_ac_co() {
		$labels = array(
			'name'              => '分类目录',
			'singular_name'     => '分类目录'
		);
		$blog_id = get_current_blog_id();
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'query_var' => true,
			'show_admin_column' => true
		);
		register_taxonomy( 'category_story', array('story'), $args );
		register_taxonomy( 'category_graduate', array('graduate'), $args );
	}
	add_action( 'init', 'my_taxonomies_ac_co');
}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
		'footer1'   => __( 'FOOTER 1', 'twentytwenty' ),
		'footer2'   => __( 'FOOTER 2', 'twentytwenty' ),
		'footer3'   => __( 'FOOTER 3', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}

show_admin_bar(false);

add_action( 'admin_init', 'my_admin' );
function my_admin(){
    add_meta_box('post_review_meta_box',
        '自定义数据',
        'display_page_review_meta_box',
        'page', 'normal', 'high'
    );
    add_meta_box('post_review_meta_box',
        '自定义数据',
        'display_download_review_meta_box',
        'download', 'normal', 'high'
    );
    add_meta_box('post_review_meta_box',
        '自定义数据',
        'display_story_review_meta_box',
        'story', 'normal', 'high'
    );
    add_meta_box('post_review_meta_box',
        '自定义数据',
        'display_graduate_review_meta_box',
        'graduate', 'normal', 'high'
    );

    wp_enqueue_script( 'upload-image', get_template_directory_uri() . '/assets/js/upload.js', array('jquery'), '20201005', true );
    //wp_enqueue_media();
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_style('thickbox');
}

/* 生成自定义数据 */
function display_page_review_meta_box($magazine_review){
	$blog_id = get_current_blog_id();
    // $title = esc_html( get_post_meta( $magazine_review->ID, 'title', true ) );
    // $description = esc_html( get_post_meta( $magazine_review->ID, 'description', true ) );
    // $keywords = esc_html( get_post_meta( $magazine_review->ID, 'keywords', true ) );
    // echo 'title: ';
    // echo '<input class="title" style = "width: 100%;" type="text" name="title" value="' .  esc_attr($title).'">';
    // echo '<br>';
    // echo 'description: ';
    // echo '<input class="description" style = "width: 100%;" type="text" name="description" value="' .  esc_attr($description).'">';
    // echo '<br>';
    // echo 'keywords: ';
    // echo '<input class="keywords" style = "width: 100%;" type="text" name="keywords" value="' .  esc_attr($keywords).'">';
    // echo '<br><br>';

    $upload_dir = wp_upload_dir();
    
	global $post;
	//echo $magazine_review->post_name;
	if($magazine_review->ID==173){
		echo '<br>';
		echo 'footer logo<br>';
		$banner = esc_html( get_post_meta( $magazine_review->ID, 'banner9', true ) );
		echo '<input class="banner9" type="hidden" name="banner9" value="' .  esc_attr($banner).'">';
		if (!empty($banner)){
			echo '<img class="banner9_img" src="' .  esc_attr($banner).'" style="width:100px; height:100px" />';
		}
		else{
			echo '<img class="banner9_img" style="width:100px; height:100px" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
		}
		echo '<br>';
		echo '<button class ="banner9_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
		echo '<br>';
		echo '<button class ="cancel9" style = "width: 100px; height: 30px;  "/>Cancel</button>';
		echo '<br><br>';
		echo 'wechat<br>';
		$banner = esc_html( get_post_meta( $magazine_review->ID, 'banner25', true ) );
		echo '<input class="banner25" type="hidden" name="banner25" value="' .  esc_attr($banner).'">';
		if (!empty($banner)){
			echo '<img class="banner25_img" src="' .  esc_attr($banner).'" style="width:100px; height:100px" />';
		}
		else{
			echo '<img class="banner25_img" style="width:100px; height:100px" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
		}
		echo '<br>';
		echo '<button class ="banner25_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
		echo '<br>';
		echo '<button class ="cancel25" style = "width: 100px; height: 30px;  "/>Cancel</button>';
		echo '<br><br>';

		echo 'Image: (***×100)';
		echo '<br><ul>';
		for($i=1;$i<9;$i++){
			$banner1 = esc_html( get_post_meta( $magazine_review->ID, 'banner'.$i, true ) );
			echo '<li style="width: 25%;display: inline-block;">';
			echo "<div style='width: 50%;display: inline-block;'>";
			echo '<input class="banner'.$i.'" type="hidden" name="banner'.$i.'" value="' .  esc_attr($banner1).'">';
			if (!empty($banner1)){
				echo '<img class="banner'.$i.'_img" src="' .  esc_attr($banner1).'" style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;" />';
			}
			else{
				echo '<img class="banner'.$i.'_img" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;"  />';
			}
			
			echo '<br><button class ="banner'.$i.'_bt" style = "width: 90%; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
			echo '<br>';
			echo '<button class ="cancel'.$i.'" style = "width: 90%; height: 30px;  "/>Cancel</button>';
			echo '</div><div style="width: 50%;display: inline-block;">';
			$j = $i+9; 
			$banner1 = esc_html( get_post_meta( $magazine_review->ID, 'banner'.$j, true ) );
			echo '<input class="banner'.$j.'" type="hidden" name="banner'.$j.'" value="' .  esc_attr($banner1).'">';
			if (!empty($banner1)){
				echo '<img class="banner'.$j.'_img" src="' .  esc_attr($banner1).'" style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;" />';
			}
			else{
				echo '<img class="banner'.$j.'_img" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;"  />';
			}
			
			echo '<br><button class ="banner'.$j.'_bt" style = "width: 90%; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
			echo '<br>';
			echo '<button class ="cancel'.$j.'" style = "width: 90%; height: 30px;  "/>Cancel</button>';
			echo '</div>';

			$name = esc_html( get_post_meta( $magazine_review->ID, 'name'.$i, true ) );
			echo '<br>';
			echo '<input class="name" style = "width: 95%;margin: 5px 0;" type="text" name="name'.$i.'" value="' .  esc_attr(get_post_meta( $magazine_review->ID, 'name'.$i, true )).'">';
			$link = esc_html( get_post_meta( $magazine_review->ID, 'link'.$i, true ) );
			echo '<br>';
			echo '<input class="link" style = "width: 95%;" type="text" name="link'.$i.'" value="' .  esc_attr(get_post_meta( $magazine_review->ID, 'link'.$i, true )).'"></li>';
		}
		echo '</ul>';
		echo '<br><br>';

		echo 'Mobile popup Image: (119×113)';
		echo '<br><ul>';
		for($i=18;$i<25;$i++){
			$banner1 = esc_html( get_post_meta( $magazine_review->ID, 'banner'.$i, true ) );
			echo '<li style="width: 25%;display: inline-block;">';
			echo '<input class="banner'.$i.'" type="hidden" name="banner'.$i.'" value="' .  esc_attr($banner1).'">';
			if (!empty($banner1)){
				echo '<img class="banner'.$i.'_img" src="' .  esc_attr($banner1).'" style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;" />';
			}
			else{
				echo '<img class="banner'.$i.'_img" style="width:100px; height:100px" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;"  />';
			}
			
			echo '<br><button class ="banner'.$i.'_bt" style = "width: 95%; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
			echo '<br>';
			echo '<button class ="cancel'.$i.'" style = "width: 95%; height: 30px;  "/>Cancel</button>';

			$name = esc_html( get_post_meta( $magazine_review->ID, 'name'.$i, true ) );
			echo '<input class="name" style = "width: 95%;margin: 5px 0;" type="text" name="name'.$i.'" value="' .  esc_attr(get_post_meta( $magazine_review->ID, 'name'.$i, true )).'">';
			$link = esc_html( get_post_meta( $magazine_review->ID, 'link'.$i, true ) );
			echo '<br>';
			echo '<input class="link" style = "width: 95%;" type="text" name="link'.$i.'" value="' .  esc_attr(get_post_meta( $magazine_review->ID, 'link'.$i, true )).'"></li>';
		}
		echo '</ul>';
	}elseif($magazine_review->ID==187){
		$title0 = esc_html( get_post_meta( $magazine_review->ID, 'title0', true ) );
		echo 'Subtitle: ';
		echo '<input class="title0" style = "width: 100%;" type="text" name="title0" value="' .  esc_attr($title0).'">';
		echo '<br>';

		echo '<br><ul>';
		for($i=1;$i<7;$i++){
			$intro = esc_html( get_post_meta( $magazine_review->ID, 'intro'.$i, true ) );
			echo '<li style="width: 30%;margin-right: 3%;display: inline-block;"><br>';
			wp_editor( htmlspecialchars_decode($intro), 'intro'.$i, $settings = array('textarea_name'=>'intro'.$i, 'editor_height' => 100,'textarea_rows' => 5, 'media_buttons' => false, 'quicktags' =>true) );
			echo '<br></li>';
		}
		echo '</ul>';
		$intro = esc_html( get_post_meta( $magazine_review->ID, 'intro7', true ) );
		echo '<br>';
		wp_editor( htmlspecialchars_decode($intro), 'intro7', $settings = array('textarea_name'=>'intro7', 'editor_height' => 100,'textarea_rows' => 5, 'media_buttons' => false, 'quicktags' =>true) );
		echo 'Image: ';
		echo '<br><ul>';
		for($i=1;$i<5;$i++){
			$banner1 = esc_html( get_post_meta( $magazine_review->ID, 'banner'.$i, true ) );
			echo '<li style="width: 23%;margin-right: 2%;display: inline-block;"><input class="banner'.$i.'" type="hidden" name="banner'.$i.'" value="' .  esc_attr($banner1).'">';
			if (!empty($banner1)){
				echo '<img class="banner'.$i.'_img" src="' .  esc_attr($banner1).'" style="width:100px; height:100px;background: url('.site_url().'/wp-content/uploads/back.png");background-size: 100% 100%;" />';
			}
			else{
				echo '<img class="banner'.$i.'_img" style="width:100px; height:100px" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
			}
			echo '<br>';
			echo '<button class ="banner'.$i.'_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
			echo '<br>';
			echo '<button class ="cancel'.$i.'" style = "width: 100px; height: 30px;  "/>Cancel</button>';
			echo '</li>';
		}
		echo '</ul>';
		echo '<br><ul>';
		for($i=5;$i<13;$i++){
			$banner1 = esc_html( get_post_meta( $magazine_review->ID, 'banner'.$i, true ) );
			echo '<li style="width: 23%;margin-right: 2%;display: inline-block;"><input class="banner'.$i.'" type="hidden" name="banner'.$i.'" value="' .  esc_attr($banner1).'">';
			if (!empty($banner1)){
				echo '<img class="banner'.$i.'_img" src="' .  esc_attr($banner1).'" style="width:100px; height:100px;" />';
			}
			else{
				echo '<img class="banner'.$i.'_img" style="width:100px; height:100px" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
			}
			echo '<br>';
			echo '<button class ="banner'.$i.'_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
			echo '<br>';
			echo '<button class ="cancel'.$i.'" style = "width: 100px; height: 30px;  "/>Cancel</button>';
			echo '<br>';
			$text = esc_html( get_post_meta( $magazine_review->ID, 'text'.$i, true ) );
			wp_editor( htmlspecialchars_decode($text), 'text'.$i, $settings = array('textarea_name'=>'text'.$i, 'editor_height' => 100,'textarea_rows' => 5, 'media_buttons' => false, 'quicktags' =>true) );
			echo '<br></li>';
		}
		echo '</ul>';
	}
}
function display_download_review_meta_box($magazine_review){
	echo '文件';
	echo '<br>';
	$bannerpdf = esc_html( get_post_meta( $magazine_review->ID, 'bannerpdf', true ) );
	echo '<input class="bannerpdf" type="hidden" name="bannerpdf" value="' .  esc_attr($bannerpdf).'">';
	if (!empty($bannerpdf)){
		echo '<img class="bannerpdf_img" style="width:150px;" src= "'.site_url().'/wp-content/uploads/time.jpg"  />';
	}
	else{
		echo '<img class="bannerpdf_img" style="width:150px;" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
	}
	echo '<br>';
	echo '<button class ="bannerpdf_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>上传pdf</button>';
	echo '<br>';
	echo '<button class ="cancelpdf" style = "width: 100px; height: 30px;  "/>Cancel</button></li>';
	echo '<br><br>';
}
function display_story_review_meta_box($magazine_review){
	if(has_term('xsgs', 'category_story', $post)){
		echo '<textarea rows="4" style="width: 95%;" name="intro">' . esc_attr(get_post_meta( $magazine_review->ID, 'intro', true )) . '</textarea>';
		echo '<br>';
		echo '列表页图片';
		echo '<br>';
		$banner = esc_html( get_post_meta( $magazine_review->ID, 'banner', true ) );
		echo '<input class="banner" type="hidden" name="banner" value="' .  esc_attr($banner).'">';
		if (!empty($banner)){
			echo '<img class="banner_img" src="' .  esc_attr($banner).'" style="width:150px;" />';
		}
		else{
			echo '<img class="banner_img" style="width:150px;" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
		}
		echo '<br>';
		echo '<button class ="banner_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
		echo '<br>';
		echo '<button class ="cancel" style = "width: 100px; height: 30px;  "/>Cancel</button></li>';
	}
}
function display_graduate_review_meta_box($magazine_review){
	echo '列表页图片';
	echo '<br>';
	$banner = esc_html( get_post_meta( $magazine_review->ID, 'banner', true ) );
	echo '<input class="banner" type="hidden" name="banner" value="' .  esc_attr($banner).'">';
	if (!empty($banner)){
		echo '<img class="banner_img" src="' .  esc_attr($banner).'" style="width:150px;" />';
	}
	else{
		echo '<img class="banner_img" style="width:150px;" src= "'.site_url().'/wp-content/uploads/nopic.jpg"  />';
	}
	echo '<br>';
	echo '<button class ="banner_bt" style = "width: 100px; height: 30px;margin-bottom: 5px;"/>Upload image</button>';
	echo '<br>';
	echo '<button class ="cancel" style = "width: 100px; height: 30px;  "/>Cancel</button></li>';
}

/* 保存自定义数据 */
function add_magazine_review_fields($magazine_review_id, $magazine_review){
	global $post;
    // if (isset($_POST['title'])) {
    //     update_post_meta($magazine_review_id, 'title', $_POST['title']);
    // }
    // if (isset($_POST['description'])) {
    //     update_post_meta($magazine_review_id, 'description', $_POST['description']);
    // }
    // if (isset($_POST['keywords'])) {
    //     update_post_meta($magazine_review_id, 'keywords', $_POST['keywords']);
	// }
	
	if( $magazine_review_id == '173') {//aboutus
        for($i=1;$i<25;$i++) {
            if (isset($_POST['name'.$i])) {
                update_post_meta($magazine_review_id, 'name'.$i, $_POST['name'.$i]);
            }
            if (isset($_POST['link'.$i])) {
                update_post_meta($magazine_review_id, 'link'.$i, $_POST['link'.$i]);
            }
            if (isset($_POST['banner'.$i])) {
                update_post_meta($magazine_review_id, 'banner'.$i, $_POST['banner'.$i]);
            }
        }
		if (isset($_POST['banner25'])) {
			update_post_meta($magazine_review_id, 'banner25', $_POST['banner25']);
		}
	}elseif($magazine_review->ID==187){
        if (isset($_POST['title0'])) {
            update_post_meta($magazine_review_id, 'title0', $_POST['title0']);
        }
        for($i=1;$i<8;$i++) {
            if (isset($_POST['intro'.$i])) {
                update_post_meta($magazine_review_id, 'intro'.$i, $_POST['intro'.$i]);
            }
        }
        for($i=1;$i<5;$i++) {
            if (isset($_POST['banner'.$i])) {
                update_post_meta($magazine_review_id, 'banner'.$i, $_POST['banner'.$i]);
            }
        }
        for($i=5;$i<13;$i++) {
            if (isset($_POST['text'.$i])) {
                update_post_meta($magazine_review_id, 'text'.$i, $_POST['text'.$i]);
            }
            if (isset($_POST['banner'.$i])) {
                update_post_meta($magazine_review_id, 'banner'.$i, $_POST['banner'.$i]);
            }
        }
	}elseif( $magazine_review->post_type == 'download' ){
        if (isset($_POST['bannerpdf'])) {
            update_post_meta($magazine_review_id, 'bannerpdf', $_POST['bannerpdf']);
        }
	}elseif(has_term('xsgs', 'category_story', $post)){

        if (isset($_POST['intro'])) {
            update_post_meta($magazine_review_id, 'intro', $_POST['intro']);
        }
        if (isset($_POST['banner'])) {
            update_post_meta($magazine_review_id, 'banner', $_POST['banner']);
        }
	}elseif( $magazine_review->post_type == 'graduate' ){
        if (isset($_POST['banner'])) {
            update_post_meta($magazine_review_id, 'banner', $_POST['banner']);
        }
	}
}
add_action( 'save_post', 'add_magazine_review_fields', 10, 7 );

//模板
add_action('template_include', 'load_single_template');
function load_single_template($template) {
    $new_template = '';
    if( is_single() ) {
		global $post;
        if( has_term('xsgs', 'category_story', $post) ) {
            $new_template = locate_template(array('single-xsgs.php' ));
        }
	}

    return ('' != $new_template) ? $new_template : $template;
}