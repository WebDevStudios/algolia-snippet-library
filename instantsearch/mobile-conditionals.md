This snippet can be used to add some extra javascript variables to the global scope of the page, that you can then use within the `instantsearch.php` template file to customize the javascript.

For this example we are checking if WordPress considers us in a mobile state. We can then use that boolean result to change InstantSearch configuration. For example, reducing the hitsPerPage value conditionally.

```php
<?php
function wds_algolia_example_scripts() {
	$data['is_mobile'] = wp_is_mobile();
	wp_add_inline_script(
		'algolia-instantsearch',
		'const extraConfig = ' . wp_json_encode( $data ) . ';'
	);
}
add_action( 'wp_enqueue_scripts', 'wds_algolia_example_scripts' );
```

```js
instantsearch.widgets.configure({
	hitsPerPage: extraConfig.is_mobile ? 3 : 9, // Make use of ternary operator to determine the value.
});
```
