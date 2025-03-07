These snippets can be used to define available PHP constants from WP Search with Algolia in various ways, by environment or by developer.

The constant values can be whatever you want to differentiate between the environments.

For developers working with Algolia via their local environment, they can also define their own.

Constants that we are demo'ing:

* ALGOLIA_APPLICATION_ID
* ALGOLIA_SEARCH_API_KEY
* ALGOLIA_API_KEY
* ALGOLIA_INDEX_NAME_PREFIX

We will show how to configure different applications and API KEYs and prefix values by environment.

For example you could have an application dedicated to your production website and some for for non-production.

### General WordPress

This should be saved in a custom plugin or your active theme's `functions.php` file.

```php
switch ( wp_get_environment_type() ) {
	case 'production':
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'prod_' );
		break;
	case 'staging':
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER STAGING VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER STAGING VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER STAGING VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'staging_' );
		break;
	case 'local':
	case 'development':
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER DEV/LOCAL VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER DEV/LOCAL VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER DEV/LOCAL VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'dev_' );
		break;
}
```

### WP VIP

If you are on the WP VIP platform, you can do similar using VIP's environment variables, as demo'd below. This would go in your `vip-config/vip-config.php` file.

```php
if ( defined( 'VIP_GO_APP_ENVIRONMENT' ) ) {
	if ( 'production' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER PROD VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'prod_' );
	} else if ( 'preprod' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER PREPROD VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER PREPROD VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER PREPROD VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'pre_' );
	} else if ( 'develop' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_APPLICATION_ID', 'ENTER DEVELOP VALUE' );
		define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER DEVELOP VALUE' );
		define( 'ALGOLIA_API_KEY', 'ENTER DEVELOP VALUE' );
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'dev_' );
	}
}
```

### WP-CONFIG

If you'd prefer to define in your wp-config file, then some standard PHP can be used to differentiate.

Fill in the appropriate environment host values for the `str_contains()` checks.

```php
// URL version.
$url = $_SERVER['HTTP_HOST'];
if ( str_contains( $url, 'dev.mywebsite' ) ) {
	define( 'ALGOLIA_APPLICATION_ID', 'ENTER DEV/LOCAL VALUE' );
	define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER DEV/LOCAL VALUE' );
	define( 'ALGOLIA_API_KEY', 'ENTER DEV/LOCAL VALUE' );
	define( 'ALGOLIA_INDEX_NAME_PREFIX', 'dev_' );
} else if (	str_contains( $url, 'staging.mywebsite' ) ){
	define( 'ALGOLIA_APPLICATION_ID', 'ENTER STAGING VALUE' );
	define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER STAGING VALUE' );
	define( 'ALGOLIA_API_KEY', 'ENTER STAGING VALUE' );
	define( 'ALGOLIA_INDEX_NAME_PREFIX', 'staging_' );
} else {
	define( 'ALGOLIA_APPLICATION_ID', 'ENTER PROD VALUE' );
	define( 'ALGOLIA_SEARCH_API_KEY', 'ENTER PROD VALUE' );
	define( 'ALGOLIA_API_KEY', 'ENTER PROD VALUE' );
	define( 'ALGOLIA_INDEX_NAME_PREFIX', 'prod_' );
}
```
