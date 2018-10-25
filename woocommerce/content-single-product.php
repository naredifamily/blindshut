<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
?>
<link href="<?php echo get_template_directory_uri();?>/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css">
<script src="<?php echo get_template_directory_uri();?>/js/easy-responsive-tabs.js"></script> 
<script src="<?php echo get_template_directory_uri();?>/js/jquery.matchHeight.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/slippry.min.js"></script>
<link href="<?php echo get_template_directory_uri();?>/css/slippry.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function getMaxWidthMaxHeight(ProductFabricTermId)
	{

		jQuery(document).ready(function(e) {
			var widthproduct=jQuery("#widthproduct").val();
			var widthproductinner=jQuery("#widthproductinner").val();
			var heightproduct=jQuery("#heightproduct").val();
			var heightproductinner=jQuery("#heightproductinner").val();
			var term_id=jQuery(".liftingSystem:checked").val();
		var shadesize=parseInt(jQuery("input.size_checked_select[type='radio']:checked").attr("shade-size"));
		if(shadesize==1)
		{
			widthproduct=parseFloat(jQuery("#widthproductSingleBlind").val());
			heightproduct=parseFloat(jQuery("#widthproductinnerSingleBlind").val());
		}
		else if(shadesize==2)
		{
			widthproduct=parseFloat(jQuery("#widthproductRightBlind").val())+parseFloat(jQuery("#widthproductSingleBlind").val());
			widthproductinner=parseFloat(jQuery("widthproductinnerRightBlind").val())+parseFloat(jQuery("#widthproductinnerSingleBlind").val());
		}
		else if(shadesize==3)
		{
			widthproduct=parseFloat(jQuery("#widthproductCenterBlind").val())+parseFloat(jQuery("#widthproductRightBlind").val())+parseFloat(jQuery("#widthproductSingleBlind").val());
			widthproductinner=parseFloat(jQuery("widthproductinnerCenterBlind").val())+parseFloat(jQuery("#widthproductinnerRightBlind").val())+parseFloat(jQuery("#widthproductinnerSingleBlind").val());
		}
		
		jQuery("#widthproduct option[value='"+widthproduct+"']").prop('selected',true);
		jQuery("#widthproductinner option[value='"+widthproductinner+"']").prop('selected',true);
    		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=getMaxWidthMaxHeight&FabricTermId="+ProductFabricTermId+"&widthproduct="+widthproduct+"&widthproductinner="+widthproductinner+"&heightproduct="+heightproduct+"&heightproductinner="+heightproductinner+"&liftOptionTermid="+term_id,
				success: function(data)
				{
					if(data.msg!='')
					{
						jQuery('.messageSize').css("display","block");
						jQuery('.messageSize').html(data.msg);
					}
					else
					{
						jQuery('.messageSize').css("display","none");
						calculatePriceSize();
					}
				}
			});
		});
	}
</script>
<?php
/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
global $wpdb;
$productCat=new WC_Product(get_the_ID());
$priceGroup=get_field('price_group', $productCat->get_id(),true);
$productFields=get_fields($productCat->get_id());


	$ProductwidthDefault=get_field('product_width_default',$productCat->get_id(),true);
	$ProductheightDefault=get_field('product_height_default',$productCat->get_id(),true);
	$widthProduct=7;
	$heightProduct=10;
	if($ProductwidthDefault!=0)
	{
		 $widthProduct=$ProductwidthDefault;
	}
	if($ProductheightDefault!=0)
	{
		$heightProduct=$ProductheightDefault;
	}
	
	$prices=$wpdb->get_results("SELECT CAST(price AS DECIMAL(10,6)) as price FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup. " AND width >= ".$widthProduct." AND height >= ".$heightProduct." ORDER BY price ASC LIMIT 1");
	
?>
<div class="product_detail afclr">
<div class="wrapper">
<div class="product_detail_inner afclr">
<div class="pro_detail_box">
<div class="pro_detail_slider afclr"><?php
global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( has_post_thumbnail() ) {
			$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>

<?php /*<div class="pro_detail_img">
<img src="<?php echo get_template_directory_uri()?>/images/product-5.jpg" alt="">
</div>
<div class="pro_detail_sub_img afclr">
<ul>
<li><img src="<?php echo get_template_directory_uri()?>/images/top_icon.png" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-1.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-2.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-3.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-4.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-4.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/product-slide-4.jpg" alt=""></li>
<li><img src="<?php echo get_template_directory_uri()?>/images/bottom_icon.png" alt=""></li>
</ul>
</div>
<?php */ ?>
</div>
</div>
<?php 
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
<div class="pro_detail_box">
<div class="pro_detail_con">
<h3><?php echo $productCat->get_title(); ?></h3>
<div class="pro_price afclr">
<div class="pro_price_left"><span class="off"><span id="offPercentage"><?php echo floor($pricePercentage) ?></span>% off</span></div><div class="pro_price_right"><span class="retail">Retail <span id="retailPrice">$<?php echo money_format("%i",$prices[0]->price); ?></span></span></div>
<div class="pro_price_left"><span class="extra priceProduct">$<?php echo number_format($costPlusProfitProductPrice,2); ?></span><p class="extra_off">+ an extra 10% off</p></div>
<?php if(get_field('certified',$productCat->get_id(),true)) {?>
<div class="pro_price_right"><img src="<?php echo get_template_directory_uri()?>/images/product_certified.png" alt=""></div>
<?php } ?>
</div>
<div class="product_star">
<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star last"></i>
</div>
<?php 
global $wpdb;
$widths=$wpdb->get_row("SELECT max(width) as maxwidth FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup);
 ?>

<div class="pro_detail_desc afclr">
<?php $description = apply_filters( 'woocommerce_description', $product->description ); ?>
<div class="woocommerce-product-details__short-description">
	<?php echo $description; // WPCS: XSS ok. ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<input type="hidden" id="productPriceCore" name="productPriceCore" value="" />
<div class="clear"></div>
<!-- product-detail Start -->
<div class="product_tab afclr">
<div class="wrapper">
<div id="horizontalTab">
 <ul class="resp-tabs-list afclr">
  <li><a>Product Option </a></li>
  <li><a>Product Detail</a></li>
  <li><a>Ask a Question</a></li>
  <li><a>Customer Review</a></li>
  <li><a>Warranty</a></li>
  <li><a>Installation</a></li>
 </ul>
 
<div class="resp-tabs-container">
<div class="tab_1 afclr">
<div class="pro_tab_outer">
<div class="tab_inner afclr">
<div class="pro_inner_box">
<div class="selectASizeofproduct">
<div class="pro_detail_size afclr">
<h4>Select Size of product :</h4>
<div class="sub_width">
<label for="widthproduct">Width :</label><br>
<select id="widthproduct" name="widthproduct">
<?php for($i=7;$i<$widths->maxwidth;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($widthProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
<select id="widthproductinner" name="widthproductinner">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>

<?php $heights=$wpdb->get_row("SELECT max(height) as maxheight FROM `".$wpdb->prefix."groupTerm` WHERE groupid=".$priceGroup); ?>
<div class="sub_height">
<label for="heightproduct">Height :</label><br>
<select id="heightproduct" name="heightproduct">
<?php for($i=10;$i<$heights->maxheight;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($heightProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
<select id="heightproductinner" name="heightproductinner">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
</div>
</div>
<div class="select_room">
<h4>SELECT A ROOM</h4>
<div class="pro_icon_box afclr">
<?php $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
$roomTypes = wp_get_post_terms($productCat->get_id(), 'room_type',$args);
$checkRoom=0;
$roomDefault='';
foreach($roomTypes as $room)
{
	if($checkRoom==0)
	{
		$roomDefault=$room->name;
	}
	$image= get_field('image', 'room_type_'.$room->term_id);
	$imagehover= get_field('imagehover', 'room_type_'.$room->term_id);
	
 ?>
<div class="pro_icon">
<div class="pro_tab_icon roomtypenrml <?php if($checkRoom==0) { echo "active";} ?>" term_id="<?php echo $room->term_id; ?>" term_slug="<?php echo $room->slug; ?>" term_name="<?php echo $room->name; ?>">
<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"  class="nrml_img">
<img src="<?php echo $imagehover['url']; ?>" alt="<?php echo $imagehover['alt']; ?>"  alt=""  class="hover_image">
<h5><?php echo $room->name; ?></h5>
</div>
</div>
<?php $checkRoom=1; } ?>
<script type="text/javascript">
jQuery(document).ready(function(e) {
    jQuery(".roomtypenrml").click(function(e) {
        jQuery(".roomtypenrml").removeClass("active");
		jQuery(this).addClass("active");
		jQuery("#roomTypeSummary").html(jQuery(this).attr("term_name"));
		jQuery("#roomTypeSummary").attr(jQuery(this).attr("term_slug"));
		jQuery("#windowNameSummary").html(jQuery(this).attr("term_name"));
		jQuery("#windowNameSummary").attr(jQuery(this).attr("term_slug"));
    });
});
</script>
</div>
</div>
<?php 
$args = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all','parent'=> 0);
$fabric_styles11=wp_get_post_terms($productCat->get_id(),'fabric_styles',$args);
$args1 = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all','parent'=> $fabric_styles11[0]->term_id);
$fabric_styles2=wp_get_post_terms($productCat->get_id(),'fabric_styles',$args1);
$args2 = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all','parent'=> $fabric_styles2[0]->term_id);
$fabric_styles=wp_get_post_terms($productCat->get_id(),'fabric_styles',$args2);

 ?>
<div class="select_color">
<h4> select a product color</h4>
<div class="color_box afclr">
<div class="main_color">
<?php $image_color=get_field('color_image',$productCat->get_id(),true); ?>
<?php $default_color=get_field('default_color',$productCat->get_id(),true); ?>
<?php if(isset($image_color['url']))
{?>
<img src="<?php echo $image_color['url']; ?>" alt="<?php ?>">
<?php }
else 
{?>
	<div class="imageNotSet" style='background:url(<?php echo $image_color['url']; ?>);background-repeat:repeat;height:400px;'></div>
<?php }
 ?>
<h5>Get Free Sample</h5>
<h6><?php echo $default_color->name; ?></h6>
</div>
<div class="other_color">
<?php $colorDefault='';
$checkColor=0;
?>
<select id="colorStyle" name="colorStyle">
<?php foreach($fabric_styles as $style)
{
	$args1 = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all','parent'=> $style->term_id);
	$fabric_styles1=wp_get_post_terms($productCat->get_id(),'fabric_styles',$args1); 
	foreach($fabric_styles1 as $styleInner)
	{
		if($checkColor==0)
		{
			$colorDefault=$style->name;
		}
	?>
<option value="<?php echo $styleInner->term_id; ?>" <?php if($checkColor==0) { echo "selected='selected'";} ?> ><?php echo $style->name; ?> - <?php echo $styleInner->name; ?> - <?php echo $styleInner->term_id; ?></option>
<?php $checkColor=1; 
	} 
}?>
</select>
<div class="color_box_inner afclr">
<?php 
$checkColor=0;
foreach($fabric_styles as $style)
{?>

	<div class="style_inner"><h2><?php echo $style->name; ?></h2></div>
	<div class="style_outlet">
<?php 
	$args1 = array('orderby' => 'name', 'order' => 'DESC', 'fields' => 'all','parent'=> $style->term_id);
	$fabric_styles1=wp_get_post_terms($productCat->get_id(),'fabric_styles',$args1);
	foreach($fabric_styles1 as $styleInner)
	{?>
		<div class="color_type">
<div class="color_pro_box <?php if($checkColor==0) { echo "active";} ?> pro_box_<?php echo $styleInner->term_id;  ?>"  term-id="<?php echo $styleInner->term_id; ?>" term-name="<?php echo $styleInner->name; ?>">
<?php $img=get_field('color','fabric_styles_'.$styleInner->term_id,true); ?>
<?php $color_image_fabric=get_field('color_image_fabric','fabric_styles_'.$styleInner->term_id,true); ?>
<div class="color_name"><a href="#" class="fabric_images"><img src="<?php echo $img['url'] ?>" fabric-url="<?php echo $color_image_fabric['url']; ?>" style="width:88px; height: 88px;" /></a></div>
<h5>Get Free Sample</h5>
<h6><?php echo $styleInner->name ?></h6>
</div>
</div>
	<?php $checkColor=1; }
	?></div><?php
}
 ?>
<script type="text/javascript">
jQuery(document).ready(function(e) {
	jQuery("#colorStyle").change(function(e) {
        jQuery(".pro_box_"+jQuery(this).val()).click();
    });
	if(jQuery(".main_color div.imageNotSet").length > 0)
	{
		
		jQuery(".main_color div.imageNotSet").css({"background":"url("+jQuery(".color_pro_box.active").children(".color_name").children(".fabric_images").children("img").attr("fabric-url")+")","background-size":"50px","background-repeat":"repeat"});
	}
	else
	{
		jQuery(".main_color img").css({"background-image":"url("+jQuery(".color_pro_box.active").children(".color_name").children(".fabric_images").children("img").attr("fabric-url")+")","background-size":"50px"});
	}
	//alert(jQuery(".color_pro_box.active").children(".color_name").children(".fabric_images").children("img").attr("fabric-url"));
	
    jQuery(".fabric_images").click(function(e) {
        
    });
	jQuery(".color_pro_box").click(function(e) {
		e.preventDefault();
		jQuery(".color_pro_box.active").removeClass("active");
		if(jQuery(".main_color div.imageNotSet").length > 0)
	{
		jQuery(".main_color div.imageNotSet").css({"background":"url("+jQuery(this).children(".color_name").children(".fabric_images").children("img").attr("fabric-url")+")","background-size":"50px","background-repeat":"repeat"});
	}
	else
	{
		jQuery(".main_color img").css({"background":"url("+jQuery(this).children(".color_name").children(".fabric_images").children("img").attr("fabric-url")+")","background-size":"50px"});
	}
		jQuery(this).addClass("active");
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		$('#colorStyle option[value='+term_id+']').prop('selected',true);
		$("#windowColorSummary").html(jQuery(this).attr("term-name"));
    });
});
</script>
<?php /*
<div class="color_type">
<div class="color_pro_box">
<div class="color_name1"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>

<div class="color_type">
<div class="color_pro_box">
<div class="color_name2"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>

<div class="color_type">
<div class="color_pro_box">
<div class="color_name3"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>

<div class="color_type">
<div class="color_pro_box">
<div class="color_name"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>

<div class="color_type">
<div class="color_pro_box">
<div class="color_name1"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>

<div class="color_type">
<div class="color_pro_box">
<div class="color_name2"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>
<div class="color_type">
<div class="color_pro_box">
<div class="color_name3"></div>
<h5>Get Free Sample</h5>
<h6>Bistre 9822</h6>
</div>
</div>
*/ ?>
</div>
</div>
</div>
</div>
<?php $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
$mountOption = wp_get_post_terms($productCat->get_id(), 'mount_option',$args);?>
<div class="select_mount">
<h4>Select a mount option</h4>
<div class="mount_radio afclr">
<?php 
$check=0;
$mountOptionDefaultName='';
foreach($mountOption as $option)
{
	$image= get_field('image', 'mount_option_'.$option->term_id);
	if($check==0)
	{
		$mountOptionDefaultName=$option->name;
	}
	?>
<div class="mount_input"><img src="<?php echo $image['url']; ?>" /><input type="radio" <?php if($check==0){ echo "checked='checked';";}?> class="mountOptionRadio" id="mountoption_<?php echo $option->term_id; ?>" name="mountoption" value="<?php echo $option->name; ?>" term-id="<?php echo $option->term_id; ?>"><label for="mountoption_<?php echo $option->term_id; ?>"><?php echo $option->name; ?></label></div>
<?php $check=1; } ?>
<?php /*<div class="mount_input"><input type="radio" id="mountoption" name="mountoption"><label>Outside (included in price)</label></div>*/ ?>
</div>
<div class="select_learn"><a href="#">Learn More</a></div>
</div>
<?php $selectASize=get_field('select_a_size',$productCat->get_id(),true);?>
<?php if(count($selectASize) > 0)
{?>
<div class="select_size">
<h4>Select a Size</h4>
<div class="select_size_outer afclr">
<?php 
$imageUrl='';
$defaultSizeShade=1;
$term_idDefault=1;
foreach($selectASize as $size)
{
	if(strcmp($size['default'],'yes')==0)
	{
		$SelectSizeImage=get_field('image','size_'.$size['size']->term_id,true); 
		$imageUrl=$SelectSizeImage['url'];
		$Selectshades=get_field('shades','size_'.$size['size']->term_id,true);
		$defaultSizeShade=$Selectshades;
		$term_idDefault=$size['size']->term_id;
		break;
	}
}
if(strcmp(trim($imageUrl),'')==0)
{
	$ichecknew=0;
	
	foreach($selectASize as $size)
	{
		if($ichecknew==0)
		{
			$SelectSizeImage=get_field('image','size_'.$size['size']->term_id,true); 
			$imageUrl=$SelectSizeImage['url'];
			$Selectshades=get_field('shades','size_'.$size['size']->term_id,true);
			$defaultSizeShade=$Selectshades;
			$term_idDefault=$size['size']->term_id;
			break;
		}
		$ichecknew++;
	}	
}
?>
	<div class="selectsizeouter">
    <div class="imageheadrail">
    	<img src="<?php echo $imageUrl; ?>" id="headrail" name="headrail" />
    </div>
	<div class="selectheadrail">
    <?php 
	$ippp=0;
	foreach($selectASize as $size)
	{
		$default=$size['default'];
		$SelectSizeImage=get_field('image','size_'.$size['size']->term_id,true); 
		$Selectshades=get_field('shades','size_'.$size['size']->term_id,true);
		if(strcmp($default,'yes')==0)
		{
			$ippp=1;
			?>
        <div class="lift_input_size"><input type="radio" sale-added="<?php echo $size['sale_added']; ?>" price-added="<?php echo $size['price_added']; ?>" name="select_size" class="size_checked_select" imageUrl="<?php echo $SelectSizeImage['url']; ?>" shade-size="<?php echo $Selectshades; ?>" checked="checked" term-id="<?php echo $size['size']->term_id; ?>" id="size_<?php echo $size['size']->term_id ?>"><label for="size_<?php echo $size['size']->term_id ?>"><?php echo $size['size']->name ?>
		<?php if($size['price_added'] > 0)
		{
			echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$size['price_added'].'</span> '.get_woocommerce_currency_symbol().$size['sale_added'].')';
		} ?></label></div>
        <?php
		}
		else
		{
	 ?>
		<div class="lift_input_size"><input type="radio" <?php if($term_idDefault==$size['size']->term_id) { echo "checked='checked';";} ?> class="size_checked_select" sale-added="<?php echo $size['sale_added']; ?>" price-added="<?php echo $size['price_added']; ?>" imageUrl="<?php echo $SelectSizeImage['url']; ?>" shade-size="<?php echo $Selectshades; ?>" name="select_size" id="size_<?php echo $size['size']->term_id ?>"><label for="size_<?php echo $size['size']->term_id ?>"><?php echo $size['size']->name ?>
		<?php if($size['price_added'] > 0)
		{
			echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$size['price_added'].'</span> '.get_woocommerce_currency_symbol().$size['sale_added'].')';
		} ?></label></div>
        <?php } } ?>
	</div>
    </div>
    <div class="sizeSelectHead SingleBlind">
    <div class="headingSingleBlind">
<label>Single Blind</label>
</div>
<div class="select_size_heading">Width:</div>
<div class="select_size_box">
<select id="widthproductSingleBlind" name="widthproductSingleBlind">
<?php for($i=7;$i<$widths->maxwidth;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($widthProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="widthproductinnerSingleBlind" name="widthproductinnerSingleBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
<div class="select_size_outer afclr">
<div class="select_size_heading">Height:</div>
<div class="select_size_box">
<select id="heightproductSingleBlind" name="heightproductSingleBlind">
<?php for($i=10;$i<$heights->maxheight;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($heightProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="heightproductinnerSingleBlind" name="heightproductinnerSingleBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
</div>
</div>
<div class="sizeSelectHead CenterBlind" <?php if($defaultSizeShade==3) { echo "style='display:block';";} ?>>
    <div class="headingSingleBlind">
<label>Center Blind</label>
</div>
<div class="select_size_heading">Width:</div>
<div class="select_size_box">
<select id="widthproductCenterBlind" name="widthproductCenterBlind">
<?php for($i=7;$i<$widths->maxwidth;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($widthProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="widthproductinnerCenterBlind" name="widthproductinnerCenterBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
<div class="select_size_outer afclr">
<div class="select_size_heading">Height:</div>
<div class="select_size_box">
<select id="heightproductCenterBlind" name="heightproductCenterBlind">
<?php for($i=10;$i<$heights->maxheight;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($heightProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="heightproductinnerCenterBlind" name="heightproductinnerCenterBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
</div>
</div>


<div class="sizeSelectHead RightBlind" <?php if($defaultSizeShade==2) { echo "style='display:block';";} ?>>
    <div class="headingSingleBlind">
<label>Right Blind</label>
</div>
<div class="select_size_heading">Width:</div>
<div class="select_size_box">
<select id="widthproductRightBlind" name="widthproductRightBlind">
<?php for($i=7;$i<$widths->maxwidth;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($widthProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="widthproductinnerRightBlind" name="widthproductinnerRightBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
<div class="select_size_outer afclr">
<div class="select_size_heading">Height:</div>
<div class="select_size_box">
<select id="heightproductRightBlind" name="heightproductRightBlind">
<?php for($i=10;$i<$heights->maxheight;$i++)
{
?><option value="<?php echo $i; ?>" <?php if($heightProduct==$i){echo "selected='selected'";} ?>><?php echo $i; ?></option>
<?php 
}?>
</select>
</div>
<div class="select_size_box">
<select id="heightproductinnerRightBlind" name="heightproductinnerRightBlind">
<option value="0">.</option>
<option value=".125">1/8"</option>
<option value=".25">1/4"</option>
<option value=".375">3/8"</option>
<option value=".5">1/2"</option>
<option value=".625">5/8"</option>
<option value=".75">3/4"</option>
<option value=".875">7/8"</option>
</option>
</select>
</div>
</div>
</div>

</div>
<div class="messageSize alert alert-warning" style="display: none;">
	
</div>
</div>
<?php } ?>
<?php $liftoptions=get_field('lift_option',$productCat->get_id(),true);
if(count($liftoptions) > 0)
{
 ?>
<div class="select_lift">
<h4>select a lift option</h4>
<?php 
$imageurlDefaultLift='';
foreach($liftoptions as $option)
{
	if(strcmp($option['default'],'yes')==0)
	{
		$imageurl1=get_field('image','lift_option_'.$option['option']->term_id,true);
		$imageurlDefaultLift=$imageurl1['url'];
		break;
	}
}
 ?>
<div class="lift_radio afclr">
<div class="selectsizeouter">
    <div class="imageliftoption">
    	<img src="<?php echo $imageurlDefaultLift; ?>" id="headrail" name="headrail" />
    </div>
	<div class="selectheadrail">
    <?php  foreach($liftoptions as $option)
	{ 
		$imageurl=get_field('image','lift_option_'.$option['option']->term_id,true);
		$optionsLiftSelect=get_field('options','lift_option_'.$option['option']->term_id,true);
	?>
<div class="lift_input_size"><input type="radio" sale-added="<?php echo $option['sale_price_added']; ?>" price-added="<?php echo $option['price_added']; ?>" value="<?php echo $option['option']->term_id; ?>" name="liftOption" class="liftOptionClass liftingSystem" term-id="<?php echo $option['option']->term_id; ?>" image-url="<?php echo $imageurl['url']; ?>" id="liftoption_<?php echo $option['option']->term_id; ?>" <?php if(strcmp($option['default'],'yes')==0) { echo "checked='checked'"; } ?>><label for="liftoption_<?php echo $option['option']->term_id; ?>"><?php echo $option['option']->name; 
if($option['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$option['price_added'].'</span> '.get_woocommerce_currency_symbol().$option['sale_price_added'].')'; }  ?> </label>
<?php 
$iOption=0;
foreach($optionsLiftSelect as $select)
{?>
	<select id="selectLiftLeft<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectLiftLeft" name="selectLift" <?php if(strcmp($option['default'],'yes')!=0) { echo "style='display:none;';"; } ?>>
    	<option><?php echo $select['place_holder']; ?></option>
    	<?php foreach($select['select_options'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
    <select id="selectLiftCenter<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectLiftCenter" name="selectLift" <?php echo "style='display:none;';"; ?>>
    	<option><?php echo $select['place_holder']; ?> for the center shade</option>
    	<?php foreach($select['select_options'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
    <select id="selectLiftRight<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectLiftRight" name="selectLift" <?php echo "style='display:none;';"; ?>>
    	<option><?php echo $select['place_holder']; ?> for the right shade</option>
    	<?php foreach($select['select_options'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
<?php $iOption++; }?>
</div>
<?php } ?>
</div>
</div>
<div class="select_learn"><a href="#">Learn More</a></div>
</div>
</div>
<div class="messageLift alert alert-warning" style="display: none;">
	
</div>
<?php } ?>

<?php $tiltoptions=get_field('tilt_option',$productCat->get_id(),true); ?>
<?php if(count($tiltoptions) > 0)
{?>
<div class="select_tilt">
<h4>Select a tilt option</h4>
<?php 
$imageurlDefaultLift='';
foreach($tiltoptions as $option)
{
	if(strcmp($option['default'],'yes')==0)
	{
		$imageurl1=get_field('image','tilt_option_'.$option['option']->term_id,true);
		$imageurlDefaultLift=$imageurl1['url'];
		$term_idDefault=$option['option']->term_id;
		break;
	}
}


if(strcmp(trim($imageurlDefaultLift),'')==0)
{
	$ichecknew=0;
	
	foreach($tiltoptions as $option)
	{
		if($ichecknew==0)
		{
			
			$imageurl1=get_field('image','tilt_option_'.$option['option']->term_id,true);
		$imageurlDefaultLift=$imageurl1['url'];
			$term_idDefault=$option['option']->term_id;
			break;
		}
		$ichecknew++;
	}
}


 ?>
<div class="lift_radio afclr">
<div class="selectsizeouter">
    <div class="imagetiltoption">
    	<img src="<?php echo $imageurlDefaultLift; ?>" id="headrail" name="headrail" />
    </div>
	<div class="selectheadrail">
    <?php 
	$tiltoptionsDefault='';
	?>
    <?php  foreach($tiltoptions as $option)
	{
		if(strcmp($option['default'],'yes')==0)
	{
		$tiltoptionsDefault=$option['option']->name;
	}
		$imageurl=get_field('image','tilt_option_'.$option['option']->term_id,true);
		$optionsLiftSelect=get_field('select','tilt_option_'.$option['option']->term_id,true);
		
	?>
<div class="tilt_radio"><input type="radio"  sale-added="<?php echo $option['sale_price_added']; ?>" price-added="<?php echo $option['price_added']; ?>" <?php if($term_idDefault==$option['option']->term_id) { echo "checked='checked'";}?> name="tiltOption" class="tiltOptionClass" term-id="<?php echo $option['option']->term_id; ?>" value="<?php echo $option['option']->name;?>" image-url="<?php echo $imageurl['url']; ?>" id="liftoption_<?php echo $option['option']->term_id; ?>" <?php if(strcmp($option['default'],'yes')==0) { echo "checked='checked'"; } ?>><label for="liftoption_<?php echo $option['option']->term_id; ?>"><?php echo $option['option']->name; 
if($option['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$option['price_added'].'</span> '.get_woocommerce_currency_symbol().$option['sale_price_added'].')'; }  ?> </label>
<?php 
$iOption=0;
foreach($optionsLiftSelect as $select)
{
	?>
	<select id="selectTiltOption<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectTiltOptionLeft" name="selectTiltOption" <?php if(strcmp($option['default'],'yes')!=0) { echo "style='display:none;';"; } ?>>
    	<option><?php echo $select['place_holder']; ?></option>
    	<?php foreach($select['select_option'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
    <select id="selectTiltOptionCenter<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectTiltOptionCenter" name="selectTiltOption" <?php echo "style='display:none;';"; ?>>
    	<option><?php echo $select['place_holder']; ?> for the center shade</option>
    	<?php foreach($select['select_option'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
    <select id="selectTiltOptionRight<?php echo $option['option']->term_id; ?>_<?php echo $iOption ?>" class="selectTiltOptionRight" name="selectTiltOption" <?php  echo "style='display:none;';"; ?>>
    	<option><?php echo $select['place_holder']; ?> for the right shade</option>
    	<?php foreach($select['select_option'] as $selectOption)
		{?>
			<option value="<?php echo $selectOption['title']; ?>"><?php echo $selectOption['title']; ?></option>
		<?php }?>
    </select>
<?php $iOption++; }?>
</div>
<?php }?>
<div class="select_learn"><a href="#">Learn More</a></div>
</div>
</div>
</div>
</div>
<div class="messageTilt alert alert-warning" style="display: none;">
	
</div>
<?php } ?>
<?php $tiltoptions=get_field('decorative_accent',$productCat->get_id(),true); ?>
<?php if(count($tiltoptions) > 0)
{?>
<div class="select_accent">
<h4>Select a decorative accent</h4>
<?php 
$imageurlDefaultLift='';
foreach($tiltoptions as $option)
{
	
	if(strcmp($option['default'],'yes')==0)
	{
		$imageurl1=get_field('image','decorative_accent_'.$option['decorative_accent']->term_id,true);
		$imageurlDefaultLift=$imageurl1['url'];
		break;
	}
}
 ?>
<div class="accent_radio afclr">
<div class="selectsizeouter">
    <div class="imageDecorative_accent">
    	<img src="<?php echo $imageurlDefaultLift; ?>" id="headrail" name="headrail" />
    </div>
	<div class="selectheadrail">
    <?php  foreach($tiltoptions as $option)
	{ 
		$imageurl=get_field('image','decorative_accent_'.$option['decorative_accent']->term_id,true);
		$optionscolorsSelect=get_field('colors','decorative_accent_'.$option['decorative_accent']->term_id,true);
	?>
<div class="decorativeAccent_select"><input type="radio"  sale-added="<?php echo $option['sale_price']; ?>" price-added="<?php echo $option['price_added']; ?>" name="decorative_Option" term-id="<?php echo $option['decorative_accent']->term_id; ?>" class="decorative_OptionClass" image-url="<?php echo $imageurl['url']; ?>" id="decorative_Option<?php echo $option['decorative_accent']->term_id; ?>" <?php if(strcmp($option['default'],'yes')==0) { echo "checked='checked'"; } ?>><label for="decorative_Option<?php echo $option['decorative_accent']->term_id; ?>"><?php echo $option['decorative_accent']->name; 
if($option['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$option['price_added'].'</span> '.get_woocommerce_currency_symbol().$option['sale_price'].')'; }  ?> </label>
<?php if(count($optionscolorsSelect) > 0)
{?>
<select id="colorSelectDecorative_Option<?php echo $option['decorative_accent']->term_id; ?>" name="colorSelectDecorative_Option<?php echo $option['decorative_accent']->term_id; ?>" <?php if(strcmp($option['default'],'yes')!=0) { echo "style='display:none;'"; } ?>>
<option>Please select a color...</option>
<?php foreach($optionscolorsSelect as $select)
{?>
<option value="<?php echo  str_replace(' ','',preg_replace('~[\\\\/:()"<>|]~', ' ', $select['title'])); ?>"><?php echo $select['title']; ?></option>
<?php } ?>
</select>
<div class="accent_color afclr" <?php if(strcmp($option['default'],'yes')!=0) { echo "style='display:none;'"; } ?>>
<?php foreach($optionscolorsSelect as $select)
{?>
<div class="accent_type aceent_type_<?php echo  str_replace(' ','',preg_replace('~[\\\\/:()"<>|]~', ' ', $select['title'])); ?>" color-title="<?php echo  str_replace(' ','',preg_replace('~[\\\\/:()"<>|]~', ' ', $select['title'])); ?>" color-url="<?php echo $select['image']['url']; ?>">
<div class="accent_pro_box">
<div class="accent_name"><img src="<?php echo $select['image']['url']; ?>" /></div>
<h6><?php echo $select['title']; ?></h6>
</div>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
</div>
</div>


</div>
<?php } ?>
<?php $route_lesss=get_field('route_less',$productCat->get_id(),true); ?>
<?php if(count($route_lesss) > 0)
{?>
<div class="select_route">
<h4>Select a routeless option</h4>
<?php 
$imageurlDefaultRouteLess='';
foreach($route_lesss as $route_less)
{
	if(strcmp($route_less['default'],'yes')==0)
	{
		$imageurl1=get_field('image','routeless_'.$route_less['title']->term_id,true);
		$imageurlDefaultRouteLess=$imageurl1['url'];
		break;
	}
}

 ?>
<div class="selectsizeouter">
    <div class="imageROUTELESS">
    	<img src="<?php echo $imageurlDefaultRouteLess; ?>" id="headrail" name="headrail">
    </div>
	<div class="selectheadrail">
    <?php foreach($route_lesss as $route_less)
	{
		$imageurl1=get_field('image','routeless_'.$route_less['title']->term_id,true);
		?>
    <div class="routeless_select"><input type="radio"  sale-added="<?php echo $route_less['sale_price']; ?>" price-added="<?php echo $route_less['price_added']; ?>" name="routeLess" class="routeLessClass" value="<?php echo $route_less['title']->name;?>" image-url="<?php echo $imageurl1['url']; ?>" term-id="<?php echo $route_less['title']->term_id; ?>" id="routeLess_<?php echo $route_less['title']->term_id; ?>" <?php if(strcmp($route_less['default'],'yes')==0) { echo "checked='checked'"; } ?>><label for="routeLess_<?php echo $route_less['title']->term_id; ?>"><?php echo $route_less['title']->name; 
if($route_less['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$route_less['price_added'].'</span> '.get_woocommerce_currency_symbol().$route_less['sale_price'].')'; }  ?> </label></div>
    <?php } ?>
    
</div>
</div>

<div class="clr"></div>
</div>
<?php } ?>
<?php $route_lesss=get_field('valance_option',$productCat->get_id(),true); ?>
<?php if(count($route_lesss) > 0)
{?>
<div class="select_valance">
<h4>Select a valance option</h4>
<?php
$imageurlDefaultvalance='';
$checkDefault=0;
foreach($route_lesss as $route_less)
{
	if(strcmp($route_less['default'],'yes')==0)
	{
		$imageurl1=get_field('image','valance_option_'.$route_less['option']->term_id,true);
		$imageurlDefaultvalance=$imageurl1['url'];
		break;
	}
}
if(strcmp($imageurl1,'')==0 || strcmp($imageurlDefaultvalance,'')==0)
{
	$imageurl1=get_field('image','valance_option_'.$route_lesss[0]['option']->term_id,true);
	$imageurlDefaultvalance=$imageurl1['url'];
	$checkDefault=1;
}
 ?>
 <div class="selectsizeouter">
    <div class="imagevalance">
    	<img src="<?php echo $imageurlDefaultvalance ?>" id="headrail" name="headrail">
    </div>
	<div class="selectheadrail">
    
    <?php 
	$itnew=0;
	foreach($route_lesss as $route_less)
	{
		$imageurl1=get_field('image','valance_option_'.$route_less['option']->term_id,true);
		?>
    <div class="valance_radio"><input type="radio" sale-added="<?php echo $route_less['sale_price_added']; ?>" price-added="<?php echo $route_less['price_added']; ?>" name="valance" class="valanceClass" value="<?php echo $route_less['option']->name;?>" image-url="<?php echo $imageurl1['url']; ?>" term-id="<?php echo $route_less['option']->term_id; ?>" id="valance_<?php echo $route_less['option']->term_id; ?>" <?php if(strcmp($route_less['default'],'yes')==0 || ($checkDefault==1 && $itnew==0)) { echo "checked='checked'"; } ?>><label for="valance_<?php echo $route_less['option']->term_id; ?>"><?php echo $route_less['option']->name; 
if($route_less['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$route_less['price_added'].'</span> '.get_woocommerce_currency_symbol().$route_less['sale_price_added'].')'; }  ?> </label></div>
    <?php $itnew++;} ?>
        
</div>
</div>
<div class="clr"></div>
</div>
<?php } ?>
<?php 
$fieldArray=array('lift_option','valance_option','select_a_size','tilt_option','color_image','decorative_accent','route_less'); //'route_less'
foreach($productFields as $field=>$value) 
{
	if(is_array($value))
	{
		if(!in_array($field,$fieldArray))
		{
			 $imageurlDefaultLift='';
			 $itt=0;
			 $ipp=0;
			 $defaulttermid=0;
			
				foreach($value as $v)
				{
					
					if($itt==0)
					{
					$getTerm=get_term($v['title']->term_id);
					$itt++;
					}
				if(strcmp($v['default'],'yes')==0)
					{
						$getTerm=get_term($v['title']->term_id);
						$defaulttermid=$v['title']->term_id;
						$imageurl1=get_field('image',$getTerm->taxonomy.'_'.$v['title']->term_id,true);
						$imageurlDefaultLift=$imageurl1['url'];
						$ipp=1;
						break;
					}
				}
				if($ipp==0)
				{
					$ittw=0;
					foreach($value as $v)
				{
					
					if($ittw==0)
					{
						$ittw=1;
						$getTerm=get_term($v['title']->term_id);
						$defaulttermid=$v['title']->term_id;
						$imageurl1=get_field('image',$getTerm->taxonomy.'_'.$v['title']->term_id,true);
						$imageurlDefaultLift=$imageurl1['url'];
					}
				}
				}
				?>
               
                <div class="select_accent">
<h4>Select a <?php echo $getTerm->name; ?></h4>
				<div class="accent_radio afclr">
<div class="selectsizeouter">
    <div class="imageheadraildImage CustomTax_<?php echo $getTerm->taxonomy ?>">
    	<img src="<?php echo $imageurlDefaultLift; ?>" id="headrail" name="headrail" />
    </div>
    <div class="selectheadrail">
				<?php
				
			foreach($value as $v)
			{
				
				$getTerm=get_term($v['title']->term_id);
				$imageurl=get_field('image',$getTerm->taxonomy.'_'.$v['title']->term_id,true);
				?>
                <div class="valance_radio"><input sale-added="<?php echo $v['sale_price']; ?>" price-added="<?php echo $v['price_added']; ?>" type="radio" name="<?php echo $getTerm->taxonomy ?>" class="CustomTax_<?php echo $getTerm->taxonomy ?>Class customtaxClasses" value="<?php echo $getTerm->term_id;?>" image-url="<?php echo $imageurl['url']; ?>" term-id="<?php echo $getTerm->term_id; ?>" id="valance_<?php echo $getTerm->term_id; ?>" <?php if($defaulttermid==$getTerm->term_id) { echo "checked='checked'"; } ?>><label for="valance_<?php echo $getTerm->term_id; ?>"><?php echo $getTerm->name; 
if($v['price_added']==0){ echo " (included in price)"; }else { echo '(add <span class="ng-binding">'.get_woocommerce_currency_symbol().$v['price_added'].'</span> '.get_woocommerce_currency_symbol().$v['sale_price'].')'; }  ?> </label></div>
<?php
				
				//$imageurl=get_field('image','decorative_accent_'.$option['decorative_accent']->term_id,true);
				//$optionscolorsSelect=get_field('colors','decorative_accent_'.$option['decorative_accent']->term_id,true);
			}
				?>
                <script type="text/javascript">
					jQuery(document).ready(function(e) {
                        jQuery(".CustomTax_<?php echo $getTerm->taxonomy ?>Class").click(function(e) {
                            
        			var ImageUrl=jQuery(this).attr("image-url");
		  				jQuery(".CustomTax_<?php echo $getTerm->taxonomy ?> img").attr("src",ImageUrl);
		 calculatePriceSize();
                        });
                    });
				</script>
				</div>
                </div>
                </div>
                </div>
				<?php
				
	
		}
	}
	?>
	
<?php }
?>
<div class="optional_info">
<h4>Optional information</h4>
<h5>Nickname for your window</h5>
<input type="text" style="display:none" id="calPrice" name="calPrice" value="<?php echo number_format($costPlusProfitProductPrice,2); ?>" />
<input type="text" id="nickname" name="nickname" value="">
</div>
<div class="summary"> 
<h4>summary</h4>
<div class="summary_inner afclr">
<div class="summary_sub">
<div class="summary_field afclr"><label class="title">unit price :</label><span class="price" id="productPrice">$<?php echo number_format($costPlusProfitProductPrice,2); ?></span></div>
</div>
<div class="summary_sub">
<div class="summary_field afclr"><label class="title1">total price :</label><span class="price2" id="productPriceTotal">$<?php echo number_format($costPlusProfitProductPrice,2); ?></span></div>
</div>
<div class="summary_sub">
<div class="summary_field afclr"><label class="title1">quantity :</label><input type="text" id="quantity" onblur="functionQuantityChange();" onkeyup="functionQuantityChange();" name="quantity" value="1"></div>
</div>
</div>
<div class="order_blind_btn"><a href="#" class="orderBlinds"><div class="btn_cl">Order My Blinds</div></a></div>
</div>
</div>
<script type="text/javascript">
	jQuery(document).scroll(function(e) {
        	var windowPosition=parseFloat(jQuery(this).scrollTop());
        	var selectRoomPosition=parseFloat(jQuery('.select_room').offset().top);
        	var selectSummary=parseFloat(jQuery(".optional_info h5").offset().top)-60;
        	if(windowPosition >= selectSummary)
        	{
        		jQuery(".pro_inner_box_right").removeClass("fixed").addClass("bottom");
        	}
        	else if(windowPosition >= selectRoomPosition)
        	{
        		jQuery(".pro_inner_box_right").removeClass('bottom').addClass("fixed");
        	}
        	else
        	{
        		//console.log(windowPosition);
        		jQuery('.pro_inner_box_right').removeClass('bottom');
        		jQuery('.pro_inner_box_right').removeClass('fixed');
        	}

    	});
	jQuery(".orderBlinds").click(function(e) {
		e.preventDefault();
		var centerWidth=0;
		var centerHeight=0;
		var rightWidth=0;
		var rightHeight=0;
		var shade=jQuery(".size_checked_select:checked").attr("shade-size");
		if(shade==2)
		{
			rightWidth=parseInt(jQuery('.widthproductRightBlind').val());
			rightHeight=parseInt(jQuery('.heightproductRightBlind').val());
			if(parseFloat(jQuery('.widthproductinnerRightBlind').val()) > 0)
			{
				rightWidth++;
			}
			if(parseFloat(jQuery('.heightproductinnerRightBlind').val()) > 0)
			{
				rightHeight++;
			}
		}
		else if(shade==3)
		{
			centerWidth=parseInt(jQuery('.widthproductCenterBlind').val());
			centerHeight=parseInt(jQuery('.heightproductCenterBlind').val());
			if(parseFloat(jQuery('.widthproductinnerCenterBlind').val()) > 0)
			{
				centerWidth++;
			}
			if(parseFloat(jQuery('.heightproductinnerCenterBlind').val()) > 0)
			{
				centerHeight++;
			}
		}
        jQuery.ajax({
			url:"<?php echo admin_url( 'admin-ajax.php' ); ?>",
			type:"POST",
			data:{ 'action':'orderBlind',
				   'product_id':'<?php echo $productCat->get_id(); ?>',
				   'quantity':document.getElementById("quantity").value,
				   'roomType':jQuery(".roomtypenrml.active").attr("term_id"),
				   'color':jQuery(".color_pro_box.active").attr("term-id"),
				   'mount':jQuery(".mountOptionRadio:checked").attr("term-id"),
				   'size':jQuery(".size_checked_select:checked").attr("term-id"),
				   'shade':shade,
				   'rightWidth':rightWidth,
				   'rightHeight':rightHeight,
				   'centerWidth':centerWidth,
				   'centerHeight':centerHeight,
				   'width':jQuery("#widthproduct").val(),
				   'height':jQuery("#heightproduct").val(),
				   'widthInner':jQuery("#widthproductinner").val(),
				   'heightInner':jQuery("#heightproductinner").val(),
				   'product_price':document.getElementById("calPrice").value,
				   'liftOption':jQuery(".liftOptionClass:checked").attr("term-id"),
				   'tiltOption':jQuery(".tiltOptionClass:checked").attr("term-id"),
				   'decorative':jQuery(".decorative_OptionClass:checked").attr("term-id"),
				   'routeless':jQuery(".routeLessClass:checked").attr("term-id"),
				   'valanceOption':jQuery(".valanceClass:checked").attr("term-id"),
				   'nickname':document.getElementById("nickname").value
				 },
			success: function(data)
			{
				window.location.href="<?php echo get_permalink(5); ?>";
			}
		});
		
    });

</script>
<div class="pro_inner_box_right">
<div class="option_right afclr">
<h3>Options Summary</h3>
<ul>
<li><strong>Room :</strong> <span id="roomTypeSummary"><?php echo $roomDefault ?></span>  </li>
<li><strong>Window Name :</strong> <span id="windowNameSummary"><?php echo $roomDefault ?></span> </li>
<li><strong>Headrail :</strong> <span id="headrailSummary">Single headrail</span></li>
<li><strong>Width :</strong> <span id="windowWidthSummary"><?php echo $widthProduct; ?></span>  <span id="windowWidthInnerSummary">0/0</span></li>
<li><strong>Length:</strong> <span id="windowLengthSummary"><?php echo $heightProduct; ?></span> <span id="windowHeightInnerSummary">0/0</span></li>
<li><strong>Mount :</strong> <span id="windowMountSummary"><?php echo $mountOptionDefaultName; ?></span></li>
<li><strong>Color Option :</strong> <span id="windowColorSummary"><?php echo $colorDefault; ?></span></li>
<li><strong>Tilting Option :</strong> <span id="windowTiltingSummary"><?php echo $tiltoptionsDefault; ?></span></li>
<li><strong>Price :</strong> <span id="priceProductSummary">$<?php echo number_format($costPlusProfitProductPrice,2); ?></span></li>
</ul>
</div>
</div>
 </div>
</div>
</div>



</div>
</div>
</div>
</div>
<script>
function calculatePriceSize()
{
	jQuery(document).ready(function ()
	{
		var custom=0;
		jQuery(".customtaxClasses").each(function(index, element) {
           if(jQuery(this).is(":checked"))
		   {
				  var customAdded=parseInt(jQuery(this).attr("sale-added")); 
				  if (!isNaN(customAdded))
					{
						custom+=customAdded;
					}
		   }
        });
		
		var shade=parseInt(jQuery(".size_checked_select:checked").attr('shade-size'));
		var liftAdded=parseInt(jQuery(".liftingSystem:checked").attr("sale-added"));
		var tiltAdded=parseInt(jQuery(".tiltOptionClass:checked").attr("sale-added"));
		var priceAdded=parseInt(jQuery(".size_checked_select:checked").attr('sale-added'));
		var decorativeAdded=parseInt(jQuery(".decorative_OptionClass:checked").attr('sale-added'));
		var routeLessClass=parseInt(jQuery(".routeLessClass:checked").attr('sale-added'));
		var valanceClass=parseInt(jQuery(".valanceClass:checked").attr('sale-added'));
		if (isNaN(liftAdded))
		{
			liftAdded=0;
		}
		if (isNaN(routeLessClass))
		{
			routeLessClass=0;
		}
		if (isNaN(tiltAdded))
		{
			tiltAdded=0;
		}
		if (isNaN(valanceClass))
		{
			valanceClass=0;
		}
		if (isNaN(decorativeAdded))
		{
			decorativeAdded=0;
		}
		
		if (!isNaN(priceAdded))
		{
		var widthp=parseInt(jQuery("#widthproductSingleBlind").val());
		var heightp=parseInt(jQuery("#heightproductSingleBlind").val());
		if(jQuery("#widthproductinnerSingleBlind").val() > 0)
		{
			widthp++;
		} 
		if(jQuery("#heightproductinnerSingleBlind").val() > 0)
		{
			heightp++;
		}
		if(shade==2)
		{
			widthp+=parseInt(jQuery("#widthproductRightBlind").val());
			if(jQuery("#widthproductinnerRightBlind").val() > 0)
			{
				widthp++;
			}
			heightp+=parseInt(jQuery("#heightproductRightBlind").val());
			if(jQuery("#heightproductinnerRightBlind").val() > 0)
			{
				heightp++;
			}
		}
		else if(shade==3)
		{
			widthp+=parseInt(jQuery("#widthproductRightBlind").val());
			if(jQuery("#widthproductinnerRightBlind").val() > 0)
			{
				widthp++;
			}
			heightp+=parseInt(jQuery("#heightproductRightBlind").val());
			if(jQuery("#heightproductinnerRightBlind").val() > 0)
			{
				heightp++;
			}
			widthp+=parseInt(jQuery("#widthproductCenterBlind").val());
			if(jQuery("#heightproductinnerCenterBlind").val() > 0)
			{
				widthp++;
			}
			heightp+=parseInt(jQuery("#heightproductCenterBlind").val());
			if(jQuery("#heightproductinnerCenterBlind").val() > 0)
			{
				heightp++;
			}
		}
		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=getHeightWidthBlindShade&width="+widthp+"&height="+heightp+"&pricegroup=<?php echo $priceGroup ?>&productId=<?php echo $productCat->get_id(); ?>",
			success: function(data)
			{
				jQuery("#retailPrice").html(data.price+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass);
				jQuery("#offPercentage").html(data.discountpercentage);
				jQuery(".priceProduct").html("$"+parseFloat(data.actualPrice+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass+custom)*1);
				jQuery("#productPrice").html("$"+parseFloat(data.actualPrice+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass+custom)*1);
				jQuery("#calPrice").val(parseFloat(data.actualPrice+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass+custom)*1);
				jQuery("#productPriceTotal").html("$"+parseFloat(data.actualPrice+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass+custom)*parseInt(document.getElementById("quantity").value));
				jQuery("#priceProductSummary").html("$"+parseFloat(data.actualPrice+priceAdded+liftAdded+tiltAdded+decorativeAdded+routeLessClass+valanceClass+custom)*1);
			},
			error: function(error)
			{

			}
		});
		}
	});
}
jQuery(document).ready(function () {
	jQuery(".mountOptionRadio").click(function(e) {
        jQuery("#windowMountSummary").html(jQuery(this).val());
    });
	jQuery(".valanceClass").click(function(e) {
        var ImageUrl=jQuery(this).attr("image-url");
		  jQuery(".imagevalance img").attr("src",ImageUrl);
		  calculatePriceSize();
		  
    });
	jQuery(".routeLessClass").click(function(e) {
        jQuery(".imageROUTELESS img").attr("src",jQuery(this).attr("image-url"));
		calculatePriceSize();
    });
	jQuery(".decorativeAccent_select select").change(function(e) {
        jQuery(".aceent_type_"+jQuery(this).val()).click();
    });
	jQuery(".accent_type").click(function(e) {
        var ImageUrl=jQuery(this).attr("color-url");
		jQuery(".accent_type.active").removeClass("active");
		jQuery(this).addClass("active");
		var term_id=jQuery(this).attr("color-title");
		
		$('.decorativeAccent_select select option[value='+term_id+']').prop('selected',true);
		calculatePriceSize();
		
    });
	jQuery(".decorative_OptionClass").click(function(e) {
          var ImageUrl=jQuery(this).attr("image-url");
		  jQuery(".imageDecorative_accent img").attr("src",ImageUrl);
		  jQuery(".decorative_OptionClass").parent(".decorativeAccent_select").children("select").css("display","none");
		   jQuery(".decorative_OptionClass").parent(".decorativeAccent_select").children("div.accent_color").css("display","none");
		  jQuery(this).parent(".decorativeAccent_select").children("select").css("display","block");
		   jQuery(this).parent(".decorativeAccent_select").children("div.accent_color").css("display","block");
		   calculatePriceSize();
    });
	jQuery(".liftOptionClass").click(function(e) {
		
        var ImageUrl=jQuery(this).attr("image-url");
		jQuery(".imageliftoption img").attr("src",ImageUrl);
		jQuery(".liftOptionClass").parent(".lift_input_size").children("select").css("display","none");
		jQuery(this).parent(".lift_input_size").children("select.selectLiftLeft").css("display","block");
		var shade=jQuery(".size_checked_select:checked").attr("shade-size");
		if(jQuery(".size_checked_select:checked").attr('shade-size')==2)
		{
			jQuery(this).parent('.lift_input_size').children(".selectLiftLeft").css("display","block");
			jQuery(this).parent('.lift_input_size').children(".selectLiftRight").css('display','block');
			jQuery(this).parent('.lift_input_size').children('.selectLiftCenter').css('display','none');
		}
		else if(jQuery(".size_checked_select:checked").attr('shade-size')==3)
		{
			jQuery(this).parent('.lift_input_size').children(".selectLiftLeft").css("display","block");
			jQuery(this).parent('.lift_input_size').children(".selectLiftRight").css('display','block');
			jQuery(this).parent('.lift_input_size').children('.selectLiftCenter').css('display','block');
		}
		else if(jQuery(".size_checked_select:checked").attr('shade-size')==1)
		{
			jQuery(this).parent('.lift_input_size').children(".selectLiftLeft").css("display","block");
			jQuery(this).parent('.lift_input_size').children(".selectLiftRight").css('display','none');
			jQuery(this).parent('.lift_input_size').children('.selectLiftCenter').css('display','none');
		}




		if((shade==2) && jQuery(this).val()!=59)
		{
			jQuery(".messageLift").html('The "Cordless" or "No" lift cannot be combined with the "Two-on-One" headrail.  Please change one of your selections.');
			jQuery(".messageLift").css('display','block');
		}
		else if((shade==3) && jQuery(this).val()!=59)
		{
			jQuery(".messageLift").html('The "Cordless" or "No" lift cannot be combined with the "Three-on-One" headrail.  Please change one of your selections.');
			jQuery(".messageLift").css('display','block');
		}
		else
		{
			jQuery(".messageTilt").html('');
			jQuery(".messageLift").css('display','none');
		}
		calculatePriceSize();
    });
	jQuery(".tiltOptionClass").click(function(e) {
        var ImageUrl=jQuery(this).attr("image-url");
		jQuery(".imagetiltoption img").attr("src",ImageUrl);
		jQuery(".tiltOptionClass").parent(".tilt_radio").children("select").css("display","none");
		if(jQuery(".size_checked_select:checked").attr('shade-size')==2)
		{
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionLeft").css("display","block");
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionRight").css('display','block');
			jQuery(this).parent('.tilt_radio').children('.selectTiltOptionCenter').css('display','none');
		}
		else if(jQuery(".size_checked_select:checked").attr('shade-size')==3)
		{
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionLeft").css("display","block");
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionRight").css('display','block');
			jQuery(this).parent('.tilt_radio').children('.selectTiltOptionCenter').css('display','block');
		}
		else if(jQuery(".size_checked_select:checked").attr('shade-size')==1)
		{
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionLeft").css("display","block");
			jQuery(this).parent('.tilt_radio').children(".selectTiltOptionRight").css('display','none');
			jQuery(this).parent('.tilt_radio').children('.selectTiltOptionCenter').css('display','none');
		}
		jQuery(this).parent(".tilt_radio").children("select.selectTiltOptionLeft").css("display","block");
		jQuery("#windowTiltingSummary").html(jQuery(this).val());
		calculatePriceSize();
    });

	jQuery(".size_checked_select").click(function(e) {
        var ImageUrl=jQuery(this).attr("imageUrl");
		var shade=jQuery(this).attr("shade-size");
		var check=0;
		jQuery(".imageheadrail img").attr("src",ImageUrl);

		if(shade==1)
		{
			jQuery(".pro_detail_size").css("display","none");
			if(jQuery('.lift_input_size .liftOptionClass:checked').children('select').length > 0)
			{
			jQuery('.lift_input_size').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.liftOptionClass").click();
    				}
    				check=1;
    			}
			});
			}
			check=0;
			if(jQuery('.tilt_radio .tiltOptionClass:checked').children('select').length > 0)
			{
			jQuery('.tilt_radio').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.tiltOptionClass").click();
    				}
    				check=1;
    			}
			});
			}
			check=0;
			jQuery(".pro_detail_size").css("display","block");
			jQuery(".SingleBlind").css("display","block");
			jQuery(".CenterBlind").css("display","none");
			jQuery(".RightBlind").css("display","none");
			jQuery("#headrailSummary").html('Single headrail');
		}
		else if(shade==2)
		{
			check=0;
			jQuery('.lift_input_size').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.liftOptionClass").click();
    				}
    				check=1;
    			}
			});
			check=0;
			jQuery('.tilt_radio').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.tiltOptionClass").click();
    				}
    				check=1;
    			}
			});
			jQuery(".pro_detail_size").css("display","block");
			jQuery(".SingleBlind").css("display","block");
			jQuery(".CenterBlind").css("display","none");
			jQuery(".RightBlind").css("display","block");
			jQuery("#headrailSummary").html('2 shades on 1 headrail');
		}
		else if(shade==3)
		{
			check=0;
			jQuery('.lift_input_size').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.liftOptionClass").click();
    				}
    				check=1;
    			}
			});
			check=0;
			jQuery('.tilt_radio').each(function(index, element) {
    			if(jQuery(this).children('select').length > 0)
    			{
    				if(check==0)
    				{
    				jQuery(this).children("input.tiltOptionClass").click();
    				}
    				check=1;
    			}
			});
			jQuery(".pro_detail_size").css("display","block");
			jQuery(".SingleBlind").css("display","block");
			jQuery(".CenterBlind").css("display","block");
			jQuery(".RightBlind").css("display","block");
			jQuery("#headrailSummary").html('3 shades on 1 headrail');
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
    });
jQuery('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = jQuery(this);
var $info = jQuery('#tabInfo');
var $name = jQuery('span', $info);
$name.text($tab.text());
$info.show();
}
});
});
</script>
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
<?php /*
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
			/**
			 * Hook: Woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div> */
?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
<script type="text/javascript">

jQuery(document).ready(function(e) {
	jQuery("#widthproductRightBlind").change(function ()
	{
		var widthp=parseFloat(jQuery("#widthproductRightBlind").val());
		var widthInnerp=parseFloat(jQuery("#widthproductinnerRightBlind").val());

		var heightp=jQuery("#heightproductRightBlind").val();
		var heightInnerp=jQuery("#heightproductinnerRightBlind").val();
		
		var widthInnerHtml=jQuery("#widthproductinnerRightBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerRightBlind option:selected").html();

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);

	});
	jQuery("#widthproductinnerRightBlind").change(function ()
	{
		var widthp=parseFloat(jQuery("#widthproductRightBlind").val());
		var widthInnerp=parseFloat(jQuery("#widthproductinnerRightBlind").val());

		var heightp=jQuery("#heightproductRightBlind").val();
		var heightInnerp=jQuery("#heightproductinnerRightBlind").val();
		
		var widthInnerHtml=jQuery("#widthproductinnerRightBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerRightBlind option:selected").html();

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});

	jQuery("#widthproductinnerCenterBlind").change(function ()
	{
		var widthp=parseFloat(jQuery("#widthproductCenterBlind").val());
		var widthInnerp=parseFloat(jQuery("#widthproductinnerCenterBlind").val());

		var heightp=jQuery("#heightproductCenterBlind").val();
		var heightInnerp=jQuery("#heightproductinnerCenterBlind").val();
		
		var widthInnerHtml=jQuery("#widthproductinnerCenterBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerCenterBlind option:selected").html();

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});


	jQuery("#widthproductCenterBlind").change(function ()
	{
		var widthp=parseFloat(jQuery("#widthproductCenterBlind").val());
		var widthInnerp=parseFloat(jQuery("#widthproductinnerCenterBlind").val());

		var heightp=jQuery("#heightproductCenterBlind").val();
		var heightInnerp=jQuery("#heightproductinnerCenterBlind").val();
		
		var widthInnerHtml=jQuery("#widthproductinnerCenterBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerCenterBlind option:selected").html();

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});

	jQuery("#widthproductSingleBlind").change(function ()
	{

		var widthp=parseFloat(jQuery("#widthproductSingleBlind").val());
		var widthInnerp=parseFloat(jQuery("#widthproductinnerSingleBlind").val());

		var heightp=jQuery("#heightproductSingleBlind").val();
		var heightInnerp=jQuery("#heightproductinnerSingleBlind").val();
		
		var widthInnerHtml=jQuery("#widthproductinnerSingleBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerSingleBlind option:selected").html();

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});
	jQuery("#widthproductinnerSingleBlind").change(function ()
	{
		var widthp=jQuery("#widthproductSingleBlind").val();
		var heightp=jQuery("#heightproductSingleBlind").val();
		var heightInnerp=jQuery("#heightproductinnerSingleBlind").val();
		var widthInnerp=jQuery("#widthproductinnerSingleBlind").val()
		var widthInnerHtml=jQuery("#widthproductinnerSingleBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerSingleBlind option:selected").html();
		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);

		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});

	jQuery("#heightproductinnerSingleBlind").change(function ()
	{
		var widthp=jQuery("#widthproductSingleBlind").val();
		var heightp=jQuery("#heightproductSingleBlind").val();
		var heightInnerp=jQuery("#heightproductinnerSingleBlind").val();
		var widthInnerp=jQuery("#widthproductinnerSingleBlind").val()
		var widthInnerHtml=jQuery("#widthproductinnerSingleBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerSingleBlind option:selected").html();
		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);


		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);


		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
	
	});

    jQuery("#widthproduct").change(function(e) {
        var widthp=jQuery("#widthproduct").val();
		var heightp=jQuery("#heightproduct").val();
		var heightInnerp=jQuery("#heightproductinner").val();
		var widthInnerp=jQuery("#widthproductinner").val()
		var widthInnerHtml=jQuery("#widthproductinner option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinner option:selected").html();
		
		jQuery(".SingleBlind #widthproductSingleBlind option[value='"+widthp+"']").prop('selected',true);
		jQuery(".SingleBlind #widthproductinnerSingleBlind option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductinnerSingleBlind option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);


		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=get_product_price&width="+widthp+"&height="+heightp+"&widthInner="+widthInnerp+"&heightInner="+heightInnerp+"&pricegroup=<?php echo $priceGroup ?>&productId=<?php echo $productCat->get_id(); ?>",
			success: function(data)
			{
				jQuery("#retailPrice").html(data.price);
				jQuery("#offPercentage").html(data.discountpercentage);
				jQuery(".priceProduct").html("$"+data.actualPrice);
				jQuery("#productPrice").html("$"+data.actualPrice);
				jQuery("#calPrice").val(data.actualPrice);
				jQuery("#productPriceTotal").html("$"+parseFloat(data.actualPrice)*parseInt(document.getElementById("quantity").value));
				
			},
			error: function(error)
			{
				
			}
		});
		
    });
	
	
		
	jQuery("#widthproductinner").change(function(e) {
        var widthp=jQuery("#widthproduct").val();
		var heightp=jQuery("#heightproduct").val();
		var heightInnerp=jQuery("#heightproductinner").val();
		var widthInnerp=jQuery("#widthproductinner").val()
		var widthInnerHtml=jQuery("#widthproductinner option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinner option:selected").html();
		jQuery(".SingleBlind #widthproductSingleBlind option[value='"+widthp+"']").prop('selected',true);
		jQuery(".SingleBlind #widthproductinnerSingleBlind option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductinnerSingleBlind option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);


		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=get_product_price&width="+widthp+"&height="+heightp+"&widthInner="+widthInnerp+"&heightInner="+heightInnerp+"&pricegroup=<?php echo $priceGroup ?>&productId=<?php echo $productCat->get_id(); ?>",
			success: function(data)
			{
				jQuery("#retailPrice").html(data.price);
				jQuery("#offPercentage").html(data.discountpercentage);
				jQuery(".priceProduct").html("$"+data.actualPrice);
				jQuery("#productPrice").html("$"+data.actualPrice);
				jQuery("#calPrice").val(data.actualPrice);
				jQuery("#productPriceTotal").html("$"+parseFloat(data.actualPrice)*parseInt(document.getElementById("quantity").value));
				
			},
			error: function(error)
			{
			}
		});
		
    });	
	jQuery("#heightproductinner").change(function(e) {
        var widthp=jQuery("#widthproduct").val();
		var heightp=jQuery("#heightproduct").val();
		var heightInnerp=jQuery("#heightproductinner").val();
		var widthInnerp=jQuery("#widthproductinner").val()
		var widthInnerHtml=jQuery("#widthproductinner option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinner option:selected").html();
		jQuery(".SingleBlind #widthproductSingleBlind option[value='"+widthp+"']").prop('selected',true);
		jQuery(".SingleBlind #widthproductinnerSingleBlind option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductinnerSingleBlind option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);


		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=get_product_price&width="+widthp+"&height="+heightp+"&widthInner="+widthInnerp+"&heightInner="+heightInnerp+"&pricegroup=<?php echo $priceGroup ?>&productId=<?php echo $productCat->get_id(); ?>",
			success: function(data)
			{
				jQuery("#retailPrice").html(data.price);
				jQuery("#offPercentage").html(data.discountpercentage);
				jQuery(".priceProduct").html("$"+data.actualPrice);
				jQuery("#calPrice").val(data.actualPrice);
				jQuery("#productPrice").html("$"+data.actualPrice);
				jQuery("#productPriceTotal").html("$"+parseFloat(data.actualPrice)*parseInt(document.getElementById("quantity").value));
				
			},
			error: function(error)
			{
			}
		});
		
    });

    jQuery("#heightproductSingleBlind").change(function ()
	{
		var widthp=jQuery("#widthproductSingleBlind").val();

		var heightp=jQuery("#heightproductSingleBlind").val();
		var heightInnerp=jQuery("#heightproductinnerSingleBlind").val();
		var widthInnerp=jQuery("#widthproductinnerSingleBlind").val()
		var widthInnerHtml=jQuery("#widthproductinnerSingleBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerSingleBlind option:selected").html();
		
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);
		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);

		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});

	jQuery("#heightproduct").change(function(e) {
        var widthp=jQuery("#widthproduct").val();
		var heightp=jQuery("#heightproduct").val();
		var heightInnerp=jQuery("#heightproductinner").val();
		var widthInnerp=jQuery("#widthproductinner").val()
		var widthInnerHtml=jQuery("#widthproductinner option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinner option:selected").html();
		jQuery(".SingleBlind #widthproductSingleBlind option[value='"+widthp+"']").prop('selected',true);
		jQuery(".SingleBlind #widthproductinnerSingleBlind option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery(".SingleBlind #heightproductinnerSingleBlind option[value='"+heightInnerp+"']").prop('selected',true);

		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);
		
		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		
		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		jQuery.ajax({
			url:"<?php echo admin_url('admin-ajax.php'); ?>",
			type:"POST",
			dataType:"json",
			data:"action=get_product_price&width="+widthp+"&height="+heightp+"&widthInner="+widthInnerp+"&heightInner="+heightInnerp+"&pricegroup=<?php echo $priceGroup ?>&productId=<?php echo $productCat->get_id(); ?>",
			success: function(data)
			{
				jQuery("#retailPrice").html(data.price);
				jQuery("#offPercentage").html(data.discountpercentage);
				jQuery(".priceProduct").html("$"+data.actualPrice);
				jQuery("#calPrice").val(data.actualPrice);
				jQuery("#productPrice").html("$"+data.actualPrice);
				jQuery("#productPriceTotal").html("$"+parseFloat(data.actualPrice)*parseInt(document.getElementById("quantity").value));
				
			},
			error: function(error)
			{
			}
		});
		
    });
    jQuery("#heightproductRightBlind").change(function ()
    {
    	var widthp=jQuery("#heightproductRightBlind").val();

		var heightp=jQuery("#heightproductRightBlind").val();
		var heightInnerp=jQuery("#heightproductinnerRightBlind").val();
		var widthInnerp=jQuery("#widthproductinnerRightBlind").val()
		var widthInnerHtml=jQuery("#widthproductinnerRightBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerRightBlind option:selected").html();
		
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);

		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductCenterBlind option[value='"+heightp+"']").prop('selected',true);

		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
    });
	jQuery("#heightproductCenterBlind").change(function ()
	{
		var widthp=jQuery("#heightproductCenterBlind").val();

		var heightp=jQuery("#heightproductCenterBlind").val();
		var heightInnerp=jQuery("#heightproductinnerCenterBlind").val();
		var widthInnerp=jQuery("#widthproductinnerCenterBlind").val()
		var widthInnerHtml=jQuery("#widthproductinnerCenterBlind option:selected").html();
		var heightInnerHtml=jQuery("#heightproductinnerCenterBlind option:selected").html();
		
		//jQuery("#widthproductinner option[value='"+widthInnerp+"']").prop('selected',true);
		jQuery("#heightproduct option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductinner option[value='"+heightInnerp+"']").prop('selected',true);

		//jQuery("#widthproduct option[value='"+widthp+"']").prop('selected',true);

		jQuery("#heightproductSingleBlind option[value='"+heightp+"']").prop('selected',true);
		jQuery("#heightproductRightBlind option[value='"+heightp+"']").prop('selected',true);

		jQuery("#windowWidthSummary").html(widthp);
		jQuery("#windowLengthSummary").html(heightp);
		if(widthInnerHtml=='.')
		{
			widthInnerHtml='0/0';
		}
		if(heightInnerHtml=='.')
		{
			heightInnerHtml='0/0';
		}
		var term_id=jQuery('.color_pro_box.active').attr("term-id");
		getMaxWidthMaxHeight(term_id);

		jQuery("#windowWidthInnerSummary").html(widthInnerHtml);
		jQuery("#windowHeightInnerSummary").html(heightInnerHtml);
		
	});
});
function functionQuantityChange()
	{
		
		jQuery(document).ready(function(e) {
           if(parseInt(document.getElementById("quantity").value) > 0)
			{
				var replaceString=jQuery("#productPrice").html();
				replaceString=replaceString.replace('$','');
        		jQuery("#productPriceTotal").html("$"+parseFloat(replaceString)*parseInt(document.getElementById("quantity").value));
			}  
        });
	}
</script>
<style>
.wrapper {
    margin-left: auto;
    margin-right: auto;
    max-width: 1150px;
    padding: 0 0px;
    width: 100%;
}
</style>