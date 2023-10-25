<?php
// also make use of this, so that we don't get issues around exception classes
use WebDevStudios\WPSWA\Algolia\AlgoliaSearch\Exceptions\AlgoliaException;

/*
 * The comment_post hook may be a better spot to trigger reindex on, as that one may be getting used to add comment meta to, which would be a logical reason someone wants to update an algolia instance.

Note that comment_post doesn't pass the comment object, just the comment's ID.
 */
function algolia_index_on_comment( $id, $comment ) {
	$searchable_post_types = get_post_types( [ 'exclude_from_search' => false, ] );
	$indices[]             = new \Algolia_Searchable_Posts_Index( $searchable_post_types );

	$algolia_plugin     = \Algolia_Plugin_Factory::create();
	$synced_indices_ids = $algolia_plugin->get_settings()->get_synced_indices_ids();
	$index_name_prefix  = $algolia_plugin->get_settings()->get_index_name_prefix();
	$client             = $algolia_plugin->get_api()->get_client();

	$commented_post = get_post( $comment->comment_post_ID );

	// Only include Autocomplete index if enabled.
	if ( in_array( 'posts_' . $commented_post->post_type, $synced_indices_ids, true ) ) {
		$indices[] = new \Algolia_Posts_Index( $commented_post->post_type );
	}

	foreach ( $indices as $index ) {
		$index->set_name_prefix( $index_name_prefix );
		$index->set_client( $client );

		if ( in_array( $index->get_id(), $synced_indices_ids, true ) ) {
			$index->set_enabled( true );
		}

		if ( ! $index->supports( $commented_post ) ) {
			continue;
		}

		try {
			$index->sync( $commented_post );
		} catch ( AlgoliaException $exception ) {
			error_log( $exception->getMessage() ); // phpcs:ignore -- Legacy.
		}
	}
}
add_action( 'wp_insert_comment', 'algolia_index_on_comment', 10, 2 );
