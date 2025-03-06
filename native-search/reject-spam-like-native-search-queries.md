These snippets can be used to use WordPress native search in conjunction with rejecting the query and send to a 404 error.

```php
<?php

function wds_algolia_reject_spam_searches( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( ! $query->is_search() ) {
		return;
	}

	// Check for the existance of emoji characters in the search query.
	$s = rawurldecode( $query->query_vars['s'] );
	if ( wds_algolia_search_has_emoji( $s ) ) {
		$query->set_404();
		http_response_code( 404 );
	}

	$patterns = [
		'/[：（）【】［］]+/u',
		'/(TALK|QQ)\:/iu',
	];

	foreach ( $patterns as $pattern ) {
		$outcome = preg_match( $pattern, $s, $matches );
		if ( $outcome && $matches !== [] ) {
			$query->set_404();
			http_response_code( 404 );
		}
	}

	// Return a 404 error for non-latin characters in search.
	$latin_patterns = [
		'/^[\p{Latin}\p{Common}]+$/u',
	];
	foreach( $latin_patterns as $pattern ) {
		$outcome = preg_match( $pattern, $s, $matches );
		if ( 1 !== $outcome ) {
			$query->set_404();
			http_response_code( 404 );
		}
	}

	if ( wds_algolia_search_is_url( $s ) ) {
		$query->set_404();
		http_response_code( 404 );
	}

	if ( wds_algolia_search_is_email( $s ) ) {
		$query->set_404();
		http_response_code( 404 );
	}

	if ( wds_algolia_search_starts_with_dash( $s ) ) {
		$query->set_404();
		http_response_code( 404 );
	}

	if ( wds_algolia_search_contains_odd_characters( $s ) ) {
		$query->set_404();
		http_response_code( 404 );
	}
}
add_action( 'pre_get_posts', 'wds_algolia_reject_spam_searches' );

// Check if a string value has any emoji characters in it.
function wds_algolia_search_has_emoji( $text ) {
	$emojis_regex = '/([^-\p{L}\x00-\x7F]+)/u';
	preg_match( $emojis_regex, $text, $matches );

	return ! empty( $matches );
}

// Check if the exact string evaluates as a URL.
function wds_algolia_search_is_url( $string ) {
	return filter_var( $string, FILTER_VALIDATE_URL ) !== false;
}

// Check if the exact string evaluates as an email address.
function wds_algolia_search_is_email( $string ) {
	// is_email returns the email if validates, so we want to return true
	// in the event that false is not the result.
	return false !== is_email( $string );
}

// Check if the string start with `-`. Examples from Algolia analytics: `-rzg` or `----azc`
function wds_algolia_search_starts_with_dash( $string ) {
	return str_starts_with( $string, '-' );
}

// Check if string contains any "odd" characters that do not relate to probable search phrases or queries.
function wds_algolia_search_contains_odd_characters( $string ) {
	$contains = false;
	$chars = [';', ':', '.', '<', '>', '=', '/', "'", ',', '{', '}', ];
	foreach( $chars as $char ) {
		if ( str_contains( $string, $char ) ) {
			$contains = true;
			break;
		}
	}
	return $contains;
}
