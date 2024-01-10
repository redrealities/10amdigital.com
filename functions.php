<?php
define('THEME_SLUG', '10am-theme');
define('THEME_VERSION', '1.0.0');
define('THEME_IN_DEV', false);

add_theme_support('post-thumbnails');

add_action('wp_head', function() {
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y7FC9FH99R"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-Y7FC9FH99R');
</script>
<?php
});

add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style(THEME_SLUG . '-normalize-style', get_stylesheet_directory_uri() . '/vendor/normalize.min.css', array(), THEME_VERSION);
  if(THEME_IN_DEV) {
    wp_enqueue_style(THEME_SLUG . '-style', get_stylesheet_directory_uri() . '/styles/all.css', array(), THEME_VERSION);
  } else {
    wp_enqueue_style(THEME_SLUG . '-style', get_stylesheet_directory_uri() . '/styles/combined-'.THEME_VERSION.'.css', array(), THEME_VERSION);
  }
}, 100);

add_action('enqueue_block_editor_assets', function() {
	$version = filemtime(get_template_directory() . '/styles/all.css');
	wp_enqueue_style('regular-styles', get_template_directory_uri() . '/styles/combined.css', [], $version);
});

remove_action('wp_head', 'print_emoji_detection_script', 7); 
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_footer', 'the_block_template_skip_link');
add_action('wp_enqueue_scripts', function() {
  wp_dequeue_style('global-styles');
  wp_dequeue_style('wp-block-list');
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-blocks-style');

  global $wp_styles;

	foreach($wp_styles->queue as $key => $handle) {
		if(strpos($handle, 'wp-block-') === 0) {
			wp_dequeue_style( $handle );
		}
	}

  wp_enqueue_script(THEME_SLUG . '-script__serverless-mailer', get_template_directory_uri() . '/vendor/serverless_mailer.js',  array(), THEME_VERSION, true);
  wp_enqueue_script(THEME_SLUG . '-script__distance-estimator', get_template_directory_uri() . '/scripts/distance-estimator.js',  array(), THEME_VERSION, true);
  wp_enqueue_script(THEME_SLUG . '-script__visible-tag', get_template_directory_uri() . '/scripts/visible-tag.js',  array(), THEME_VERSION, true);
  wp_enqueue_script(THEME_SLUG . '-script__letterise-tag.js', get_template_directory_uri() . '/scripts/letterise-tag.js',  array(), THEME_VERSION, true);
  wp_enqueue_script(THEME_SLUG . '-script__general.js', get_template_directory_uri() . '/scripts/general.js',  array(), THEME_VERSION, true);

}, 99);
?>
