This snippet can be used to construct a property for a post object, constructed from Advanced Custom Field flexible content data.

```php
<?php

// Function to construct the final result into a `flexible_content` property.
function wds_algolia_flexible_content_indexing( array $attributes, WP_Post $post ) {
	// Limit to post type if needed.
	if ( 'page' === $post->post_type ) {
		$blocks                         = get_field( 'flexible_content', $post->ID );
		$attributes['flexible_content'] = format_flexible_content( $blocks );
	}

	return $attributes;
}
add_filter( 'algolia_post_shared_attributes', 'wds_algolia_flexible_content_indexing', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'wds_algolia_flexible_content_indexing', 10, 2 );

function format_flexible_content( $blocks ) {
	// Variable to hold the final result, will be imploded later.
	$blockContent = [];

	// Specify which subfield IDs to fetch and index.
	$props = [
		'text',
		'content',
		'heading',
		'name',
		'title',
		'quote',
		'main_content',
		'accordion_elements',
		'indhold'
	];

	foreach ( $blocks as $block ) {
		$data = '';

		foreach ( $block as $key => $value ) {
			if ( in_array( $key, $props ) ) {
				if ( isset( $block[ $key ] ) && ! empty( $block[ $key ] )) {
					if ( is_string( $block[ $key ] ) ) {
						$data .= strip_tags( $block[ $key ] );
					} else if ( is_array( $block[ $key ] ) ) {
						$data .= wds_algolia_recursively_get_acf_text( $block[ $key ] , $props);
					}
				}
			}
		}

		$blockContent[] = $data;
	}

	return implode("\n", $blockContent);
}

// Function to strip tags out of for each found field. This will handle deeply nested arrays.
function wds_algolia_recursively_get_acf_text( $array , $props = []) {
	$text = '';

	foreach ( $array as $key => $value ) {
		if ( in_array( $key, $props ) ) {
			if ( is_array( $value ) ) {
				$text .= wds_algolia_recursively_get_acf_text( $value );
			} else {
				// Only add text if $value is a string to ensure it's text content.
				$text .= strip_tags( $value );
			}
		}
	}

	return $text;
}
```
