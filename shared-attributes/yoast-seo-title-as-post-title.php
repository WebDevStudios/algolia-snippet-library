<?php
function pluginize_yoast_seo_as_algolia_title( $shared_attributes, $post ) {
	$maybe_seo_title = YoastSEO()->meta->for_post( $post->ID );

	if ( false !== $maybe_seo_title ) {
		$shared_attributes['post_title'] = $maybe_seo_title->title;
	}

	return $shared_attributes;
}

add_filter( 'algolia_post_shared_attributes', 'pluginize_yoast_seo_as_algolia_title', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'pluginize_yoast_seo_as_algolia_title', 10, 2 );
