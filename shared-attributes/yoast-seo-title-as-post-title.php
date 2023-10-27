<?php
/*
 * This snippet can be used to fetch the Yoast SEO title and if set, override the default `post_title` value.
 */

function wds_algolia_yoast_seo_as_algolia_title( $shared_attributes, $post ) {
	$maybe_seo_title = YoastSEO()->meta->for_post( $post->ID );

	if ( false !== $maybe_seo_title ) {
		$shared_attributes['post_title'] = $maybe_seo_title->title;
	}

	return $shared_attributes;
}
// For Search page/InstantSearch results.
add_filter( 'algolia_searchable_post_shared_attributes', 'wds_algolia_yoast_seo_as_algolia_title', 10, 2 );
//For Autocomplete results.
add_filter( 'algolia_post_shared_attributes', 'wds_algolia_yoast_seo_as_algolia_title', 10, 2 );
