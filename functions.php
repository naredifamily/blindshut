<?php

/**

 * Blindshut functions and definitions

 *

 * Set up the theme and provides some helper functions, which are used in the

 * theme as custom template tags. Others are attached to action and filter

 * hooks in WordPress to change core functionality.

 *

 * When using a child theme you can override certain functions (those wrapped

 * in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before

 * the parent theme's file, so the child theme functions would be used.

 *

 * @link https://codex.wordpress.org/Theme_Development

 * @link https://codex.wordpress.org/Child_Themes

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are

 * instead attached to a filter or action hook.

 *

 * For more information on hooks, actions, and filters,

 * {@link https://codex.wordpress.org/Plugin_API}

 *

 * @package WordPress

 * @subpackage Blind_Shut

 * @since Blindshut 1.0

 */



/**

 * Blindshut only works in WordPress 4.4 or later.

 */

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {

	require get_template_directory() . '/inc/back-compat.php';

}



if ( ! function_exists( 'blindshut_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 *

 * Create your own blindshut_setup() function to override in a child theme.

 *

 * @since Blindshut 1.0

 */

function blindshut_setup() {

	/*

	 * Make theme available for translation.

	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/blindshut

	 * If you're building a theme based on Blindshut, use a find and replace

	 * to change 'blindshut' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'blindshut' );



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

	 * Enable support for custom logo.

	 *

	 *  @since Blindshut 1.2

	 */

	add_theme_support( 'custom-logo', array(

		'height'      => 240,

		'width'       => 240,

		'flex-height' => true,

	) );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 1200, 9999 );



	// This theme uses wp_nav_menu() in two locations.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'blindshut' ),

		'social'  => __( 'Social Links Menu', 'blindshut' ),

	) );



	/*

	 * Switch default core markup for search form, comment form, and comments

	 * to output valid HTML5.

	 */

	add_theme_support( 'html5', array(

		'search-form',

		'comment-form',

		'comment-list',

		'gallery',

		'caption',

	) );



	/*

	 * Enable support for Post Formats.

	 *

	 * See: https://codex.wordpress.org/Post_Formats

	 */

	add_theme_support( 'post-formats', array(

		'aside',

		'image',

		'video',

		'quote',

		'link',

		'gallery',

		'status',

		'audio',

		'chat',

	) );



	/*

	 * This theme styles the visual editor to resemble the theme style,

	 * specifically font, colors, icons, and column width.

	 */

	add_editor_style( array( 'css/editor-style.css', blindshut_fonts_url() ) );



	// Indicate widget sidebars can use selective refresh in the Customizer.

	add_theme_support( 'customize-selective-refresh-widgets' );

}

endif; // blindshut_setup

add_action( 'after_setup_theme', 'blindshut_setup' );



/**

 * Sets the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 *

 * @since Blindshut 1.0

 */

function blindshut_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'blindshut_content_width', 840 );

}

add_action( 'after_setup_theme', 'blindshut_content_width', 0 );



/**

 * Registers a widget area.

 *

 * @link https://developer.wordpress.org/reference/functions/register_sidebar/

 *

 * @since Blindshut 1.0

 */

function blindshut_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Sidebar', 'blindshut' ),

		'id'            => 'sidebar-1',

		'description'   => __( 'Add widgets here to appear in your sidebar.', 'blindshut' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );



	register_sidebar( array(

		'name'          => __( 'Content Bottom 1', 'blindshut' ),

		'id'            => 'sidebar-2',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'blindshut' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );



	register_sidebar( array(

		'name'          => __( 'Content Bottom 2', 'blindshut' ),

		'id'            => 'sidebar-3',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'blindshut' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

	

	register_sidebar( array(

		'name'          => __( 'Header top Phone', 'blindshut' ),

		'id'            => 'sidebar-4',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'blindshut' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

	

		register_sidebar( array(

		'name'          => __( 'Untill saturday Block', 'blindshut' ),

		'id'            => 'sidebar-5',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'blindshut' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

	

	

	

}

add_action( 'widgets_init', 'blindshut_widgets_init' );



if ( ! function_exists( 'blindshut_fonts_url' ) ) :

/**

 * Register Google fonts for Blindshut.

 *

 * Create your own blindshut_fonts_url() function to override in a child theme.

 *

 * @since Blindshut 1.0

 *

 * @return string Google fonts URL for the theme.

 */

function blindshut_fonts_url() {

	$fonts_url = '';

	$fonts     = array();

	$subsets   = 'latin,latin-ext';



	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'blindshut' ) ) {

		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';

	}



	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'blindshut' ) ) {

		$fonts[] = 'Montserrat:400,700';

	}



	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'blindshut' ) ) {

		$fonts[] = 'Inconsolata:400';

	}



	if ( $fonts ) {

		$fonts_url = add_query_arg( array(

			'family' => urlencode( implode( '|', $fonts ) ),

			'subset' => urlencode( $subsets ),

		), 'https://fonts.googleapis.com/css' );

	}



	return $fonts_url;

}

endif;



/**

 * Handles JavaScript detection.

 *

 * Adds a `js` class to the root `<html>` element when JavaScript is detected.

 *

 * @since Blindshut 1.0

 */

function blindshut_javascript_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

}

add_action( 'wp_head', 'blindshut_javascript_detection', 0 );



/**

 * Enqueues scripts and styles.

 *

 * @since Blindshut 1.0

 */

function blindshut_scripts() {

	// Add custom fonts, used in the main stylesheet.

	wp_enqueue_style( 'blindshut-fonts', blindshut_fonts_url(), array(), null );



	// Add Genericons, used in the main stylesheet.

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );



	// Theme stylesheet.

	wp_enqueue_style( 'blindshut-style', get_stylesheet_uri() );



	// Load the Internet Explorer specific stylesheet.

	wp_enqueue_style( 'blindshut-ie', get_template_directory_uri() . '/css/ie.css', array( 'blindshut-style' ), '20160816' );

	wp_style_add_data( 'blindshut-ie', 'conditional', 'lt IE 10' );



	// Load the Internet Explorer 8 specific stylesheet.

	wp_enqueue_style( 'blindshut-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'blindshut-style' ), '20160816' );

	wp_style_add_data( 'blindshut-ie8', 'conditional', 'lt IE 9' );



	// Load the Internet Explorer 7 specific stylesheet.

	wp_enqueue_style( 'blindshut-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'blindshut-style' ), '20160816' );

	wp_style_add_data( 'blindshut-ie7', 'conditional', 'lt IE 8' );



	// Load the html5 shiv.

	wp_enqueue_script( 'blindshut-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );

	wp_script_add_data( 'blindshut-html5', 'conditional', 'lt IE 9' );



	wp_enqueue_script( 'blindshut-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



	if ( is_singular() && wp_attachment_is_image() ) {

		wp_enqueue_script( 'blindshut-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );

	}



	wp_enqueue_script( 'blindshut-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );



	wp_localize_script( 'blindshut-script', 'screenReaderText', array(

		'expand'   => __( 'expand child menu', 'blindshut' ),

		'collapse' => __( 'collapse child menu', 'blindshut' ),

	) );

}

add_action( 'wp_enqueue_scripts', 'blindshut_scripts' );



/**

 * Adds custom classes to the array of body classes.

 *

 * @since Blindshut 1.0

 *

 * @param array $classes Classes for the body element.

 * @return array (Maybe) filtered body classes.

 */

function blindshut_body_classes( $classes ) {

	// Adds a class of custom-background-image to sites with a custom background image.

	if ( get_background_image() ) {

		$classes[] = 'custom-background-image';

	}



	// Adds a class of group-blog to sites with more than 1 published author.

	if ( is_multi_author() ) {

		$classes[] = 'group-blog';

	}



	// Adds a class of no-sidebar to sites without active sidebar.

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {

		$classes[] = 'no-sidebar';

	}



	// Adds a class of hfeed to non-singular pages.

	if ( ! is_singular() ) {

		$classes[] = 'hfeed';

	}



	return $classes;

}

add_filter( 'body_class', 'blindshut_body_classes' );



/**

 * Converts a HEX value to RGB.

 *

 * @since Blindshut 1.0

 *

 * @param string $color The original color, in 3- or 6-digit hexadecimal form.

 * @return array Array containing RGB (red, green, and blue) values for the given

 *               HEX code, empty array otherwise.

 */

function blindshut_hex2rgb( $color ) {

	$color = trim( $color, '#' );



	if ( strlen( $color ) === 3 ) {

		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );

		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );

		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );

	} else if ( strlen( $color ) === 6 ) {

		$r = hexdec( substr( $color, 0, 2 ) );

		$g = hexdec( substr( $color, 2, 2 ) );

		$b = hexdec( substr( $color, 4, 2 ) );

	} else {

		return array();

	}



	return array( 'red' => $r, 'green' => $g, 'blue' => $b );

}



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for content images

 *

 * @since Blindshut 1.0

 *

 * @param string $sizes A source size value for use in a 'sizes' attribute.

 * @param array  $size  Image size. Accepts an array of width and height

 *                      values in pixels (in that order).

 * @return string A source size value for use in a content image 'sizes' attribute.

 */

function blindshut_content_image_sizes_attr( $sizes, $size ) {

	$width = $size[0];



	if ( 840 <= $width ) {

		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	}



	if ( 'page' === get_post_type() ) {

		if ( 840 > $width ) {

			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

		}

	} else {

		if ( 840 > $width && 600 <= $width ) {

			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';

		} elseif ( 600 > $width ) {

			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

		}

	}



	return $sizes;

}

add_filter( 'wp_calculate_image_sizes', 'blindshut_content_image_sizes_attr', 10 , 2 );



/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for post thumbnails

 *

 * @since Blindshut 1.0

 *

 * @param array $attr Attributes for the image markup.

 * @param int   $attachment Image attachment ID.

 * @param array $size Registered image size or flat array of height and width dimensions.

 * @return array The filtered attributes for the image markup.

 */

function blindshut_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( 'post-thumbnail' === $size ) {

		if ( is_active_sidebar( 'sidebar-1' ) ) {

			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';

		} else {

			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';

		}

	}

	return $attr;

}

add_filter( 'wp_get_attachment_image_attributes', 'blindshut_post_thumbnail_sizes_attr', 10 , 3 );



/**

 * Modifies tag cloud widget arguments to display all tags in the same font size

 * and use list format for better accessibility.

 *

 * @since Blindshut 1.1

 *

 * @param array $args Arguments for tag cloud widget.

 * @return array The filtered arguments for tag cloud widget.

 */

function blindshut_widget_tag_cloud_args( $args ) {

	$args['largest']  = 1;

	$args['smallest'] = 1;

	$args['unit']     = 'em';

	$args['format']   = 'list'; 



	return $args;

}

add_filter( 'widget_tag_cloud_args', 'blindshut_widget_tag_cloud_args' );

add_image_size( 'testimonial', 110, 110, true );




 function wpdocs_register_my_custom_menu_page() {
	 add_menu_page( 
        __( 'Price import csv', 'textdomain' ),
        'Price Import',
        'manage_options',
        'priceimport',
        'import_process_page',
        '',
        6
    ); 
	
	add_menu_page( 
        __( 'Group Price Details', 'textdomain' ),
        'Group Price Details',
        'manage_options',
        'pricegroup',
        'price_group_page',
        '',
        6
    ); 
}
function price_group_page()
{
	global $wpdb;
	$terms = get_terms( array(
    'taxonomy' => 'price_groups',
    'hide_empty' => false
) );
?> <br /><br />

<form action="admin.php?page=pricegroup" method="get">
<select id="pricegroup" name="pricegroup" onchange="pricegroupfunction();">
    	<option value="0">Please select price group</option>
       <?php foreach($terms as $term)
	   {
		   if(isset($_GET['pricegroup']))
		   {
			   if($_GET['pricegroup']==$term->term_id)
			   {
				    ?>
       <option value="<?php echo $term->term_id; ?>" selected="selected"><?php echo $term->name; ?></option>
		   <?php 
			   }
			   else
			   {
		   ?>
       <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
		   <?php }
		   }
		   else
		   {
			   ?>
       <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
		   <?php 
		   }
	   
	   }?>
    </select>
    <input type="hidden" id="page" name="page" value="pricegroup" />
    <input type="submit" id="submit" name="submit" value="submit" style="display:none" /></form>
    <?php
	if(isset($_GET['pricegroup']))
	{
	 global $wpdb;
	$priceGroupwidth=$wpdb->get_results("SELECT width FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$_GET['pricegroup']." GROUP BY width order by width ASC"); 
	$priceGroupheight=$wpdb->get_results("SELECT height FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$_GET['pricegroup']." GROUP BY height order by height");
	?>
    <h1>Product Price</h1>
    <table border="2" width="100%">
    	<tr>
        	<th>width</th>
            <?php foreach($priceGroupwidth as $width)
			{?>
				<th><?php echo $width->width; ?></th>
			<?php }
			?>
        </tr>
       <?php foreach($priceGroupheight as $height)
	   {?>
		   <tr>
           <td><?php echo $height->height; ?></td>
           <?php $priceGroup1=$wpdb->get_results("SELECT * FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$_GET['pricegroup']." AND height=".$height->height." ORDER BY width ASC"); ?>
           <?php foreach($priceGroup1 as $priceG)
		   {?>
			   <td><input type="text" id="price<?php echo $priceG->id; ?>" name="price<?php echo $priceG->id; ?>" value="<?php echo $priceG->price; ?>" readonly style="width:50px;" /></td>
		   <?php }?>
           </tr>
	   <?php }?>
    </table>
    <h1>Continuous Loop Surcharge</h1>
    
    	<?php $priceGroupwidth=$wpdb->get_results("SELECT width FROM `".$wpdb->prefix."loop_surcharge` WHERE groupid=".$_GET['pricegroup']." GROUP BY width order by width ASC"); ?>
        <?php $priceGroupPrice=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."loop_surcharge` WHERE groupid=".$_GET['pricegroup']." GROUP BY width order by width ASC"); ?>
        <table border="2" width="100%">
    	<tr>
        	<th>width</th>
            <?php foreach($priceGroupwidth as $width)
			{?>
				<th><?php echo $width->width; ?></th>
                
			<?php }
			?>
        </tr>
        <tr>
        <td></td>
        <?php foreach($priceGroupPrice as $price)
		{?>
        
			<td>
            	<input type="text" id="price<?php echo $price->id; ?>" name="price<?php echo $price->id; ?>" value="<?php echo $price->price; ?>" readonly style="width:50px;" />
            </td>
            
		<?php }?>
        </tr>
    </table>
    <h1>Cordless Surcharge</h1>
    
    	<?php $priceGroupwidth=$wpdb->get_results("SELECT width FROM `".$wpdb->prefix."cordless_surcharge` WHERE groupid=".$_GET['pricegroup']." GROUP BY width order by width ASC"); ?>
        <?php $priceGroupPrice=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."cordless_surcharge` WHERE groupid=".$_GET['pricegroup']." GROUP BY width order by width ASC"); ?>
        <table border="2" width="100%">
    	<tr>
        	<th>width</th>
            <?php foreach($priceGroupwidth as $width)
			{?>
				<th><?php echo $width->width; ?></th>
                
			<?php }
			?>
        </tr>
        <tr>
        <td></td>
        <?php foreach($priceGroupPrice as $price)
		{?>
        
			<td>
            	<input type="text" id="price<?php echo $price->id; ?>" name="price<?php echo $price->id; ?>" value="<?php echo $price->price; ?>" readonly style="width:50px;" />
            </td>
            
		<?php }?>
        </tr>
    </table>
    <?php } ?>
	<script type="text/javascript">
	function pricegroupfunction()
	{
		jQuery(document).ready(function(e) {
            jQuery("#submit").click();
        });
	}
    </script>	<?php  
	//$wpdb->get_results("SELECT ");
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
function import_process_page(){
	
	include('phpexcel/Classes/PHPExcel/IOFactory.php');
	global $wpdb;


	if(isset($_POST['submitimport']))
	{
		
		ini_set('max_execution_time', 0);
		$upload_directory_array=wp_upload_dir();
		$path=$upload_directory_array['path'];
		$url=$upload_directory_array['url'];
		$basedir=$upload_directory_array['basedir'];
		$baseurl=$upload_directory_array['baseurl'];		
		$target_dir = $basedir."/fileupload/";
		$target_dir_path = $baseurl."/fileupload/";
		$namearray=array();
		$namearray=explode('.',basename($_FILES["importfile"]["name"]));
		$fileuploadnew=$wpdb->get_results("SELECT count(*) as count1 FROM `wp_uploads`");
		$target_file = $target_dir . basename($_FILES["importfile"]["name"]);
		$arrayTarget=array('xlsx','xls','xlsm','csv');
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		$target_file_path=$target_dir_path. $namearray[0]."_".$fileuploadnew[0]->count1.".".$imageFileType;
		if(!in_array($imageFileType , $arrayTarget))
                    {
                      echo $error='Invalid file format';
                    }
					else
					{
			
			$target_file = $target_dir . $namearray[0]."_".$fileuploadnew[0]->count1.".".$imageFileType;
			$wpdb->query("INSERT INTO `wp_uploads`( `name`, `url`, `status`) VALUES ('".basename($_FILES["importfile"]["name"])."','".$target_file_path."',0)"); 
			
			move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_file);
			$objPHPExcel = PHPExcel_IOFactory::load($target_file);
			$sheetCount = $objPHPExcel->getSheetCount();
			$sheetNames = $objPHPExcel->getSheetNames();
			if($_POST['sheettype']==0)
			{
			?>
			<script type="text/javascript">
			var totalCountSheet=parseInt('<?php echo $sheetCount; ?>');
			var counter=1;
			callxlsxajax(counter);
			function callxlsxajax(sheetNo)
			{
				jQuery(document).ready(function(e) {
                    jQuery.ajax({
						url:"<?php echo admin_url( 'admin-ajax.php' ); ?>",
						type:"POST",
						data:"action=my_action_name&fileurl=<?php echo $target_file; ?>&sheetNo="+sheetNo,
						success: function(data)
						{
							if(counter < totalCountSheet)
							{
								
							var totalPercentage=(counter*100)/totalCountSheet;
							jQuery(".meter span").animate({width:totalPercentage+"%"});
							jQuery(".msg").html('Imported Sheet No '+(counter)+" Now Importing Sheet No "+(counter+1));
							counter++;
							callxlsxajax(counter);
							}
							else
							{
								jQuery(".meter span").css("width","100%");
								jQuery(".msg").html('The import process has finished!');
							}

						},
						error: function(error)
						{
							
						}
					});
                });
			}
            </script>
			<?php }
			else
			{?>
				<script type="text/javascript">
			var totalCountSheet=parseInt('<?php echo $sheetCount; ?>');
			var counter=1;
			callxlsxajax(counter);
			function callxlsxajax(sheetNo)
			{
				jQuery(document).ready(function(e) {
                    jQuery.ajax({
						url:"<?php echo admin_url( 'admin-ajax.php' ); ?>",
						type:"POST",
						data:"action=my_action_name_perfect&fileurl=<?php echo $target_file; ?>&sheetNo="+sheetNo,
						success: function(data)
						{
							if(counter < totalCountSheet)
							{	
							var totalPercentage=(counter*100)/totalCountSheet;
							jQuery(".meter span").animate({width:totalPercentage+"%"});
							jQuery(".msg").html('Imported Sheet No '+(counter)+" Now Importing Sheet No "+(counter+1));
							counter++;
							callxlsxajax(counter);
							}
							else
							{
								jQuery(".meter span").css("width","100%");
								jQuery(".msg").html('The import process has finished!');
							}

						},
						error: function(error)
						{
							
						}
					});
                });
			}
            </script>
			<?php }
		}
		
	}
	$terms = get_terms( array(
    'taxonomy' => 'price_groups',
    'hide_empty' => false,
) );
    ?>
    <?php if(isset($_POST['submitimport']))
	{?>
   <div class="meter">
			<span style="width:1%"></span>
		</div>
        <div class="msg">Now Importing Sheet No 1
</div>
	<?php }
	else
	{
 ?>    <div class="pageimport">
    <form action="" enctype="multipart/form-data" method="post"> 
    <select id="sheettype" name="sheettype">
    	<option value="0">Normal Sheet</option>
       	<option value="1">Perfect vue Sheet</option>
    </select>
		<input type="file" name="importfile" id="importfile" />
    	<input type="submit" id="submitimport" name="submitimport" value="submit" />
    </form>
    </div>
    <?php } ?>
    <style>
	.pageimport
	{
		text-align: center;
    vertical-align: inherit;
    padding: 190px 0 0 0px;
	}
	.meter { 
			height: 20px;  /* Can be anything */
			position: relative;
			margin: 60px 0 20px 0; /* Just for demo spacing */
			background: #555;
			-moz-border-radius: 25px;
			-webkit-border-radius: 25px;
			border-radius: 25px;
			padding: 10px;
			-webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
			-moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
			box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
		}
		.meter > span {
			display: block;
			height: 100%;
			   -webkit-border-top-right-radius: 8px;
			-webkit-border-bottom-right-radius: 8px;
			       -moz-border-radius-topright: 8px;
			    -moz-border-radius-bottomright: 8px;
			           border-top-right-radius: 8px;
			        border-bottom-right-radius: 8px;
			    -webkit-border-top-left-radius: 20px;
			 -webkit-border-bottom-left-radius: 20px;
			        -moz-border-radius-topleft: 20px;
			     -moz-border-radius-bottomleft: 20px;
			            border-top-left-radius: 20px;
			         border-bottom-left-radius: 20px;
			background-color: rgb(43,194,83);
			background-image: -webkit-gradient(
			  linear,
			  left bottom,
			  left top,
			  color-stop(0, rgb(43,194,83)),
			  color-stop(1, rgb(84,240,84))
			 );
			background-image: -moz-linear-gradient(
			  center bottom,
			  rgb(43,194,83) 37%,
			  rgb(84,240,84) 69%
			 );
			-webkit-box-shadow: 
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			-moz-box-shadow: 
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			box-shadow: 
			  inset 0 2px 9px  rgba(255,255,255,0.3),
			  inset 0 -2px 6px rgba(0,0,0,0.4);
			position: relative;
			overflow: hidden;
		}
		.meter > span:after, .animate > span > span {
			content: "";
			position: absolute;
			top: 0; left: 0; bottom: 0; right: 0;
			background-image: 
			   -webkit-gradient(linear, 0 0, 100% 100%, 
			      color-stop(.25, rgba(255, 255, 255, .2)), 
			      color-stop(.25, transparent), color-stop(.5, transparent), 
			      color-stop(.5, rgba(255, 255, 255, .2)), 
			      color-stop(.75, rgba(255, 255, 255, .2)), 
			      color-stop(.75, transparent), to(transparent)
			   );
			background-image: 
				-moz-linear-gradient(
				  -45deg, 
			      rgba(255, 255, 255, .2) 25%, 
			      transparent 25%, 
			      transparent 50%, 
			      rgba(255, 255, 255, .2) 50%, 
			      rgba(255, 255, 255, .2) 75%, 
			      transparent 75%, 
			      transparent
			   );
			z-index: 1;
			-webkit-background-size: 50px 50px;
			-moz-background-size: 50px 50px;
			-webkit-animation: move 2s linear infinite;
			   -webkit-border-top-right-radius: 8px;
			-webkit-border-bottom-right-radius: 8px;
			       -moz-border-radius-topright: 8px;
			    -moz-border-radius-bottomright: 8px;
			           border-top-right-radius: 8px;
			        border-bottom-right-radius: 8px;
			    -webkit-border-top-left-radius: 20px;
			 -webkit-border-bottom-left-radius: 20px;
			        -moz-border-radius-topleft: 20px;
			     -moz-border-radius-bottomleft: 20px;
			            border-top-left-radius: 20px;
			         border-bottom-left-radius: 20px;
			overflow: hidden;
		}
		
		.animate > span:after {
			display: none;
		}
		
		@-webkit-keyframes move {
		    0% {
		       background-position: 0 0;
		    }
		    100% {
		       background-position: 50px 50px;
		    }
		}
		
		.orange > span {
			background-color: #f1a165;
			background-image: -moz-linear-gradient(top, #f1a165, #f36d0a);
			background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f1a165),color-stop(1, #f36d0a));
			background-image: -webkit-linear-gradient(#f1a165, #f36d0a); 
		}
		
		.red > span {
			background-color: #f0a3a3;
			background-image: -moz-linear-gradient(top, #f0a3a3, #f42323);
			background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f0a3a3),color-stop(1, #f42323));
			background-image: -webkit-linear-gradient(#f0a3a3, #f42323);
		}
		
		.nostripes > span > span, .nostripes > span:after {
			-webkit-animation: none;
			background-image: none;
		}
		.msg
		{
			    float: left;
    margin: 4px 3px 4px 44px;
    font-size: 21px;
    color: red;
		}
	</style>
	<?php
	
}
 function my_ajax_callback_function() {
	include('phpexcel/Classes/PHPExcel/IOFactory.php');
	global $wpdb;
	$start=$_POST['start'];
	$end=$_POST['end'];
	
        				$objPHPExcel = PHPExcel_IOFactory::load($_POST['fileurl']);
						$sheetCount = $objPHPExcel->getSheetCount();
						$sheetNames = $objPHPExcel->getSheetNames();
						
						$objWorksheet = $objPHPExcel->setActiveSheetIndex($_POST['sheetNo']-1);
						$objWorksheet = $objPHPExcel->getActiveSheet();
						
						//$parent_term = term_exists( 'fruits', 'product' ); // array is returned if taxonomy is given
//$parent_term_id = $parent_term['term_id'];         // get numeric term id
						$termPrice=wp_insert_term($sheetNames[$_POST['sheetNo']-1],'price_groups');
						if ( is_wp_error($termPrice) ) {
								$termId=$termPrice->error_data['term_exists'];
							}
							else
							{
								$termId=$termPrice['term_id'];
							}
							$wpdb->query("DELETE FROM `wp_groupTerm` WHERE groupid=".$termId);
							$wpdb->query("DELETE FROM `wp_loop_surcharge` WHERE groupid=".$termId);
							$wpdb->query("DELETE FROM `wp_cordless_surcharge` WHERE groupid=".$termId);
						 $highestRow = $objWorksheet->getHighestRow(); 
						 $highestColumn = $objWorksheet->getHighestColumn(); 
						
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
						
						//$total=($highestRow-2)*($highestColumnIndex);
						$checkLoopsurcharge=0;
						$checkCordLess=0;
						$checkLoopcheckfinish=0;
						for ($row = 2; $row <= $highestRow; $row++) {
							for($column=1;$column <= PHPExcel_Cell::columnIndexFromString($highestColumn);$column++)
								{
									if(strcmp($objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),'')==0 && $checkLoopsurcharge==0)
									{
										$checkLoopsurcharge=1;
										break;
									}
									$height=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
									if (strpos($height, '(') !== false) {
   										 $heightArray=array();
										 $heightArray=explode('(',$height);
										 if(isset($heightArray[0]))
										 {
											 $height=(int)trim($heightArray[0]);
										 }
										}
									if($checkLoopsurcharge==1)
									{
										$checkLoopcheckfinish=1;
										if(strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
										{
											$widthInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
											$priceInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
											
										$wpdb->query("INSERT INTO `wp_loop_surcharge`(`width`, `price`,`groupid`) VALUES (".$widthInnerVar.",".$priceInnerVar.",".$termId.")");
										}
									}
									else if($checkCordLess==1)
									{
										
										if(strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
										{
											
											$widthInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
											$priceInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
										$wpdb->query("INSERT INTO `wp_cordless_surcharge`(`width`, `price`,`groupid`) VALUES (".$widthInnerVar.",".$priceInnerVar.",".$termId.")");
										}
									}
									else
									{
									//echo  $objWorksheet->getCellByColumnAndRow($column, $row)->getValue()." ";
									if(strcmp($height,'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
									{
										$heightInnerVar=str_replace('"', '',$height);
										$widthInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
											$priceInnerVar=str_replace('"', '', $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
									$wpdb->query("INSERT INTO `wp_groupTerm`(`groupid`, `height`, `width`, `price`) VALUES (".$termId.",".$heightInnerVar.",".$widthInnerVar.",".$priceInnerVar.")");
									}
									}
								
								}
								if($checkLoopcheckfinish==1)
								{
									$checkCordLess=1;
									$checkLoopsurcharge=-1;
								}
						}
						
						//$wpdb->query("DELETE FROM `wp_groupTerm` WHERE groupid=".$_POST['pricegroup']);
						/*for ($row = ($start+3); $row <= ($end+3); $row++) {
							
								for($column=1;$column <= PHPExcel_Cell::columnIndexFromString($highestColumn);$column++)
								{
									//echo $objWorksheet->getCellByColumnAndRow($column, $row)->getValue();
										//update_term_meta($_POST['pricegroup'], 'price_'.$ip.'_width',  $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
										//update_term_meta($_POST['pricegroup'], 'price_'.$ip.'_length',  $objWorksheet->getCellByColumnAndRow(0, $row)->getValue());
										//update_term_meta($_POST['pricegroup'], 'price_'.$ip.'_price2',  $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
										//update_term_meta($_POST['pricegroup'], 'price',  $ip);
										
									if(strcmp($objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
									{
									$wpdb->query("INSERT INTO `wp_groupTerm`(`groupid`, `height`, `width`, `price`) VALUES (".$_POST['pricegroup'].",".$objWorksheet->getCellByColumnAndRow(0, $row)->getValue().",".$objWorksheet->getCellByColumnAndRow($column, 1)->getValue().",".$objWorksheet->getCellByColumnAndRow($column, $row)->getValue().")");
									
									}
									$ip++;
									
								}
							
							 $start1++;
							 $end1++;
								
						}
						if($start==0)
						{
						$objWorksheet = $objPHPExcel->setActiveSheetIndex(1);
						$objWorksheet = $objPHPExcel->getActiveSheet();

						 $highestRow1 = $objWorksheet->getHighestRow(); 
						 $highestColumn = $objWorksheet->getHighestColumn(); 
						
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
						//$total=($highestRow-2)*($highestColumnIndex);
						$ip=0;
						$wpdb->query("DELETE FROM `wp_loop_surcharge` WHERE groupid=".$_POST['pricegroup']);
						for ($row = 2; $row < 3; $row++) {
							
								for($column=1;$column <= PHPExcel_Cell::columnIndexFromString($highestColumn);$column++)
								{
									if(strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
									{
									$wpdb->query("INSERT INTO `wp_loop_surcharge`(`width`, `price`,`groupid`) VALUES (".$objWorksheet->getCellByColumnAndRow($column, 1)->getValue().",".$objWorksheet->getCellByColumnAndRow($column, $row)->getValue().",".$_POST['pricegroup'].")");
									}
						//update_term_meta($_POST['pricegroup'], 'continuous-loop_surcharge_'.$ip.'_width',  $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
						//update_term_meta($_POST['pricegroup'], 'continuous-loop_surcharge_'.$ip.'_price',  $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
						//update_term_meta($_POST['pricegroup'], 'continuous-loop_surcharge',  $ip);
						$ip++;
								}
						}
						
						$objWorksheet = $objPHPExcel->setActiveSheetIndex(2);
						$objWorksheet = $objPHPExcel->getActiveSheet();

						 $highestRow2 = $objWorksheet->getHighestRow(); 
						 $highestColumn = $objWorksheet->getHighestColumn(); 
						
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
						//$total=($highestRow-2)*($highestColumnIndex);
						$ip=0;
						$wpdb->query("DELETE FROM `wp_cordless_surcharge` WHERE groupid=".$_POST['pricegroup']);
						for ($row = 2; $row < 3; $row++) {
							
								for($column=1;$column <= PHPExcel_Cell::columnIndexFromString($highestColumn);$column++)
								{
									if(strcmp($objWorksheet->getCellByColumnAndRow($column, 1)->getValue(),'')!=0 && strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
									{
									$wpdb->query("INSERT INTO `wp_cordless_surcharge`(`width`, `price`,`groupid`) VALUES (".$objWorksheet->getCellByColumnAndRow($column, 1)->getValue().",".$objWorksheet->getCellByColumnAndRow($column, $row)->getValue().",".$_POST['pricegroup'].")");
									}
						//update_term_meta($_POST['pricegroup'], 'cordless_surcharge_'.$ip.'_width',  $objWorksheet->getCellByColumnAndRow($column, 1)->getValue());
						//update_term_meta($_POST['pricegroup'], 'cordless_surcharge_'.$ip.'_price',  $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
						//update_term_meta($_POST['pricegroup'], 'cordless_surcharge',  $ip);
						$ip++;
								}
						}
						
						
						}*/
						
						die;
	}
    add_action( 'wp_ajax_my_action_name', 'my_ajax_callback_function' );    // If called from admin panel
    add_action( 'wp_ajax_nopriv_my_action_name', 'my_ajax_callback_function' ); 

 	add_action( 'wp_ajax_my_action_name_perfect', 'my_ajax_callback_function_perfect' );    // If called from admin panel
    add_action( 'wp_ajax_nopriv_my_action_name_perfect', 'my_ajax_callback_function_perfect' );   

function my_ajax_callback_function_perfect()
{
	include('phpexcel/Classes/PHPExcel/IOFactory.php');
	global $wpdb;
	$start=$_POST['start'];
	$end=$_POST['end'];
	
        				$objPHPExcel = PHPExcel_IOFactory::load($_POST['fileurl']);
						$sheetCount = $objPHPExcel->getSheetCount();
						$sheetNames = $objPHPExcel->getSheetNames();
						
						$objWorksheet = $objPHPExcel->setActiveSheetIndex($_POST['sheetNo']-1);
						$objWorksheet = $objPHPExcel->getActiveSheet();
						
						
						
						 //$wpdb->query("DELETE FROM `wp_groupTerm` WHERE groupid=".$termId);
						 //$wpdb->query("DELETE FROM `wp_loop_surcharge` WHERE groupid=".$termId);
						 //$wpdb->query("DELETE FROM `wp_cordless_surcharge` WHERE groupid=".$termId);
						 $highestRow = $objWorksheet->getHighestRow(); 
						 $highestColumn = $objWorksheet->getHighestColumn(); 
						
						 $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
						 $widthRow=1;
						 $checkRow=0;
						 global $wpdb;
						 $blankRow=0;
						 //echo "<table>";
						for ($row = 1; $row <= $highestRow; $row++) {
							if(is_numeric($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()))
							{
								$height=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
								$widthRow=$row;
								$checkRow=1;
							}
							else if(strcmp($objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),'')!=0)
							{
									$termPrice=wp_insert_term('GRB-PV-'.$sheetNames[$_POST['sheetNo']-1].'-PG-'.$objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),'price_groups');
									if ( is_wp_error($termPrice) ) {
										$termId=$termPrice->error_data['term_exists'];
									}
									else
									{
										$termId=$termPrice['term_id'];
									}	
									$checkRow=1;
							}
							else 
							{
								$checkRow=0;	
							}
							if($checkRow==1)
							{
							for($column=1;$column <= PHPExcel_Cell::columnIndexFromString($highestColumn);$column++)
								{
									if(strcmp($objWorksheet->getCellByColumnAndRow($column, $row)->getValue(),'')!=0)
									{
										$priceHeight=$wpdb->get_results("SELECT * FROM `".$wpdb->prefix."groupTerm` WHERE `groupid`=".$termId." AND `height`=".$height." AND `width`=".$objWorksheet->getCellByColumnAndRow($column, $widthRow)->getValue());
									if(count($priceHeight) > 0)
									{
										$wpdb->query("UPDATE `".$wpdb->prefix."groupTerm` SET `price`=".$objWorksheet->getCellByColumnAndRow($column, $row)->getValue()." WHERE `groupid`=".$termId." AND `height`=".$height." AND `width`=".$objWorksheet->getCellByColumnAndRow($column, $widthRow)->getValue());
									}
									else
									{
										$wpdb->query("INSERT INTO `".$wpdb->prefix."groupTerm`(`groupid`, `height`, `width`, `price`) VALUES (".$termId.",".$height.",".$objWorksheet->getCellByColumnAndRow($column, $widthRow)->getValue().",".$objWorksheet->getCellByColumnAndRow($column, $row)->getValue().")");
									}
									}
								}
							}
								
							}
							//echo "</table>";
						
						
	die;
}
add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price( $cart_obj ) {

    //  This is necessary for WC 3.0+
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
	
    foreach ( $cart_obj->get_cart() as $key => $value ) {
		$productCat=new WC_Product($value['product_id']);
        $value['data']->set_price($value['price']);
    }
 }
add_action('wp_ajax_twf_add_users_custom_data_options_for_products', 'twf_add_users_custom_data_options_for_products');
add_action('wp_ajax_nopriv_twf_add_users_custom_data_options_for_products', 'twf_add_users_custom_data_options_for_products');
 
function twf_add_users_custom_data_options_for_products()
{
    $product_id = $_POST['id']; //Product ID
    $user_custom_data_values = $_POST['user_data']; //This is User custom value sent via AJAX
    session_start();
    $_SESSION['twf_user_custom_datas'] = $user_custom_data_values;
 
    //Add product to WooCommerce cart.
    $product_id = $_GET['product_id'];
    $quantity = 1; //Or it can be some userinputted quantity
    if( WC()->cart->add_to_cart( $product_id, $quantity )) {
        global $woocommerce;
        $cart_url = $woocommerce->cart->get_cart_url();
 
        $output = array('success' => 1, 'msg' =>'Added the product to your cart', 'cart_url' => $cart_url );
    } else {
        $output = array('success' => 0, 'msg' => 'Something went wrong, please try again');
    }
    wp_die(json_encode($output));
}
function wpdocs_register_meta_boxes() {
    add_meta_box( 'product-size-id', __( 'Select Product default Size', 'textdomain' ), 'wpdocs_my_display_callback', 'product' );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
function wpdocs_my_display_callback( $post ) {
	$priceGroup=get_field('price_group', $post->ID,true);
	$ProductwidthDefault=get_field('product_width_default',$post->ID,true);
	$ProductheightDefault=get_field('product_height_default',$post->ID,true);
	$widthProduct=24;
	$heightProduct=36;
	if(strcmp($ProductwidthDefault,'')!=0)
	{
		$widthProduct=$ProductwidthDefault;
	}
	if(strcmp($ProductheightDefault,'')!=0)
	{
		$heightProduct=$ProductheightDefault;
	}
    global $wpdb;
	$widths=$wpdb->get_results("SELECT width FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup." GROUP BY width order by width");
	$heights=$wpdb->get_results("SELECT height FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup." GROUP BY height order by height");
	?><div class="pro_detail_size afclr">
<h4>Select Size of product :</h4>
    <div class="sub_width">
<label for="widthproduct">Width :</label><br>
<select id="widthproduct" name="widthproduct">
<option value="0">Select a width</option>
<?php foreach($widths as $width) {
?><option value="<?php echo $width->width; ?>" <?php if($widthProduct==$width->width) { echo "selected='selected';";} ?>><?php echo $width->width; ?></option>
<?php 
}?>
</select>
</div>
    
    <div class="sub_height">
<label for="heightproduct">Height :</label><br>
<select id="heightproduct" name="heightproduct">
<option value="0">Select a height</option>
<?php foreach($heights as $height) {
?><option value="<?php echo $height->height; ?>" <?php if($heightProduct==$height->height) { echo "selected='selected';";} ?>><?php echo $height->height; ?></option>
<?php 
}?>
</select>
</div></div><?php 
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_meta_box( $post_id ) {
   update_post_meta($post_id,'product_width_default',$_POST['widthproduct']);
   update_post_meta($post_id,'product_height_default',$_POST['heightproduct']);
}
add_action( 'save_post', 'wpdocs_save_meta_box' );

add_action('wp_ajax_get_product_price', 'get_product_price');
add_action('wp_ajax_nopriv_get_product_price', 'get_product_price');



add_action('wp_ajax_getHeightWidthBlindShade', 'getHeightWidthBlindShade');
add_action('wp_ajax_nopriv_getHeightWidthBlindShade', 'getHeightWidthBlindShade');
function getHeightWidthBlindShade()
{
	
	
	global $wpdb;
	$widthProduct=$_POST['width'];
	$heightProduct=$_POST['height'];
	$priceGroup=$_POST['pricegroup'];
	$productId=$_POST['productId'];
	$priceActual=0;
	
	$prices=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 1");
	$priceActual=$prices[0]->price;
	
	//else
	//{
	//	$prices=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 2");
	//	if(isset($prices[1]->price))
	//	{
	//		$priceActual=$prices[1]->price;
	//	}
	//	
	//	else
	//	{
	//		$priceActual=$prices[0]->price;
	//	}}
	
	//echo "SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." LIMIT 1";
	
	$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
$productCat1 = wp_get_post_terms( $productId, 'product_cat', $args );
foreach($productCat1 as $prCat)
{
	if(strcmp(get_field('profit_margin','product_cat_'.$prCat->term_id),'')!=0 && strcmp(get_field('cost_factor','product_cat_'.$prCat->term_id),'')!=0)
	{
		
		
		 $priceGroupMargin=get_field('profit_margin','product_cat_'.$prCat->term_id);
		 $pricecost_factor=get_field('cost_factor','product_cat_'.$prCat->term_id);
	}
}
		
	
	  $costMargin=get_field('cost_margin',$productId,true);
	  $profitMargin=get_field('profit_margin',$productId,true);
	   if(strcmp($costMargin,'')==0)
	  {
		  $costMargin=$pricecost_factor;
	  }
	   if(strcmp($profitMargin,'')==0)
	  {
		  $profitMargin=$priceGroupMargin;
	  }
	  
	  $priceProduct=money_format("%i",$priceActual);
	  $costPrice=(($priceProduct*$costMargin));
	  $costPlusProfitProductPrice=$costPrice+(($costPrice*$profitMargin)/100);
	  $pricePercentage=floor((($priceProduct-$costPlusProfitProductPrice)*100)/$priceProduct);
	  echo json_encode(array('price'=>"$".$priceProduct,'discountpercentage'=>$pricePercentage,'actualPrice'=>$costPlusProfitProductPrice));
	  die;	
}
function get_product_price()
{
	
	global $wpdb;
	$widthProduct=$_POST['width'];
	$heightProduct=$_POST['height'];
	$widthInner=$_POST['widthInner'];
	$heightInner=$_POST['heightInner'];
	$icheck=0;
	if($heightInner > 0)
	{
		$icheck=1;
		//$heightProduct++;
	}
	if($widthInner > 0)
	{
		$icheck=1;
		
	}
	$priceGroup=$_POST['pricegroup'];
	$productId=$_POST['productId'];
	$priceActual=0;
	if($icheck==0)
	{
	$prices=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 1");
	$priceActual=$prices[0]->price;
	}
	else
	{
		$prices=$wpdb->get_results("SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 2");
		if(isset($prices[1]->price))
		{
			$priceActual=$prices[1]->price;
		}
		
		else
		{
			$priceActual=$prices[0]->price;
		}}
	
	//echo "SELECT price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >=".$widthProduct." AND height >= ".$heightProduct." LIMIT 1";
	
	$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
$productCat1 = wp_get_post_terms( $productId, 'product_cat', $args );
foreach($productCat1 as $prCat)
{
	if(strcmp(get_field('profit_margin','product_cat_'.$prCat->term_id),'')!=0 && strcmp(get_field('cost_factor','product_cat_'.$prCat->term_id),'')!=0)
	{
		
		
		 $priceGroupMargin=get_field('profit_margin','product_cat_'.$prCat->term_id);
		 $pricecost_factor=get_field('cost_factor','product_cat_'.$prCat->term_id);
	}
}
		
	
	  $costMargin=get_field('cost_margin',$productId,true);
	  $profitMargin=get_field('profit_margin',$productId,true);
	   if(strcmp($costMargin,'')==0)
	  {
		  $costMargin=$pricecost_factor;
	  }
	   if(strcmp($profitMargin,'')==0)
	  {
		  $profitMargin=$priceGroupMargin;
	  }
	  
	  $priceProduct=money_format("%i",$priceActual);
	  $costPrice=(($priceProduct*$costMargin));
	  $costPlusProfitProductPrice=$costPrice+(($costPrice*$profitMargin)/100);
	  $pricePercentage=floor((($priceProduct-$costPlusProfitProductPrice)*100)/$priceProduct);
	  echo json_encode(array('price'=>"$".$priceProduct,'discountpercentage'=>$pricePercentage,'actualPrice'=>$costPlusProfitProductPrice));
	  die;
}
add_action('wp_ajax_orderBlind', 'orderBlind');
add_action('wp_ajax_nopriv_orderBlind', 'orderBlind');
function orderBlind()
{
	WC()->cart->add_to_cart( $_POST['product_id'],$_POST['quantity'],0,array(),array('roomType'=>$_POST['roomType'],'color'=>$_POST['color'],'mount'=>$_POST['mount'],'size'=>$_POST['size'],'width'=>$_POST['width'],'height'=>$_POST['height'],'widthInner'=>$_POST['widthInner'],'heightInner'=>$_POST['heightInner'],'price'=>$_POST['product_price'],'liftOption'=>$_POST['liftOption'],'tiltOption'=>$_POST['tiltOption'],'decorative'=>$_POST['decorative'],'routeless'=>$_POST['routeless'],'valanceOption'=>$_POST['valanceOption'],'nickname'=>$_POST['nickname'],'shade'=>$_POST['shade'],'rightWidth'=>$_POST['rightWidth'],'rightHeight'=>$_POST['rightHeight'],'centerWidth'=>$_POST['centerWidth'],'centerHeight'=>$_POST['centerHeight']) );
	die;
}

add_action('wp_ajax_getMaxWidthMaxHeight', 'getMaxWidthMaxHeight');
add_action('wp_ajax_nopriv_getMaxWidthMaxHeight', 'getMaxWidthMaxHeight');
function getMaxWidthMaxHeight()
{
	$widthProduct=$_POST['widthproduct'];
	$heightProduct=$_POST['heightproduct'];
	$widthInner=$_POST['widthproductinner'];
	$heightInner=$_POST['heightproductinner'];
	$FabricTermId=$_POST['FabricTermId'];
	$liftOptionTermid=$_POST['liftOptionTermid'];
	$FabricTermObject=get_field('constraintlogic','fabric_styles_'.$FabricTermId);
	$FabricTermWidthHeightObject=get_field('rule','constraint_logic_'.$FabricTermObject->term_id);
	$i=0;
	$j=0;
	foreach($FabricTermWidthHeightObject as $Object)
	{
		foreach($Object['lifting_option'] as $ObjectInner)
		{
			if($ObjectInner==$liftOptionTermid)
			{
				$i=$j;
				break;
			}
		}
		$j++;
	}
	$arrayMsg=array();
	if(isset($FabricTermWidthHeightObject[$i]['name']))
	{
		$minWidth=$FabricTermWidthHeightObject[$i]['width_min'];
		$minHeight=$FabricTermWidthHeightObject[$i]['height_min'];
		$maxWidth=$FabricTermWidthHeightObject[$i]['width_max'];
		$maxHeight=$FabricTermWidthHeightObject[$i]['height_max'];
		if(!is_numeric($minWidth))
		{
			$minWidth=$FabricTermWidthHeightObject[$i]['width_min_panel'];
		}
		if(!is_numeric($minWidth))
		{
			$minWidth=$FabricTermWidthHeightObject[$i]['width_min_panel'];
		}
		if(!is_numeric($minHeight))
		{
			$minHeight=$FabricTermWidthHeightObject[$i]['height_min_shade'];
		}
		if(!is_numeric($maxWidth))
		{
			$maxWidth=$FabricTermWidthHeightObject[$i]['width_max_panel'];
		}
		if(!is_numeric($maxWidth))
		{
			$maxWidth=$FabricTermWidthHeightObject[$i]['width_max_shade'];
		}
		if(!is_numeric($maxHeight))
		{
			$maxHeight=$FabricTermWidthHeightObject[$i]['height_max_shade'];
		}
		if($widthProduct > $maxWidth || $heightProduct > $maxHeight)
		{
			$arrayMsg=array('msg'=>'Your size selection requires that your total width does not exceed '.$maxWidth.'" inches and height does not exceed '.$maxHeight.'.  Please adjust your treatment size.');
		}
		else
		{
			$arrayMsg=array('msg'=>'');
		}
	}
	echo json_encode($arrayMsg);
	die;
}
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );


add_action('admin_action_rd_duplicate_term_as_draft','rd_duplicate_term_as_draft'); 

function rd_duplicate_term_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['termId']) || isset( $_POST['termId'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_term_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
	
	$termObject=get_term($_GET['termId']);
	$colorCategory=get_field('color_category','fabric_styles_'.$_GET['termId'],true);
	$material_styles=get_field('material_styles','fabric_styles_'.$_GET['termId'],true);
	$color=get_field('color','fabric_styles_'.$_GET['termId'],true);
	$color_image_fabric=get_field('color_image_fabric','fabric_styles_'.$_GET['termId'],true);
	$standardCordControlShadeWidthMin=get_field('standard_cord_control_shade_width_(min)','fabric_styles_'.$_GET['termId'],true);
	$standardCordControlShadeWidthMax=get_field('standard_cord_control_shade_width_(max)','fabric_styles_'.$_GET['termId'],true);
	$standardCordControlShadeHeightMin=get_field('standard_cord_control_shade_height(min)','fabric_styles_'.$_GET['termId'],true);
	$standardCordControlShadeHeightMax=get_field('standard_cord_control_shade_height_(max)','fabric_styles_'.$_GET['termId'],true);
	$standardCordControlMultipleShadeOnOneWidthMinPanel=get_field('standard_cord_control_multiple_shades_on_one_headrail_width_min_panel','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_multiple_shades_on_one_headrail_width_max_panel=get_field('standard_cord_control_multiple_shades_on_one_headrail_width_(max_panel)','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_multiple_shades_on_one_headrail_width_max_shade=get_field('standard_cord_control_multiple_shades_on_one_headrail_width_(max_shade)','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_multiple_shades_on_one_headrail_height_min_shade=get_field('standard_cord_control_multiple_shades_on_one_headrail_height_min_shade','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_multiple_shades_on_one_headrail_height_max_shade=get_field('standard_cord_control_multiple_shades_on_one_headrail_height_(max_shade)','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_bottom_up_top_down_width_min=get_field('standard_cord_control__bottom_up/top_down_width_min','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_bottom_up_top_down_width_max=get_field('standard_cord_control__bottom_up/top_down_width_max','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_bottom_up_top_down_height_min=get_field('standard_cord_control__bottom_up/top_down_height_min','fabric_styles_'.$_GET['termId'],true);
	$standard_cord_control_bottom_up_top_down_height_max=get_field('standard_cord_control__bottom_up/top_down_height_max','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop_shade_width_min=get_field('continuous-loop_shade_width_min','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop_shade_width_max=get_field('continuous-loop_shade_width_max','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop_shade_height_min=get_field('continuous-loop_shade_height_min','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop_shade_height_max=get_field('continuous-loop_shade_height_max','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_width_min_panel=get_field('continuous-loop__multiple_shades_on_one_headrail_width_min_panel','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_width_max_panel=get_field('continuous-loop__multiple_shades_on_one_headrail_width_max_panel','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_width_max_shade_single=get_field('continuous-loop__multiple_shades_on_one_headrail_width_max_shade_single','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_width_max_shade_multiple=get_field('continuous-loop__multiple_shades_on_one_headrail_width_max_shade_multiple','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_height_min_shade=get_field('continuous-loop__multiple_shades_on_one_headrail_height_min_shade','fabric_styles_'.$_GET['termId'],true);
	$continuous_loop__multiple_shades_on_one_headrail_height_max_shade=get_field('continuous-loop__multiple_shades_on_one_headrail_height_max_shade','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_Shade_width_min=get_field('cordless_lift_Shade_width_min','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_width_max=get_field('cordless_lift_shade_width_max','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_height_min=get_field('cordless_lift_shade_height_min','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_height_max=get_field('cordless_lift_shade_height_max','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift__multiple_shades_on__one_headrail_width_min_panel=get_field('cordless_lift__multiple_shades_on__one_headrail_width_min_panel','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift__multiple_shades_on__one_headrail_width_max_panel=get_field('cordless_lift__multiple_shades_on__one_headrail_width_max_panel','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift__multiple_shades_on__one_headrail_width_max_shade=get_field('cordless_lift__multiple_shades_on__one_headrail_width_max_shade','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift__multiple_shades_on__one_headrail_height_min_shade=get_field('cordless_lift__multiple_shades_on__one_headrail_height_min_shade','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift__multiple_shades_on__one_headrail_height_max_shade=get_field('cordless_lift__multiple_shades_on__one_headrail_height_max_shade','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_bottom_up_top_down_width_min=get_field('cordless_lift_shade_bottom_up/top_down_width_min','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_bottom_up_top_down_width_max=get_field('cordless_lift_shade_bottom_up/top_down_width_max','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_bottom_up_top_down_height_min=get_field('cordless_lift_shade_bottom_up/top_down_height_min','fabric_styles_'.$_GET['termId'],true);
	$cordless_lift_shade_bottom_up_top_down_height_max=get_field('cordless_lift_shade_bottom_up/top_down_height_max','fabric_styles_'.$_GET['termId'],true);
	

	$termCheck=term_exists( $termObject->name." Copy", 'fabric_styles' );
	if ( $termCheck !== 0 && $termCheck !== null ) {
		$Term=wp_insert_term($termObject->name." Copy Copy", 'fabric_styles', $args = array('description'=> $termObject->description,'parent'=> $termObject->parent) );
		
	}
	else
	{
		$Term=wp_insert_term($termObject->name." Copy", 'fabric_styles', $args = array('description'=> $termObject->description,'parent'=> $termObject->parent) );
	}
	update_field( 'color_category',$colorCategory, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'material_styles',$material_styles, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'color',$color, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'color_image_fabric',$color_image_fabric, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_width_(min)',$standardCordControlShadeWidthMin, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_width_(max)',$standardCordControlShadeWidthMax, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_height(min)',$standardCordControlShadeHeightMin, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_height_(max)',$standardCordControlShadeHeightMax, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_multiple_shades_on_one_headrail_width_min_panel',$standardCordControlMultipleShadeOnOneWidthMinPanel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_width_(max)',$standardCordControlShadeWidthMax, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_shade_width_(max)',$standardCordControlShadeWidthMax, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_multiple_shades_on_one_headrail_width_(max_panel)',$standard_cord_control_multiple_shades_on_one_headrail_width_max_panel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_multiple_shades_on_one_headrail_width_(max_shade)',$standard_cord_control_multiple_shades_on_one_headrail_width_max_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_multiple_shades_on_one_headrail_height_min_shade',$standard_cord_control_multiple_shades_on_one_headrail_height_min_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control_multiple_shades_on_one_headrail_height_(max_shade)',$standard_cord_control_multiple_shades_on_one_headrail_height_max_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control__bottom_up/top_down_width_min',$standard_cord_control_bottom_up_top_down_width_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control__bottom_up/top_down_width_max',$standard_cord_control_bottom_up_top_down_width_max, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control__bottom_up/top_down_height_min',$standard_cord_control_bottom_up_top_down_height_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'standard_cord_control__bottom_up/top_down_height_max',$standard_cord_control_bottom_up_top_down_height_max, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop_shade_width_min',$continuous_loop_shade_width_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop_shade_width_max',$continuous_loop_shade_width_max, 'fabric_styles_'.$Term['term_id']);
	update_field( 'continuous-loop_shade_height_min',$continuous_loop_shade_height_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop_shade_height_max',$continuous_loop_shade_height_max, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_width_min_panel',$continuous_loop__multiple_shades_on_one_headrail_width_min_panel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_width_max_panel',$continuous_loop__multiple_shades_on_one_headrail_width_max_panel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_width_max_shade_single',$continuous_loop__multiple_shades_on_one_headrail_width_max_shade_single, 'fabric_styles_'.$Term['term_id']);
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_width_max_shade_multiple',$continuous_loop__multiple_shades_on_one_headrail_width_max_shade_multiple, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_height_min_shade',$continuous_loop__multiple_shades_on_one_headrail_height_min_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'continuous-loop__multiple_shades_on_one_headrail_height_max_shade',$continuous_loop__multiple_shades_on_one_headrail_height_max_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_Shade_width_min',$cordless_lift_Shade_width_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_width_max',$cordless_lift_shade_width_max, 'fabric_styles_'.$Term['term_id']);
	update_field( 'cordless_lift_shade_height_min',$cordless_lift_shade_height_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_height_max',$cordless_lift_shade_height_max, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift__multiple_shades_on__one_headrail_width_min_panel',$cordless_lift__multiple_shades_on__one_headrail_width_min_panel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift__multiple_shades_on__one_headrail_width_max_panel',$cordless_lift__multiple_shades_on__one_headrail_width_max_panel, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift__multiple_shades_on__one_headrail_width_max_shade',$cordless_lift__multiple_shades_on__one_headrail_width_max_shade, 'fabric_styles_'.$Term['term_id']);
	update_field( 'cordless_lift__multiple_shades_on__one_headrail_height_min_shade',$cordless_lift__multiple_shades_on__one_headrail_height_min_shade, 'fabric_styles_'.$Term['term_id']);
	update_field( 'cordless_lift__multiple_shades_on__one_headrail_height_max_shade',$cordless_lift__multiple_shades_on__one_headrail_height_max_shade, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_bottom_up/top_down_width_min',$cordless_lift_shade_bottom_up_top_down_width_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_bottom_up/top_down_width_max',$cordless_lift_shade_bottom_up_top_down_width_max, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_bottom_up/top_down_height_min',$cordless_lift_shade_bottom_up_top_down_height_min, 'fabric_styles_'.$Term['term_id'] );
	update_field( 'cordless_lift_shade_bottom_up/top_down_height_max',$cordless_lift_shade_bottom_up_top_down_height_max, 'fabric_styles_'.$Term['term_id']);
	wp_redirect( admin_url( 'term.php?taxonomy=fabric_styles&tag_ID=' . $Term['term_id']."&post_type=product" ) );
}
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
/*
 function my_enqueue($hook) {
    wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/js/javascript_for_admin.js');
}

add_action('admin_enqueue_scripts', 'my_enqueue');




add_action('admin_footer', 'my_admin_footer_function');
function my_admin_footer_function() {
	if(isset($_GET['taxonomy']) && isset($_GET['post_type']))
	{
		if(strcmp($_GET['taxonomy'],'fabric_styles')==0 && strcmp($_GET['post_type'],'product')==0)
		{?>
			<script type="text/javascript">
				jQuery(document).ready(function(e) {
                    jQuery('.field_type-taxonomy').html('test');
                }); 
			</script>
		<?php }
	}
}

*/
add_action('wp_ajax_getProductCatPage', 'getProductCatPage');
add_action('wp_ajax_nopriv_getProductCatPage', 'getProductCatPage');

function getProductCatPage()
{
	$product_cat=$_POST['product_cat'];
	$width=$_POST['width'];
	$height=$_POST['height'];
}

add_filter('tag_row_actions','my_term_action',10,2);
function my_term_action($actions,$tag){
if($tag->taxonomy == 'fabric_styles'):
    $actions['DuplicateTax'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_term_as_draft&taxonomy=fabric_styles&post_type=product&termId=' . $tag->term_id, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
endif;
return $actions;
}
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	//add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
    
