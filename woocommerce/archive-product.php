<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header( 'shop' );
$object=get_queried_object();
$materialArray=(isset($_GET['material']))?(strcmp($_GET['material'],'')!=0)?explode(',',$_GET['material']):array():array();
$roomTypeArray=(isset($_GET['roomtype']))?(strcmp($_GET['roomtype'],'')!=0)?explode(',',$_GET['roomtype']):array():array();
$colorArray=(isset($_GET['color']))?(strcmp($_GET['color'],'')!=0)?explode(',',$_GET['color']):array():array();
$taxArray=array('relation' => 'AND');
if(count($materialArray) > 0)
{
	array_push($taxArray,array(
                'taxonomy' => 'fabric_styles',
                'field' => 'id',
                'terms' => $materialArray,
				'operator' => 'IN'
            ));
}
if(count($roomTypeArray) > 0)
{
	array_push($taxArray,array(
                'taxonomy' => 'room_type',
                'field' => 'id',
                'terms' => $roomTypeArray,
				'operator' => 'IN'
            ));
}
if(count($colorArray) > 0)
{
	array_push($taxArray,array(
                'taxonomy' => 'fabric_styles',
                'field' => 'id',
                'terms' => $colorArray,
				'operator' => 'IN'
            ));
}
array_push($taxArray,array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $object->term_id,
            ));
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$checklink='no';
if (strpos($actual_link, '?') !== false) {
	$checklink='yes';
}
$paged = (isset($_GET['page'])) ? $_GET['page'] : 1;

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */?>
 <div class="banner afclr">
<div class="wrapper">
<div class="product_banner_txt">
<h3><?php echo $object->name; ?></h3>
<p><?php echo $object->description; ?></p>
<div class="product_ban_btn"><a href="#">know more</a></div>
</div>
</div>
</div>
<div class="top_pagination">
<div class="wrapper afclr">
<div class="top_page_inner afclr">
<div class="top_page_left">
<?php woocommerce_breadcrumb(); ?>
</div>
<?php /*
<div class="top_page_right">
<div class="select_list afclr">
	  <label class="sort_txt">  Sort By   </label>
      <select class="selectitem" id="sortBy" name="sortBy">
	  	<option value="0">Select </option>
	  	<option value="ASC">Price (Low to High) </option>
	  	<option value="DESC">Price (High to Low) </option>
	  	<option>Most Reviewd </option>
	  	<option>Highest Rated</option>
	  </select>
   </div>
</div> */?>
</div>
</div>
</div>
<div class="product_main_part afclr">
<div class="wrapper">
<div class="product_main_inner afclr">
<div class="product_main_type">
<div class="size_box">
<div class="size_heading afclr">
<h3>size</h3><span>?</span>
</div>
<?php $width=isset($_GET['width'])?($_GET['width'] > 0)?$_GET['width']:50:50;
$height=isset($_GET['height'])?($_GET['height'] > 0)?$_GET['height']:50:50;

 ?> 
<div class="size_mid afclr">
<span class="size_no"><?=$width?>"x<?=$height?>"</span><a href="javascript:changeSize();"> Change</a>
<div class="clr"></div>
<div class="widthHeightChange">
<p><label>Width: </label><input type="text" id="widthChange" maxlength="3" name="widthChange" value="<?=$width?>"/>
<label>Height: </label><input type="text" id="heightChange" maxlength="3" name="heightChange" value="<?=$height?>"/></p>
<div class="clr"></div>
<p>Your size selection may limit
the products that are displayed</p>
<div class="size_btn afclr"><p><a href="javascript:updateSize();">Update Size</a></p></div>
</div>
</div>
</div>
<script>
function changeSize()
{
	jQuery(document).ready(function(e) {
        jQuery(".widthHeightChange").css("display","block");
    });
}
function updateSize()
{
		jQuery(document).ready(function(e) {
			var material='';
			var color='';
			var roomtype='';
			jQuery(".materialcheckboxs").each(function(index, element) {
                if($(this).is(":checked"))
				{
					if(material=='')
					{
						material=$(this).val();	
					}
					else
					{
						material+=','+$(this).val();	
					}
				}
            });
			jQuery(".colorcheckboxs").each(function(index, element) {
                if($(this).is(":checked"))
				{
					if(color=='')
					{
						color=$(this).val();	
					}
					else
					{
						color+=','+$(this).val();	
					}
				}
            });
			jQuery(".roomtypecheckboxs").each(function(index, element) {
                 if($(this).is(":checked"))
				{
					if(roomtype=='')
					{
						roomtype=$(this).val();	
					}
					else
					{
						roomtype+=','+$(this).val();	
					}
				}
            });
		<?php if(isset($_GET['page']))
		{?>
			window.location.href='<?=get_term_link($object->term_id); ?>'+'?width='+document.getElementById('widthChange').value+'&height='+document.getElementById('heightChange').value+'&material='+material+'&color='+color+'&roomtype='+roomtype+'&page=<?=$_GET['page']?>'; 			
		<?php }
		else { ?>         	
			window.location.href='<?=get_term_link($object->term_id); ?>'+'?width='+document.getElementById('widthChange').value+'&height='+document.getElementById('heightChange').value+'&material='+material+'&color='+color+'&roomtype='+roomtype; 			
		<?php } ?>
		});
}
</script>
<?php $materials = get_terms( array(
    'taxonomy' => 'fabric_styles',
    'hide_empty' => false,
	'parent'	=>0
) ); ?>
<div class="size_box">
<div class="size_heading afclr">
<h3>Material </h3><span>?</span>
</div>
<div class="check_box">
<?php foreach($materials as $material)
{?>
	<input type="checkbox" class="materialcheckboxs" <?php if(in_array($material->term_id,$materialArray)){ echo 'checked';} ?> id="chkMaterial<?php echo $material->term_id ?>" value="<?=$material->term_id ?>" name="chkMaterial[]"><label for="chkMaterial<?php echo $material->term_id ?>"><?php echo $material->name; ?></label><br>
<?php }?>
</div>
<div class="size_btn afclr" style="margin:0 0 0 0;"><p><a href="javascript:updateSize();">Apply</a></p></div>
</div>
<?php $roomTypes = get_terms( array(
    'taxonomy' => 'room_type',
    'hide_empty' => false,
	'parent'	=>0
) ); ?>
<div class="size_box">
<div class="size_heading afclr">
<h3>Room Type</h3><span>?</span>
</div>
<div class="check_box">
<?php foreach($roomTypes as $roomType)
{?>
	<input type="checkbox" class="roomtypecheckboxs" id="chkroomtype<?php echo $roomType->term_id ?>" name="chkRoomtype[]" <?php if(in_array($roomType->term_id,$roomTypeArray)){ echo 'checked';} ?> value="<?=$roomType->term_id ?>"><label for="chkroomtype<?php echo $roomType->term_id ?>"><?php echo $roomType->name; ?></label><br>
<?php }?>
</div>
<div class="size_btn afclr" style="margin:0 0 0 0;"><p><a href="javascript:updateSize();">Apply</a></p></div>
</div>
<div class="size_box">
<div class="size_heading afclr">
<h3>BY COLOR</h3><span>?</span>
</div>
<div class="check_box">
<?php foreach($materials as $material)
{
	$blindtype = get_terms( array(
    'taxonomy' => 'fabric_styles',
    'hide_empty' => false,
	'parent'	=> $material->term_id
) );
	foreach($blindtype as $blind)
	{
		$headingMaterial = get_terms( array(
    		'taxonomy' => 'fabric_styles',
    		'hide_empty' => false,
			'parent'	=> $blind->term_id
		) );
		foreach($headingMaterial as $heading)
		{
			$colors = get_terms( array(
    		'taxonomy' => 'fabric_styles',
    		'hide_empty' => false,
			'parent'	=> $heading->term_id
			) );
			foreach($colors as $color)
			{?>
				<input type="checkbox" class="colorcheckboxs" value="<?=$color->term_id ?>" id="chkColor<?=$color->term_id ?>" name="chkColor[]" <?php if(in_array($color->term_id,$colorArray)){ echo 'checked';} ?>><label for="chkColor<?=$color->term_id ?>"><?php echo $color->name; ?></label><br>
			<?php }
		}
	}
}
$args = array('post_type' => 'product',
        'tax_query' => $taxArray,
		'paged' => $paged,
		'posts_per_page' => 10
     );
	 global $wpdb;
	
     $loop = new WP_Query($args);

?>
</div>
<div class="size_btn afclr" style="margin:0 0 0 0;"><p><a href="javascript:updateSize();">Apply</a></p></div>
</div>
</div>
<div class="product_main_box">
<div class="product_pageination afclr">

<div class="white_header_left"></div>

<div class="pro_page">Page <?=$paged?> of <?php echo $loop->max_num_pages; ?></div>

<div class="pro_page_no">

<ul>

<?php 
	if(strcmp($checklink,'yes')==0)
	{
		$pagebase=str_replace( 'page/999999999/', '', esc_url( get_pagenum_link( 999999999 ) ) );
		$pagebase.='&page=%#%';
	}
	else
	{
		$pagebase=str_replace( 'page/999999999/', '?page=%#%', esc_url( get_pagenum_link( 999999999 ) ) );
	}
echo paginate_links( array(
            'base'         => $pagebase,
            'total'        => $loop->max_num_pages,
            'current'      => $paged,
            'format'       => '&paged=%#%',
            'show_all'     => false,
            'type'         => 'list',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => false,
            'prev_text'    => sprintf( '<i></i> %1$s', __( '<li class="arrow"><a href="#"><i class="fa fa-angle-left"></i></a></li>', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( '<li class="arrow"><a href="#"><i class="fa fa-angle-right"></i></a></li>', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) ); ?>

</ul>

</div>

</div>
<div class="pro_box_outer afclr">
<?php


	 if($loop->have_posts()) {
		  while($loop->have_posts()) : $loop->the_post(); global $product;
		  $productCat=$product;
		  $priceGroup=get_field('price_group', $productCat->get_id(),true);
		  $widthProduct=$width;
		  $heightProduct=$height;
		  //$ProductwidthDefault=get_field('product_width_default',$productCat->get_id(),true);
		  //$ProductheightDefault=get_field('product_height_default',$productCat->get_id(),true);
		  $prices=$wpdb->get_results("SELECT CAST(price AS DECIMAL(10,6)) as price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >= ".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 1");
		 
		  $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
	$productCat1 = wp_get_post_terms( $productCat->get_id(), 'product_cat', $args );
	foreach($productCat1 as $prCat)
	{
		if(strcmp(get_field('profit_margin','product_cat_'.$prCat->term_id),'')!=0 && strcmp(get_field('cost_factor','product_cat_'.$prCat->term_id),'')!=0)
		{
			 $priceGroupMargin=get_field('profit_margin','product_cat_'.$prCat->term_id);
		 	$pricecost_factor=get_field('cost_factor','product_cat_'.$prCat->term_id);
		}
	}	
	  $costMargin=get_field('cost_margin',$productCat->get_id(),true);
	  $profitMargin=get_field('profit_margin',$productCat->get_id(),true);
	  if(strcmp($costMargin,'')==0)
	  {
		  $costMargin=$pricecost_factor;
	  }
	   if(strcmp($profitMargin,'')==0)
	  {
		  $profitMargin=$priceGroupMargin;
	  }
	  $priceProduct=money_format("%i",$prices[0]->price);
	  $costPrice=(($priceProduct*$costMargin));
	  $costPlusProfitProductPrice=$costPrice+(($costPrice*$profitMargin)/100);
	  $pricePercentage=(int)(($priceProduct-$costPlusProfitProductPrice)*100)/$priceProduct;
	  ?>
		<div class="pro_box">

			<div class="pro_box_inner">

				<div class="product_img"><?php echo woocommerce_get_product_thumbnail() ?></div>

				<div class="product_over">

					<div class="product_free">FREE CORDLESS</div>

				</div>

				<div class="product_over1">

					<div class="product_like"><img src="<?php echo get_template_directory_uri(); ?>/images/like_icon.png" alt=""></div>

				</div>

			</div>

			<div class="product_txt afclr">

				<h3><?php echo $product->name; ?></h3>

				<div class="sub_product"><p class="off"><?php echo floor($pricePercentage) ?>% off</p></div>

				<div class="sub_product"><p class="retail">Retail $<?php echo money_format("%i",$prices[0]->price); ?></p></div>

				<div class="sub_product"><p class="price">$<?php echo number_format($costPlusProfitProductPrice,2); ?></p></div>

				<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>
				<?php if(get_field('certified',$productCat->get_id(),true)) {?>
<div class="sub_product"><img src="<?php echo get_template_directory_uri()?>/images/product_certified.png" alt=""></div>
<?php }
else 
{?>
	<div class="sub_product"></div>
<?php }?>
				<div class="sub_product"><p class="color">see 9 Colors</p></div>

				<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>

				<div class="sub_product"><div class="shop_btn1"><a href="<?php the_permalink(); ?>">Shop Now</a></div></div>

			</div>

		</div>
<?php 
		endwhile;
}
else
{
	echo "No product in this criteria";
}?>

</div>


<div class="product_pageination afclr">

<div class="white_header_left"></div>

<div class="pro_page">Page <?=$paged?> of <?php echo $loop->max_num_pages; ?></div>

<div class="pro_page_no">

<ul>

<?php 
if(strcmp($checklink,'yes')==0)
	{
		$pagebase=str_replace( 'page/999999999/', '', esc_url( get_pagenum_link( 999999999 ) ) );
		$pagebase.='&page=%#%';
	}
	else
	{
		$pagebase=str_replace( 'page/999999999/', '?page=%#%', esc_url( get_pagenum_link( 999999999 ) ) );
	}
echo paginate_links( array(
            'base'         => $pagebase,
            'total'        => $loop->max_num_pages,
            'current'      => $paged,
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'list',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => false,
            'prev_text'    => '<i class="fa fa-angle-left"></i>',
            'next_text'    => '<i class="fa fa-angle-right"></i>',
            'add_args'     => false,
            'add_fragment' => '',
        ) ); ?>

</ul>

</div>

</div>



</div>







</div>

</div>

</div><?php /*
<div class="product_page afclr">

<div class="wrapper">

<div class="product_heading">

<h2>Recently Viewed</h2>

</div>

<div class="product_inner afclr">

<div class="swiper-container slider2">

<div class="swiper-wrapper">

<div class="swiper-slide">

<div class="product_box">

<div class="product_box_inner">

<div class="product_img"><img src="images/product_1.jpg" alt=""></div>

<div class="product_over">

<div class="product_free">FREE CORDLESS</div>

</div>

<div class="product_over1">

<div class="product_like"><img src="images/like_icon.png" alt=""></div>

</div>

</div>

<div class="product_txt afclr">

<h3>Value Light Filtering Sheer Shades</h3>

<div class="sub_product"><p class="off">33% off</p></div>

<div class="sub_product"><p class="retail">Retail $77.61</p></div>

<div class="sub_product"><p class="price">$52.00</p></div>

<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>

<div class="sub_product"><img src="images/certified.png" alt=""></div>

<div class="sub_product"><p class="color">see 9 Colors</p></div>

<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>

<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>

</div>

</div>



</div>

<div class="swiper-slide">

<div class="product_box">

<div class="product_box_inner">

<div class="product_img"><img src="images/product_2.jpg" alt=""></div>

<div class="product_over">

<div class="product_free">FREE CORDLESS</div>

</div>

<div class="product_over1">

<div class="product_like"><img src="images/like_icon.png" alt=""></div>

</div>

</div>

<div class="product_txt afclr">

<h3>Value Light Filtering Sheer Shades</h3>

<div class="sub_product"><p class="off">33% off</p></div>

<div class="sub_product"><p class="retail">Retail $77.61</span></div>

<div class="sub_product"><p class="price">$52.00</p></div>

<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>

<div class="sub_product"><img src="images/certified.png" alt=""></div>

<div class="sub_product"><p class="color">see 9 Colors</p></div>

<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>

<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>

</div>

</div>

</div>

<div class="swiper-slide">

<div class="product_box">

<div class="product_box_inner">

<div class="product_img"><img src="images/product_3.jpg" alt=""></div>

<div class="product_over">

<div class="product_free">FREE CORDLESS</div>

</div>

<div class="product_over1">

<div class="product_like"><img src="images/like_icon.png" alt=""></div>

</div>

</div>

<div class="product_txt afclr">

<h3>Value Light Filtering Sheer Shades</h3>

<div class="sub_product"><p class="off">33% off</p></div>

<div class="sub_product"><p class="retail">Retail $77.61</span></div>

<div class="sub_product"><p class="price">$52.00</p></div>

<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>

<div class="sub_product"><img src="images/certified.png" alt=""></div>

<div class="sub_product"><p class="color">see 9 Colors</p></div>

<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>

<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>

</div>

</div>

</div>

<div class="swiper-slide">

<div class="product_box">

<div class="product_box_inner">

<div class="product_img"><img src="images/product_4.jpg" alt=""></div>

<div class="product_over">

<div class="product_free">FREE CORDLESS</div>

</div>

<div class="product_over1">

<div class="product_like"><img src="images/like_icon.png" alt=""></div>

</div>

</div>

<div class="product_txt afclr">

<h3>Value Light Filtering Sheer Shades</h3>

<div class="sub_product"><p class="off">33% off</p></div>

<div class="sub_product"><p class="retail">Retail $77.61</span></div>

<div class="sub_product"><p class="price">$52.00</p></div>

<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>

<div class="sub_product"><img src="images/certified.png" alt=""></div>

<div class="sub_product"><p class="color">see 9 Colors</p></div>

<div class="sub_product"><div class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i></div></div>

<div class="sub_product"><div class="shop_btn"><a href="#">Shop Now</a></div></div>

</div>

</div>

</div>

<div class="swiper-slide">

<div class="product_box">

<div class="product_box_inner">

<div class="product_img"><img src="images/product_1.jpg" alt=""></div>

<div class="product_over">

<div class="product_free">FREE CORDLESS</div>

</div>

<div class="product_over1">

<div class="product_like"><img src="images/like_icon.png" alt=""></div>

</div>

</div>

<div class="product_txt afclr">

<h3>Value Light Filtering Sheer Shades</h3>

<div class="sub_product"><p class="off">33% off</p></div>

<div class="sub_product"><p class="retail">Retail $77.61</span></div>

<div class="sub_product"><p class="price">$52.00</p></div>

<div class="sub_product"><p class="extra">+ an extra 10% off</p></div>

<div class="sub_product"><img src="images/certified.png" alt=""></div>

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

</div> */?>
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
<script>
    var swiper = new Swiper('.swiper-container.slider2', {
      slidesPerView: 4,
      slidesPerColumn: 1,
      spaceBetween:30,
	  slidesPerColumnFill: 'column',
	  loop:true,
	  navigation: {
      nextEl: '.swiper-button-next.product_nav',
      prevEl: '.swiper-button-prev.product_nav',
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
 <?php
//do_action( 'woocommerce_before_main_content' );


	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 
	do_action( 'woocommerce_after_shop_loop' );
	*/


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
