<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
<style>
#add_payment_method table.cart img, .woocommerce-cart table.cart img, .woocommerce-checkout table.cart img
{
	width:auto;
}
</style>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove" style="width:36px;">&nbsp;</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name" style="width:550px;"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				
				$roomType=$cart_item['roomType'];
				$color=$cart_item['color'];
				$mount=$cart_item['mount'];
				$size=$cart_item['size'];
				$width=$cart_item['width'];
				$height=$cart_item['height'];
				$widthInner=$cart_item['widthInner'];
				$heightInner=$cart_item['heightInner'];
				$price=$cart_item['price'];
				$liftOption=$cart_item['liftOption'];
				$tiltOption=$cart_item['tiltOption'];
				$decorative=$cart_item['decorative'];
				$routeless=$cart_item['routeless'];
				$valanceOption=$cart_item['valanceOption'];
				$nickname=$cart_item['nickname'];
				
				$shade=(isset($cart_item['shade']))?$cart_item['shade']:'';
				$rightWidth=(isset($cart_item['rightWidth']))?$cart_item['rightWidth']:'';
				$rightHeight=(isset($cart_item['rightHeight']))?$cart_item['rightHeight']:'';
				$centerWidth=(isset($cart_item['centerWidth']))?$cart_item['centerWidth']:'';
				$centerHeight=(isset($cart_item['centerHeight']))?$cart_item['centerHeight']:'';
				
				$room=get_term( $roomType, 'room_type' );
				$colorObject=get_term($color,'fabric_styles');
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								// @codingStandardsIgnoreLine
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>

						<td class="product-thumbnail"><?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail;
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
						}
						?></td>

						<td  class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>"><?php
						if ( ! $product_permalink ) {
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
						} else {
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
						}

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item );

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
						}
						?><br /><br /><label>Details:</label><br />
                        <label>Roomtype : </label><span><?php echo $room->name; ?></span><br />
                        <label>COLOR : </label><span><?php echo $colorObject->name; ?></span><br />
                        <label>MOUNT : </label><span><?php $mountOject=get_term($mount,'mount_option'); echo $mountOject->name;?> </span><br />
                        <label>SIZE : </label><span><?php $sizeObject=get_term($size,'size'); echo $sizeObject->name;?> </span><br />
                        <label>LIFT OPTION : </label><span><?php $mountOject=get_term($liftOption,'lift_option'); echo $mountOject->name;?> </span><br />
                        <label>TILT OPTION : </label><span><?php $mountOject=get_term($tiltOption,'tilt_option'); echo $mountOject->name;?> </span><br />
                        <label>DECORATIVE ACCENT : </label><span><?php $mountOject=get_term($decorative,'decorative_accent'); echo $mountOject->name;?> </span><br />
                        <label>ROUTELESS OPTION : </label><span><?php $mountOject=get_term($routeless,'routeless'); echo $mountOject->name;?> </span><br />
                        <label>VALANCE OPTION : </label><span><?php $mountOject=get_term($valanceOption,'valance_option'); echo $mountOject->name;?> </span>
                        <?php if($rightWidth!=0 && $rightWidth!='')
						{?>
                        <label>Right Blind Width : </label><span><?php echo $rightWidth; ?></span>	
                        <label>Right Blind Height : </label><span><?php echo $rightHeight; ?></span>								
						<?php }
						if($centerWidth!=0 && $centerWidth!='')
						{?>
						<label>Center Blind Width : </label><span><?php echo $centerWidth; ?></span>	
                        <label>Center Blind Height : </label><span><?php echo $centerHeight; ?></span>
						<?php }
						?>
                        </td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>"><?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'    => "cart[{$cart_item_key}][qty]",
								'input_value'   => $cart_item['quantity'],
								'max_value'     => $_product->get_max_purchase_quantity(),
								'min_value'     => '0',
								'product_name'  => $_product->get_name(),
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?></td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
