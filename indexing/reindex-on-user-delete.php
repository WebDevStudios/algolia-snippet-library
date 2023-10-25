<?php

function algolia_support_reindex_on_user_delete( $user_id ) {
	$searchable_post_types = get_post_types(
		[
			'exclude_from_search' => false,
		],
	);
	$indices[]             = new Algolia_Searchable_Posts_Index( $searchable_post_types );

	$algolia_plugin     = Algolia_Plugin_Factory::create();
	$synced_indices_ids = $algolia_plugin->get_settings()->get_synced_indices_ids();
	$index_name_prefix  = $algolia_plugin->get_settings()->get_index_name_prefix();
	$client             = $algolia_plugin->get_api()->get_client();

	// Only include Autocomplete index if enabled.
	// Here you can include autocomplete based indexes. Format is going to be `posts_$POST_TYPE_SLUG` for the in_array
	// check, and then for the `Algolia_Posts_index()` call, just passs in the post type slug.

	//if ( in_array( 'posts_product', $synced_indices_ids, true ) ) {
	//	$indices[] = new Algolia_Posts_Index( 'product' );
	//}

	foreach ( $indices as $index ) {
		$index->set_name_prefix( $index_name_prefix );
		$index->set_client( $client );

		if ( in_array( $index->get_id(), $synced_indices_ids, true ) ) {
			$index->set_enabled( true );
		}

		$index->re_index( 1 );
	}
}
add_action( 'deleted_user', 'algolia_support_reindex_on_user_delete', 10, 1 );
