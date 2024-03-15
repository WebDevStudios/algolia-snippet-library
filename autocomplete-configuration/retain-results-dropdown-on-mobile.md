This snippet can be used to set the autocomplete `debug` flag to true for mobile devices, while keeping it set to false for others.

You would want to consider this snippet if you're having trouble with retaining the results display when tapping 'Done' and hiding the mobile keyboard.

```php
function wds_algolia_autocomplete_stay_open_mobile( $config ) {
	// set debug mode to true if mobile, otherwise fall back to original value, which may also be true, but could be false.
	$config['debug'] = wp_is_mobile() ? true : $config['debug'];

	return $config;
}
add_filter( 'algolia_config', 'wds_algolia_autocomplete_stay_open_mobile' );
```
