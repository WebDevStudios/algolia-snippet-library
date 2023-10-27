This snippet can be used to check if a product has been marked with visibility of "shop only" or "hidden", and if true, prevent from being indexed in Algolia.

```php
<?php
function wds_algolia_exclude_catalog_hidden_products( $should_index, WP_Post $post ) {

	if ( false === $should_index ) {
		return false;
	}

	$product = wc_get_product( $post->ID );
	if ( ! $product ) {
		return $should_index;
	}
	$product_visibility = $product->get_catalog_visibility();

	if ( in_array( $product_visibility, [ 'catalog', 'hidden' ] ) ) {
		$should_index = false;
	}

	return $should_index;
}
// For Search page/InstantSearch results.
add_filter( 'algolia_should_index_searchable_post', 'wds_algolia_exclude_catalog_hidden_products', 10, 2 );
//For Autocomplete results.
add_filter( 'algolia_should_index_post', 'wds_algolia_exclude_catalog_hidden_products', 10, 2 );
```
