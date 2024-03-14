These snippets can be used to use WordPress native search in conjunction with indexes that have a different sorting configuration.

For example, if you have replicas that are ordered by price highest to lowest, lowest to highest or similar with other attributes

## Register replicas via code.

First we need to register the replicas and push the settings to Algolia.

For our example, we are going create a couple of replicas to sort by price, both ascending and descending order.

> We are using a dynamic filter named `algolia_' . $this->get_id() . '_index_replica` with `$this->get_id()` returning `searcable_posts`.
> This will prevent replicas from being created for any time any index has their "Push Settings" button from being submitted. If you want replicas created regardless of index, you can use the `algolia_index_replicas` filter.

```php
<?php
function wds_algolia_register_replicas( $replicas ) {
	$replicas[] = new Algolia_Index_Replica( 'price', 'asc' );
	$replicas[] = new Algolia_Index_Replica( 'price', 'desc' );
	return $replicas;
}
add_filter( 'algolia_searchable_posts_index_replicas', 'wds_algolia_register_replicas' );
```

Once you have saved this filter, visit the "Search Page" settings page and use the "Push Settings" button at the top. This will create the two replicas in your searchable posts index.

> If you have an existing replica for the chosen attribute and order, the settings will be overwritten by the push.

## Change the order and orderby in native search request

For this portion of the example, the `$_GET` parameters are just examples. Each of these filters are applied inside a callback that is running on the `pre_get_posts` filter.

```php
function wds_algolia_change_order_by( $orderby_value ) {
	if ( ! empty( $_GET['orderby'] ) && $_GET['orderby'] === 'price' ) {
		return 'price';
	}
	return $orderby_value;
}
add_filter( 'algolia_search_order_by', 'wds_algolia_change_order_by' );

function wds_algolia_change_order( $order_value ) {
	if ( ! empty( $_GET['order'] ) ) {
		if ( $_GET['order'] === 'desc' ) {
			return 'desc';
		} else if ( $_GET['order'] === 'asc' ) {
			return 'asc';
		}
	}
	return $order_value;
}
add_filter( 'algolia_search_order', 'wds_algolia_change_order' );
```

The `$_GET` parameter values should match up with what was used with the `wds_algolia_register_replicas()` function.
