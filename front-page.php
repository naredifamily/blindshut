<?php
/**
 * The front page template file
 */

get_header(); ?>

</div>

<div class="icon_part afclr">
<div class="wrapper">
<div class="icon_part_inner afclr">
<?php

if( have_rows('top_icon_block') ): ?>

 	<?php // loop through the rows of data

        while ( have_rows('top_icon_block') ) : the_row(); ?>

    <?php $image = get_sub_field('icon_image');?>
        

<div class="icon_part_box">
<div class="icon_img"><img src="<?php echo $image['url']; ?>" alt="<?php the_sub_field('alt'); ?>" /></div>
<div class="icon_txt">
<?php the_sub_field('icon_right_content'); ?>
</div>
</div>

    <?php endwhile; ?>

 <?php endif; ?>
</div>
</div>
</div>
 
<!-- Slider Start --> 
<div class="slider">
<div class="wrapper">
<div class="slider_inner afclr">
<div class="slider_part">
<div class="main_slider">
<div class="swiper-container slider_banner">
<div class="swiper-wrapper">
<?php

if( have_rows('home_shop_slider') ): ?>

 	<?php // loop through the rows of data

        while ( have_rows('home_shop_slider') ) : the_row(); ?>

    <?php $image = get_sub_field('home_shop_slider_image');?>
        

<div class="swiper-slide afclr">
<div class="banner_img"><img src="<?php echo $image['url']; ?>" alt="<?php the_sub_field('alt'); ?>" /></div>
<div class="banner_txt_pos">
<div class="banner_txt afclr">
<?php the_sub_field('home_shop_slider_content'); ?>
<div class="banner_btn afclr"><a href="<?php the_sub_field('home_shop_slider_shop_link'); ?>">shop now</a></div>
</div>
</div>
</div>
    <?php endwhile; ?>

 <?php endif; ?>
</div>
<div class="swiper-button-next slider_nav"></div>
<div class="swiper-button-prev slider_nav"></div>
</div>
<script>
    var swiper = new Swiper('.swiper-container.slider_banner', {
	loop:true,
	autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next.slider_nav',
        prevEl: '.swiper-button-prev.slider_nav',
      },
    });
  </script>
</div>
<div class="main_slider1">
<div class="banner_1_img"><?php 

$image = get_field('home_shop_block3_image');

if( !empty($image) ): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; ?></div>
<div class="banner_pos_text">
<div class="banner_1_txt">
<?php the_field('home_shop_block3_content'); ?>
</div>
</div>
</div>
</div>
<div class="slider_part1">
<div class="main_slider2">
<div class="banner_1_img"><?php 

$image = get_field('home_shop_block2_image');

if( !empty($image) ): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; ?></div>
<div class="banner_pos_text2">
<div class="banner_2_txt">
<div class="banner_btn1 afclr"><a href="<?php the_field('home_shop_block2_content'); ?>">shop now</a></div>
<div class="banner_pos">
<div class="rect_text"><?php the_field('home_shop_block2_content'); ?>
</div>
</div>
</div>
</div>
</div>
<div class="main_slider3">
<div class="banner_1_img"><?php 

$image = get_field('home_shop_block4_image');

if( !empty($image) ): ?>

	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php endif; ?></div>
<div class="banner_pos_text3">
<div class="banner_3_txt">
<div class="banner_pos_in">
<div class="rect_text3">
<?php the_field('home_shop_block4_content'); ?>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<!-- Client End --> 


<!-- Product Start --> 
<div class="product afclr">
<div class="wrapper">
<div class="product_heading">
<?php the_field('best_block_heading'); ?>
</div>
<div class="product_inner afclr">
<div class="swiper-container slider2">
<div class="swiper-wrapper">
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_1.jpg" alt=""></div>
<div class="product_over">
<div class="product_free">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><a class="color">see 9 Colors</a>
</div>

<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_2.jpg" alt=""></div>
<div class="product_over">
<div class="product_free">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_3.jpg" alt=""></div>
<div class="product_over">
<div class="product_free">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_4.jpg" alt=""></div>
<div class="product_over">
<div class="product_free">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_1.jpg" alt=""></div>
<div class="product_over">
<div class="product_free">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>

</div>
</div>
<div class="swiper-button-next product_nav"></div>
<div class="swiper-button-prev product_nav"></div>
</div>
</div>
</div>
<script>
    var swiper = new Swiper('.swiper-container.slider2', {
      slidesPerView: 4,
      slidesPerColumn: 1,
      spaceBetween:30,
	  slidesPerColumnFill: 'column',
	  autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
	  loop:true,
	  
	  navigation: {
      nextEl: '.swiper-button-next.product_nav',
      prevEl: '.swiper-button-prev.product_nav',
		},
		
     
	   breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 20
            },
			
			993: {
                slidesPerView: 3,
                spaceBetween: 20
            },
			
			
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            479: {
                slidesPerView: 1,
                spaceBetween: 10
            }
	   }
	  
	  
	  
    });
  </script>

<!-- Product End -->


<!--- feature Product -->
<div class="product_feature afclr">
<div class="wrapper">
<div class="product_heading">
<h2>Featured Products</h2>
</div>
<div class="product_inner afclr">
<div class="swiper-container slider2">
<div class="swiper-wrapper">
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_1.jpg" alt=""></div>
<div class="product_over">
<div class="product_free_feature">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_2.jpg" alt=""></div>
<div class="product_over">
<div class="product_free_feature">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_3.jpg" alt=""></div>
<div class="product_over">
<div class="product_free_feature">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_4.jpg" alt=""></div>
<div class="product_over">
<div class="product_free_feature">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>

</div>
</div>
<div class="swiper-slide">
<div class="product_box">
<div class="product_box_inner">
<div class="product_img"><img src="<?php bloginfo('template_directory'); ?>/images/product_1.jpg" alt=""></div>
<div class="product_over">
<div class="product_free_feature">FREE CORDLESS</div>
</div>
<div class="product_over1">
<div class="product_like"><img src="<?php bloginfo('template_directory'); ?>/images/like_icon.png" alt=""></div>
</div>
</div>
<div class="product_txt afclr">
<h3>Value Light Filtering Sheer Shades</h3>
<div class="sub_product"><p class="off">33% off</p></div>
<div class="sub_product"><p class="retail">Retail $77.61</span></div>
<div class="sub_product"><p class="price">$52.00</p></div>
<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
<div class="sub_product"><img src="<?php bloginfo('template_directory'); ?>/images/certified.png" alt=""></div>
<div class="sub_product"><p class="color">see 9 Colors</p></div>
<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>
<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>
</div>
</div>
</div>

</div>
</div>
<div class="swiper-button-next product_nav1"></div>
<div class="swiper-button-prev product_nav1"></div>
</div>
</div>
</div>
<script>
    var swiper = new Swiper('.swiper-container.slider2', {
      slidesPerView: 4,
      slidesPerColumn: 1,
      spaceBetween:30,
	  slidesPerColumnFill: 'column',
	  
	  loop:true,
	  
	  navigation: {
      nextEl: '.swiper-button-next.product_nav1',
      prevEl: '.swiper-button-prev.product_nav1',
		},
		autoplay: {
    delay: 2500,
  },
     
	   breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 20
            },
			
			993: {
                slidesPerView: 3,
                spaceBetween: 20
            },
			
			
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            479: {
                slidesPerView: 1,
                spaceBetween: 10
            }
	   }
	  
	  
	  
    });
  </script>

 
<!-- Feature Product End -->



 
<!-- Client Start --> 
<div class="client afclr">
<div class="wrapper">
<h3>Hear from Our Customers</h3>
</div>
<div class="wrapper">
<div class="swiper-container client_slider">
<div class="swiper-wrapper">

<?php $args = array(
'posts_per_page'   => 6,
'offset'           => 0,
'category'         => '',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => '',
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'testimonial',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true ); ?>
<?php $posts_array = get_posts( $args ); ?> 
<?php foreach($posts_array as $testimonial)
 {?>
<div class="swiper-slide">
<div class="clinet_inner afclr">

<div class="client_reviews">
<div class="client_profile afclr">
<div class="client_img"><?php echo get_the_post_thumbnail( $testimonial->ID, 'testimonial' ); ?></div>
<div class="client_name"><h4><?php echo $testimonial->post_title; ?><br><span>Manager</span></h4></div>
</div>
<div class="client_txt">
<p><?php echo wp_trim_words( $testimonial->post_content,30) ?></p>
</div>
</div>

</div>
</div>

<?php }?>

</div>
<div class="swiper-button-next client_arrow"></div>
<div class="swiper-button-prev client_arrow"></div>
</div>
</div>
</div>
<script>
    var swiper = new Swiper('.swiper-container.client_slider', {
	loop:true,
      navigation: {
        nextEl: '.swiper-button-next.client_arrow',
        prevEl: '.swiper-button-prev.client_arrow',
      },
    });
  </script>


<!-- Client End --> 

 
<!-- News Start --> 
<div class="news_part afclr">
<div class="wrapper">
<h3>Join our Newsletter</h3>
<p>Subscribe our newsletter to stay up to date width the latest news, special offers and other stuff.</p>
<div class="news_form_part">
<form name="form1" method="post">
<div class="news_email_part">
<input type="email" name="email" placeholder="Enter your email address...">
<input type="submit" name="submit" value="Subscribe">
</div><!--nws_email-->
</form>
</div>
</div>
</div>
<!-- News End -->  

 
<!-- Get-Part Start -->
<div class="get_part afclr">
<div class="wrapper">
<div class="get_inner_part afclr">
<div class="get_box">
<h3>Free samples</h3>
<p>Compare styles, colors and materials right in your window.</p>
<div class="get_btn"><a href="#">Get Started</a></div>
</div>
<div class="get_box">
<h3>Surefit<sup>tm</sup> guarantee</h3>
<p>by risk free - with a guaranteed fit for your window</p>
<div class="get_btn"><a href="#">Get Started</a></div>
</div>
<div class="get_box">
<h3>WE’re here to help</h3>
<p>No robots here! get free expert advice from real people.</p>
<div class="get_btn"><a href="#">Get Started</a></div>
</div>
</div>
</div>
</div>
<!-- Get-Part End -->


<?php get_footer();
