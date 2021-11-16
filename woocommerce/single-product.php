<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );


$terms = get_the_terms( $post->ID, 'product_cat' );
if(!empty($terms)){
	foreach ($terms as $term) {
	    $product_cat_id .= $term->term_id.',';
	}	
}
 

$product_cat_id = substr($product_cat_id, 0, -1);
$pro_ids = explode(',', $product_cat_id);

$our_pro_cate = array('239','240','225');
$a=[];
$other_template = false;
foreach ($pro_ids as $key => $value) {
	if(in_array($value, $our_pro_cate)){
		$other_template = true;
	}
}
/*if(!empty($a)){
	$other_template = true;
}else{
	$other_template = false;
}
print_r($a);*/

?>

<div class="inner_banner full_sec">
	<div class="container">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	
		<?php custom_breadcrumbs(); ?>
	</div>
</div>
<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
<div class="middle_sec entry-content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="middle_left full_sec">
					<?php
					/*print_r($pro_ids);
					print_r($our_pro_cate);
					die;*/
					if ($other_template){
								// echo "string";die;
								echo '<h2 class="product_title entry-title">'.get_the_title($post->ID).'</h2>';
							}else{
						// echo "string123";die;
						while ( have_posts() ) : the_post();

							

							wc_get_template_part( 'content', 'single-product' );
							
						endwhile; // end of the loop.
}
					
					?>	
				</div>
			</div>	
			<!-- <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="middle_right full_sec">
					<div class="middle_services">
						<?php //get_sidebar(); ?>
					</div>
				</div>
			</div> -->
		</div>
	</div>		
</div>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
