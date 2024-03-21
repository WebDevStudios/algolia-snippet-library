This snippet can be used to add WooCommerce image sizes to the available image data that's indexed.

```php
<?php
function wds_algolia_woo_image_sizes( array $sizes ) {
	array_push( $sizes, 'woocommerce_thumbnail', 'woocommerce_single', 'woocommerce_gallery_thumbnail' );

	return $sizes;
}
add_filter( 'algolia_post_images_sizes', 'wds_algolia_woo_image_sizes' );
```
