<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
//Um container pra cada 3.
if ( 0 == $woocommerce_loop['loop'] -3 )
        echo '<div class="sobre grid col-lg-3 col-md-4 col-sm-6product">', bloginfo( 'description' ), '<a href=""><div class="mais-sobre">mais informações</div></a></div>';
//<div class="sobre grid col-lg-3 product"> 
// Extra post classes
$classes[] = 'grid col-lg-3 col-md-4 col-sm-6';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
		$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
		$classes[] = 'last';
	//Pegar classe do campo extra
$tamanho = get_post_meta($post->ID, 'tamanho');
?>
<div <?php post_class( $classes ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<figure class="effect-goliath">
		<a href="<?php the_permalink(); ?>">

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

		</a>
		<figcaption>
			<h2><?php the_title(); ?><span> <?php $size = sizeof( get_the_terms( $post->ID, 'product_cat' ) ); echo $product->get_categories( _n( '', 'Categories:', $size, 'woocommerce' ));
    ?></span></h2>
			<p><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></p>
		</figcaption>	
	</figure>	

</div>