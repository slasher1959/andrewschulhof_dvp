<?php
/*
 * Custom functions for Cynthia Aasen theme
 * 
 * Adds additional widget areas for the theme
 * 
 */

function ca_widget_init() {
	
        // Header Area 
	// Location: top - right of the header
	register_sidebar(array(
		'name'					=> 'Header Area',
		'id' 						=> 'header-area',
		'description'   => __( 'Located at the right side of the header.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	// Footer Area 5
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Footer Area 5',
		'id' 						=> 'footer-area-5',
		'description'   => __( 'Located at the left side of the footer.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	 
}

add_action( 'widgets_init', 'ca_widget_init' );

function ca_scripts_init() {
        wp_enqueue_script(
            'ca-raphael-script',
            get_stylesheet_directory_uri() . '/js/raphael-min.js',
            array('jquery')
        );  
        wp_enqueue_script(
            'ca-mousewheel-script',
            get_stylesheet_directory_uri() . '/js/jquery.mousewheel.js',
            array('jquery')
        );  
        wp_enqueue_script(
            'ca-icarousel-script',
            get_stylesheet_directory_uri() . '/js/icarousel.packed.js',
//  JME-2015 commented below out
//            array('ca-raphael-script', 'ca-mousewheel-script')
            array('jquery')
        );
        wp_enqueue_script(
            'responsive-script',
            get_stylesheet_directory_uri() . '/js/jquery.responsive.js',
//  JME-2015 commented below out
//            array('ca-raphael-script', 'ca-mousewheel-script')
            array('jquery')
        );

    }  

function ca_scripts_init_non_front_page() {
        wp_enqueue_script(
            'responsive-script',
            get_stylesheet_directory_uri() . '/js/jquery.responsive.js',
            array('jquery')
        );

    } 

add_action('wp_enqueue_scripts', 'ca_scripts_init_non_front_page');

function ca_styles_init() { 
        wp_register_style( 
            'ca-icarousel-style', 
            get_stylesheet_directory_uri() . '/css/icarousel.css' 
        );

        wp_enqueue_style( 'ca-icarousel-style' );

        wp_register_style( 
            'ca-override-events-style', 
            get_stylesheet_directory_uri() . '/css/override_events.css' ,
            array('tribe-events-calendar-style')
        );

        wp_enqueue_style( 'ca-override-events-style' );
		
	    wp_enqueue_script(
	        'ca-misc-script',
	        get_stylesheet_directory_uri() . '/js/ca_script.js',
	        array('jquery')
	    );
    }

add_action('wp_enqueue_scripts', 'ca_styles_init');

class embed_page extends WP_Widget {

    function embed_page() {
        $widget_options = array(
            'description' => 'A widget to display content from a page.'
        );
        $this->WP_Widget('embed_page', 'Embed Page', $widget_options);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP );
        // Get widget values from DB:
        $embed_page_id = ( $instance['embed_page_id']) ? $instance['embed_page_id'] : '$0';
        $embed_page = get_post($embed_page_id);
        if ($embed_page) {
            ?>
            <?php echo $before_widget; ?>
            <div class="embed-content">
                <?php echo apply_filters('the_content', $embed_page->post_content); ?>
            </div>
            <?php echo $after_widget;
        }
    }

    function form($instance) {
        ?>
        <label for="<?php echo $this->get_field_id('embed_page_id') ?>">
            Page ID for page with content to display:
            <input id="<?php echo $this->get_field_id('embed_page_id') ?>"
                   name="<?php echo $this->get_field_name('embed_page_id') ?>"
                   value="<?php echo esc_attr($instance['embed_page_id'])?>" />
        </label>
    <?php
    }
}

add_action('widgets_init', create_function('', 'return register_widget("embed_page");'));


function ca_password_form()
{
    global $post;

    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

    $o = '<div class="ca-passwd-area">';
    $o .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post"><p>
    ' . __("To view this protected page, please enter the password below:") . '</p>
	<div class="form-border">
    <label for="' . $label . '">' . __("Password:") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit") . '" />
	</div>
    </form>
    ';
    $o .= '</div>';

    $signup_form = get_post_meta($post->ID, 'register_form_shortcode', true);
    if ($signup_form != '') {
        $o .= '<div class="ca-requestform-area">';
        $o .= do_shortcode($signup_form);
        $o .= '</div>';

    }

    return $o;
}

add_filter( 'the_password_form', 'ca_password_form' );

/* Short Codes */

/**
 * Shortcode: divider
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function ca_divider_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'top' => false
    ), $atts ) );

    return ( $top ) ? '<div class="su-divider"><a href="#" onclick="ca_to_top()">' . __( 'Top', 'shortcodes-ultimate' ) . '</a></div>' : '<div class="su-divider"></div>';
}

add_shortcode( 'ca_divider', 'ca_divider_shortcode' );
    
?>