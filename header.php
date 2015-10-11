<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php if ( is_category() ) {
		echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo ' Archive | '; bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
	} elseif ( is_home() || is_front_page() ) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo 'Error 404 Not Found | '; bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title( ' | ', false, right ); bloginfo( 'name' );
	} ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<!-- The HTML5 Shim is required for older browsers, mainly older versions IE -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  <!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
    	<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
    </div>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/grid.css" />
  <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
  <!-- JME-2015-Sept-Mod - Added following two stylesheet entries for responsive adaptation  -->
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?ver=4.3.1' type='text/css' />
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/responsive.css" />
<?php 
 if( is_front_page() ) {
    add_action('wp_enqueue_scripts', 'ca_scripts_init');
    add_action('wp_enqueue_scripts', 'ca_styles_init');
// JME-2015 Added below so always done even if not front page...for responsbile
//} else {
//    add-action('wp_enqueue_scripts', 'ca_scripts_init');
//    add_action('wp_enqueue_scripts', 'ca_styles_init');
 }
 ?>

 	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
  <!--[if lt IE 9]>
  <style type="text/css">
    #searchform input[type="text"], #searchform input[type="submit"], #wpsb input[type="text"], li.comment .comment-body, #commentform input[type=text], #commentform textarea, #post-author, .wp-pagenavi a, .wp-pagenavi span {
      behavior:url(<?php bloginfo('stylesheet_directory'); ?>/PIE.php)
      }
  </style>
  <![endif]-->
  <script type="text/javascript">
  	// initialise plugins
		jQuery(function(){
			// main navigation init
			jQuery('ul.sf-menu').superfish({
				delay:       <?php echo of_get_option('sf_delay'); ?>, 		// one second delay on mouseout 
				animation:   {opacity:'<?php echo of_get_option('sf_f_animation'); ?>',height:'<?php echo of_get_option('sf_sl_animation'); ?>'}, // fade-in and slide-down animation 
				speed:       '<?php echo of_get_option('sf_speed'); ?>',  // faster animation speed 
				autoArrows:  <?php echo of_get_option('sf_arrows'); ?>,   // generation of arrow mark-up (for submenu) 
				dropShadows: <?php echo of_get_option('sf_shadows'); ?>   // drop shadows (for submenu)
			});
			
			// prettyphoto init
			jQuery("a[rel^='prettyPhoto']").prettyPhoto({
				animation_speed:'normal',
				slideshow:5000,
				autoplay_slideshow: false
			});
			
			// easyTooltip init
			jQuery("a.tooltip, .social-networks li a").easyTooltip();
			
		});
		
		// Init for audiojs
		audiojs.events.ready(function() {
			var as = audiojs.createAll();
		});
  </script>

	<script type="text/javascript">
      jQuery(document).ready(function() {
         jQuery("ul.extra li:even").addClass("even");
      });
   </script>

  <script type="text/javascript">
		jQuery(window).load(function() {
			// nivoslider init
			jQuery('#slider').nivoSlider({
				effect: '<?php echo of_get_option('sl_effect'); ?>',
				slices:<?php echo of_get_option('sl_slices'); ?>,
				boxCols:<?php echo of_get_option('sl_box_columns'); ?>,
				boxRows:<?php echo of_get_option('sl_box_rows'); ?>,
				animSpeed:<?php echo of_get_option('sl_animation_speed'); ?>,
				pauseTime:<?php echo of_get_option('sl_pausetime'); ?>,
				directionNav:<?php echo of_get_option('sl_dir_nav'); ?>,
				directionNavHide:<?php echo of_get_option('sl_dir_nav_hide'); ?>,
				controlNav:<?php echo of_get_option('sl_control_nav'); ?>,
				captionOpacity:<?php $sl_caption_opacity = of_get_option('sl_caption_opacity'); if ($sl_caption_opacity != '') { echo of_get_option('sl_caption_opacity'); } else { echo '0'; } ?>
			});
		});
	</script>
  <!-- Custom CSS -->
	<?php if(of_get_option('custom_css') != ''){?>
  <style type="text/css">
  	<?php echo of_get_option('custom_css' ) ?>
  </style>
  <?php }?>
  
  
  
  
  <style type="text/css">
		/* Body styling options */
		<?php $background = of_get_option('body_background');
			if ($background != '') {
				if ($background['image'] != '') {
					echo 'body { background-image:url('.$background['image']. '); background-repeat:'.$background['repeat'].'; background-position:'.$background['position'].';  background-attachment:'.$background['attachment'].'; }';
				}
				if($background['color'] != '') {
					echo 'body { background-color:'.$background['color']. '}';
				}
			};
		?>
		
  	/* Header styling options */
		<?php $header_styling = of_get_option('header_color'); 
			if($header_styling != '') {
				echo '#header {background-color:'.$header_styling.'}';
			}
		?>
		
		/* Links and buttons color */
		<?php $links_styling = of_get_option('links_color'); 
			if($links_styling) {
				echo 'a{color:'.$links_styling.'}';
				echo '.button {background:'.$links_styling.'}';
			}
		?>
		
		/* Body typography */
		<?php $body_typography = of_get_option('body_typography'); 
			if($body_typography) {
				echo 'body {font-family:'.$body_typography['face'].'; color:'.$body_typography['color'].'}';
				echo '#main {font-size:'.$body_typography['size'].'; font-style:'.$body_typography['style'].';}';
			}
		?>
  </style>
</head>

<body <?php body_class(); ?>>

<div id="main"><!-- this encompasses the entire Web site -->

	<header id="header">
   	<div id="header-bg">
         <div class="container_12">
            <div class="grid_12">
            
                  <div class="logo">
							<?php if(of_get_option('logo_type') == 'text_logo'){?>
								<?php if( is_front_page() || is_home() || is_404() ) { ?>
                           <h1><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
                        <?php } else { ?>
                           <h2><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h2>
                        <?php } ?>
							<?php } else { ?>
                        <?php if(of_get_option('logo_url') != ''){ ?>
                           <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                        <?php } else { ?>
                           <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                        <?php } ?>
                     <?php }?>
                     
                  </div>
        
                  <div id="widget-header">
                      <?php if ( ! dynamic_sidebar( 'Header Area' ) ) : ?>
                        <!--Widgetized Footer-->
                     <?php endif ?>
                  </div>
        
                  <nav class="primary">
							<?php wp_nav_menu( array(
								'container'       => 'ul', 
								'menu_class'      => 'sf-menu', 
								'menu_id'         => 'topnav',
								'depth'           => 0,
								'theme_location' => 'header_menu' 
                       ));
                     ?>
                  </nav><!--.primary-->
				  
				  <nav class="mobile-primary">
					<div class="wrapper ">
					<div id="ac-mobile-menu-button">
                                            <button id="mobile-menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                                <span id="mob-button-icon-hamburger"><i class="fa fa-bars fa-lg mobile-menu-is-closed the-active-mob-menu-icon"></i></span>
                                                <span id="mob-button-icon-anex"><i class="fa fa-times fa-lg mobile-menu-is-open"></i></span>
                                            </button>
                                        </div>
					<div id="ac-mobile-menu">

							<?php wp_nav_menu( array(
								'container'       => 'ul',
//    commented the Super Fish Menu out to stop it's effects for Mobile menu                                                        
//								'menu_class'      => 'sf-menu', 
								'menu_id'         => 'mobile-topnav',
								'depth'           => 0,
								'theme_location' => 'header_menu' 
							));
							?>
							
                  </nav><!--.mobile-primary-->
				  
				  
      			
            </div>
         </div><!--.container-->
      </div>
   </header>
   
	<?php if( is_front_page() ) { ?>
    <section class="hm-carousel">
        
        <div class="container_12 flash-line">
            <div class="carousel-container">
 
            <!-- BEGIN #icarousel element container -->
                <div id="icarousel">
                    <?php 
                        $images_page = get_page_by_title( 'Slide Show Images' );
               
                        $args = array(
                            'post_type' => 'attachment',
                            'numberposts' => -1,
                            'orderby'=> 'menu_order',
                            'order' => 'ASC',
                            'post_mime_type' => 'image',
                            'post_status' => null,
                            'post_parent' => $images_page->ID
                        );

                        $attachments = get_posts( $args );
                            if ( $attachments ) {
                                foreach ( $attachments as $attachment ) {
                                    echo '<div class="slide">';
                                    echo wp_get_attachment_image($attachment->ID , 'full' );
                                    echo '<div class="caption">'. $attachment->post_excerpt . '</div>';
                                    echo '</div>';
                            }
                        }
                    ?>
                </div>
            <!-- END #icarousel element container -->
 
            </div>
        <!-- END CONTAINER -->
                
                
                
                <script type="text/javascript">
                     jQuery(document).ready(function(){
                        jQuery('#icarousel').iCarousel({
                            slides: 3,
                            slidesSpace: 250, 
                            animationSpeed: 750, 
                            pauseTime: 6000
                        });
                    });
                </script>
                  
            </div>
      </section><!--#slider-->
   <?php } ?>

	<div class="primary_content_wrap">
   	<div class="primary_content_bg">
         <div class="container_12 clearfix">
            <div class="grid_12">
               <div class="wrapper">