This snippet can be used to define the index name prefix based on current environment variable. This should be saved in a custom plugin or your active theme's `functions.php` file.

The prefix values can be whatever you want to differentiate between the environments.

```php
switch ( wp_get_environment_type() ) {
	case 'production':
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'prod_' );
		break;
	case 'staging':
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'staging_' );
		break;
	case 'local':
	case 'development':
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'dev_' );
		break;
}
```

## WP VIP

If you are on the WP VIP platform, you can do similar using VIP's environment variables, as demo'd below. This would go in your `vip-config/vip-config.php` file.

```php
if ( defined( 'VIP_GO_APP_ENVIRONMENT' ) ) {
	if ( 'production' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'prod_' );
	} else if ( 'preprod' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'pre_' );
	} else if ( 'develop' === VIP_GO_APP_ENVIRONMENT ) {
		define( 'ALGOLIA_INDEX_NAME_PREFIX', 'dev_' );
	}
}
```
