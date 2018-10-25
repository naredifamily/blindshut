<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Blind_Shut
 * @since Blindshut 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_directory'); ?>/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_directory'); ?>/css/line-awesome.min" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_directory'); ?>/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" type="image/x-icon">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.12.4.js"></script>


	<?php wp_head(); ?>

<script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.matchHeight.js"></script>
 <script>
$=jQuery;
$(function() {
	$('.sub_product').matchHeight();
});


$(document).ready(function(){
 $("#header_menu").append("<div class='cross_button afclr'><a><i class='fa fa-times' aria-hidden='true'></i></a></div>");
$(".cross_button").click(function(){
	$(this).parent(".nav-menu").removeClass("state-active");
	$(".overlay").removeClass("active");
	$(this).closest(".body_shift").parent().removeClass("no_overflow");
});
});
</script>
    
    

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
<div class="overlay"></div>

<div class="header afclr">
<div class="top_header">
<div class="wrapper afclr">
<div class="top_left">
<img src="<?php bloginfo('template_directory'); ?>/images/phone_icon.png" alt=""><?php dynamic_sidebar( 'sidebar-4' ); ?><?php /*?><span> <b>Call Us Free 24/7 :</b><a href="tel:95103-242-4679" target="blank"> +95103-242-4679</a></span> <?php */?>
</div>
<div class="top_right">
<ul class="top_link afclr">
<li><a href="#">My Account </a></li>
<li><a href="#">My Wishlist</a></li>
<li class="last"><a href="#">Login</a></li>
</ul>
</div>
</div>
</div>
<div class="mid_header">
<div class="wrapper afclr">
<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt=""></a></div>
<div class="logo_right">
<div class="warp afclr">
<div class="search_part">
<div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?">
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>
</div>
<div class="cart_add"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/cart_icon.png" alt="">CART<span>0</span></a></div>
</div>
<div class="wrap afclr">
<div class="until_part afclr">
<?php dynamic_sidebar( 'sidebar-5' ); ?>
<?php /*?><div class="first_wrap"><div class="inner_first">UNTILL<br>  SATURDAY</div></div>
<div class="second_wrap">45% <p>OFF EVERYTHING</p></div>
<div class="third_wrap">plus <br> extra</div>
<div class="fourth_wrap">10% <p> OFF ORDERS $500+</p></div>
<div class="fifth_wrap">HURRY! SALE ENDS IN: <p>1 DAY 12:00:08</p></div><?php */?>
</div>
</div>
</div>
</div>
</div>
<div class="main_menu">
<div class="wrapper afclr">
<div class="site-menu">
 <a href="javascript:void(1)" class="menu_expand afclr">
 <i></i>
 </a>
 
  <?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu afclr', 'menu_id' => 'header_menu' ) ); ?>
 <?php $product_cat = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
	'parent' => 0,
	'exclude'=>56
) ); 
?>
<ul class="nav-menu" id="header_menu">
<li><a href="#">Home</a></li>
<?php foreach($product_cat as $cat) {
	$product_catInnerSecond = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
	'parent' => $cat->term_id
) );
	 ?> 
<li class="menu-item-has-children"><a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?><?php if(!empty($product_catInnerSecond)){ ?><i class="fa fa-angle-down"></i><?php } ?></a>
<?php if(count($product_catInnerSecond) > 0){
	$count=count($product_catInnerSecond);
	$width=$count*180;
	$innerWidth=100/$count;
	?>
<div class="sub-menu" style="width:<?php echo $width; ?>%">
<?php foreach($product_catInnerSecond as $InnerSecond)
{ 
$product_catInnerThird = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
	'parent' => $InnerSecond->term_id
) );
?>
<div class="class-sub-menu-inner" style="width:<?php echo $innerWidth ?>%">
<h2 class="sub-menu-heading"><?php echo $InnerSecond->name; ?></h2>
<?php if(count($product_catInnerThird) > 0){?>
<ul>
<?php foreach($product_catInnerThird as $InnerThird) {?>
<li><a href="<?php echo get_term_link($InnerThird->term_id); ?>"><?php echo $InnerThird->name; ?></a></li>
<?php } ?>
</ul>

<?php } ?>
</div>
<?php } ?>
</div>
<?php }?>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>

		<div id="content" class="site-content">
