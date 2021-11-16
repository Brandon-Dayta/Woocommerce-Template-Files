<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
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
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<tr class="shipping">
	<th><?php echo wp_kses_post( $package_name ); ?></th>
	<td data-title="<?php echo esc_attr( $package_name ); ?>">



		<?php if ( 1 < count( $available_methods ) ) : ?>

			<?php
			$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
			$chosen_shipping = $chosen_methods[0];
			if( !empty($chosen_shipping)){
				$checked = 'checked';
			}else{
				$checked = '';
			}
			?>
			<div class="prepaid_shipping">
				<input type="checkbox" id="s_prepaid_shipping" <?php echo $checked;?> name="s_prepaid_shipping"><label for="s_prepaid_shipping">Prepaid shipping</label>
			</div>
			<ul id="shipping_method">
				<?php foreach ( $available_methods as $method ) : ?>
					<li>
						<?php
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />
								<label for="shipping_method_%1$d_%2$s">%5$s</label>',
								$index, sanitize_title( $method->id ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ), wc_cart_totals_shipping_method_label( $method ) );

							do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="shipping_account">
				<label>Please indicate your shipping account number <span class="shipping_span">*</span> <span class="optional" style="display: none;">(optional, information not required)</span></label>
				<input type="text" class="s_shipping_account" name="s_shipping_account" value="">
				<label>Please indicate your shipping method <span class="shipping_span">*</span> <span class="optional" style="display: none;">(optional, information not required)</span></label>
				<input type="text" class="s_shipping_method" name="s_shipping_method" value="">
				<p>Customer is responsible for duty tax, value added tax and shipping cost.</p>
			</div>

		<?php elseif ( 1 === count( $available_methods ) ) :  ?>
			<?php
				$method = current( $available_methods );
				printf( '%3$s <input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d" value="%2$s" class="shipping_method" />', $index, esc_attr( $method->id ), wc_cart_totals_shipping_method_label( $method ) );
				do_action( 'woocommerce_after_shipping_rate', $method, $index );
			?>
			<div class="shipping_account">
				<input type="hidden" class="ss_prepaid_shipping" name="ss_prepaid_shipping" value="1">
				<label>Please indicate your shipping account number <span class="shipping_span">*</span></label>
				<input type="text" required class="s_shipping_account" name="s_shipping_account" value="">
				<label>Please indicate your shipping method <span class="shipping_span">*</span></label>
				<input type="text" required class="s_shipping_method" name="s_shipping_method" value="">
				<p>Customer is responsible for duty tax, value added tax and shipping cost.</p>
			</div>
		<?php elseif ( WC()->customer->has_calculated_shipping() ) : ?>
			<?php echo apply_filters( is_cart() ? 'woocommerce_cart_no_shipping_available_html' : 'woocommerce_no_shipping_available_html', wpautop( __( 'There are no shipping methods available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) ); ?>
		<?php elseif ( ! is_cart() ) : ?>
			<?php echo wpautop( __( 'Enter your full address to see shipping costs.', 'woocommerce' ) ); ?>
		<?php endif; ?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( ! empty( $show_shipping_calculator ) ) : ?>
			<?php woocommerce_shipping_calculator(); ?>
		<?php endif; ?>
	</td>
</tr>
