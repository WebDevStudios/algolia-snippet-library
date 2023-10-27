<?php
/*
 * The code in this file is meant to be part of the instantsearch.php or autocomplete.php template files,
 * most specifically in the javascript sections, to be used with template rendering.
 *
 * This specific example creates a "(X - Y of Z)" format for stat results.
 *
 * Note: This example snippet makes use of Template Literals https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals
 */

/*
instantsearch.widgets.stats({
	container: '#algolia-stats',
	templates: {
		text( data, { html } ) {
			let stats, range, page, hitsPerPage, total, end, start = '';

			page        = data.page + 1;
			hitsPerPage = data.hitsPerPage;
			total       = data.nbHits;
			end         = hitsPerPage * page;
			start       = end - hitsPerPage + 1;

			if (hitsPerPage > total) {
				range = `${total}`;
			} else if (end > total) {
				range = `${start} - ${total}`;
			} else {
				range = `${start} - ${end}`;
			}

			if (data.hasManyResults) {
				stats = `${range} of ${data.nbHits} results`;
			} else if (data.hasOneResult) {
				stats = `1 result`;
			} else {
				stats = `no results`;
			}

			return html`<span>(${stats})</span>`;
		}
	}
} ),
*/
