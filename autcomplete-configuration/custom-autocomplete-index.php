<?php
/*
 * This snippet can be used to add an index to the autocomplete configuration, without it being available
 * in the Autocomplete Settings page.
 *
 * Indexes for the configuration's array should match up with the columns on the settings page.
 *
 * Note: `tmpl_suggestion` is for Autocomplete version 0.38.x and earlier.
 */

function wds_algolia_add_custom_index( $config ) {
	$config[] = [
		'enabled'         => true, // Same as the checkbox
		'index_id'        => 'Index ID', // Matches the "Index name:" line below the `admin_name`. Should be unique
		'index_name'      => 'Index name', // Value you see in the Algolia.com dashboard dropdown when switching indexes including configured prefix.
		'max_suggestions' => 5, // Maximum amount of suggestions this index should offer.
		'position'        => 10, // Position in the stack. Similar to the drag and drop order from Autocomplete setting page.
		'tmpl_suggestion' => 'autocomplete-custom-suggestion', // ID attribute to look for in template files. Example: `id="tmpl-autocomplete-custom-suggestion">` minus `tmpl-`
		'admin_name'      => 'Index Name', // Matches the first line from the Index column.
		'label'           => 'Some Label', // Same as the label column. Used for headings in Autocomplete dropdown. Can be left blank.
	];

	return $config;
}
add_filter( 'algolia_autocomplete_config', 'wds_algolia_add_custom_index' );
