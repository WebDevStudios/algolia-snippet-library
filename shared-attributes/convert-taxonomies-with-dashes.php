<?php
/*
 * This snippet can be used to convert dashes in term slugs to underscores before index, and without having to rename
 * the terms in WordPress.
 *
 * The reason why you would want to consider this is because when it comes to the Javascript templating, the dashes
 * can get interpreted as math operations instead of a single object property.
 */
function wds_algolia_convert_term_dashes_to_underscores( $shared_attributes, $post ) {

	// Iterate over our taxonomies array
	if ( is_array( $shared_attributes['taxonomies'] ) ) {
		foreach( $shared_attributes['taxonomies'] as $taxonomy => $terms ) {
			// Check if we have a dash to handle.
			if ( false !== strpos( $taxonomy, '-' ) ) {
				// Convert our dashes to underscores, and re-insert the converted taxonomy and terms into the attributes.
				$converted                                     = str_replace( '-', '_', $taxonomy );
				$shared_attributes['taxonomies'][ $converted ] = $terms;

				// Unset the original version with the dashes.
				unset( $shared_attributes['taxonomies'][ $taxonomy ] );
			}
		}
	}

	// Out of box, WP Search with Algolia has a separate property for hierarchical taxonomies. Repeat the process.
	if ( is_array( $shared_attributes['taxonomies_hierarchical'] ) ) {
		foreach ( $shared_attributes['taxonomies_hierarchical'] as $taxonomy => $terms ) {
			// Check if we have a dash to handle.
			if ( false !== strpos( $taxonomy, '-' ) ) {
				// Convert our dashes to underscores, and re-insert the converted taxonomy and terms into the attributes.
				$converted                                     = str_replace( '-', '_', $taxonomy );
				$shared_attributes['taxonomies_hierarchical'][ $converted ] = $terms;

				// Unset the original version with the dashes.
				unset( $shared_attributes['taxonomies_hierarchical'][ $taxonomy ] );
			}
		}
	}

	return $shared_attributes;
}
add_filter( 'algolia_searchable_post_shared_attributes', 'wds_algolia_convert_term_dashes_to_underscores', 10, 2 );
