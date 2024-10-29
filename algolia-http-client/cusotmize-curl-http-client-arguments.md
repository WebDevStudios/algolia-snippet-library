This snippet can be used to add custom cURL arguments to be used with the Algolia PHP Client and the CurlHttpClient instance.

Essentially anything that you'd specify via `curl_setopt`.

```php
<?php
function wds_algolia_custom_curl_options( $options ) {

	// Customize our referer domain.
	$options['CURLOPT_REFERER'] = 'https://my.website.com';
	// Lets let our connections wait 5 seconds.
	$options['CURLOPT_TIMEOUT'] = 5 // Specify as an integer.

	return $options;
}
add_filter( 'algolia_http_client_options', 'wds_algolia_custom_curl_options' );
```
