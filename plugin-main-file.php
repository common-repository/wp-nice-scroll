<?php

/*
	Plugin Name: WP Nice Scroll
	Plugin URI: http://www.muhaimin.info
	Author: Muhaimin Islam
	Author URI: http://www.muhaimin.info
	Version: 1.0
	Description: WP Nice Scroll helps to create fency scrollbar in website.
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/********** Enqueue JS File *********/

function wp_nice_scroll_script(){
	wp_enqueue_script( 'wp-nice-scroll-js', plugins_url( '/js/jquery.nicescroll.min.js', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'wp_nice_scroll_script' );

/********** WP Nice Scroll Initialization *********/

function wp_nice_scroll_init(){ ?>
	<?php
		$options = get_option( 'wp_nice_scroll_section' );
		$enable = $options['nice_scroll_enable'];
		
		echo $enable;
		
		if($enable == "yes"):
		
			$autoHide = $options['nice_scroll_auto_hide'];
			if($autoHide == "yes"){
				$hide = "true";
			}else{
				$hide = "false";
			}
	?>
	<script type="text/javascript">
		jQuery("html").niceScroll({
			background: "<?php echo $options['scrollbar_bg_color']; ?>", // change css for rail background
			cursorcolor: "<?php echo $options['scrollbar_cursor_bg']; ?>", // change cursor color in hex
			cursoropacitymin: 0, // change opacity when cursor is inactive (scrollabar "hidden" state), range from 1 to 0
			cursoropacitymax: 1, // change opacity when cursor is active (scrollabar "visible" state), range from 1 to 0
			cursorwidth: "<?php echo $options['scrollbar_width']; ?>px", // cursor width in pixel (you can also write "5px")
			cursorborder: "none", // css definition for cursor border
			cursorborderradius: "<?php echo $options['scrollbar_radius']; ?>px", // border radius in pixel for cursor
			scrollspeed: <?php echo $options['scroll_speed']; ?>, // scrolling speed
			autohidemode: <?php echo $hide; ?>, // how hide the scrollbar works, possible values:
			bouncescroll: false, // (only hw accell) enable scroll bouncing at the end of content as mobile-like
			smoothscroll: true, // scroll with ease movement
			hidecursordelay: <?php echo $options['hide_curson_delay']; ?>, // set the delay in microseconds to fading out scrollbars
		});
	</script>
	<?php
		endif;
	?>
<?php
}
add_action( 'wp_footer', 'wp_nice_scroll_init' );

/********* Settings *********/
require_once dirname(__FILE__) . '/inc/class.settings-api.php';
require_once dirname(__FILE__) . '/inc/option-panel.php';
new WP_Nice_Scroll_Settings();

