> As of WP Search with Algolia 2.10.0, UI settings for debouncing have been added, negating need to use this documentation.

This snippet shows how to customize the `autocomplete.php` template file to add in a debounce parameter.

> Template code shown is accurate as of autocomplete.php template version 2.5.3, copied from `WP Search with Algolia` version 2.8.2. It is intended for Autocomplete version 0.38.x or earlier, which is the out of box version for WP Search with Algolia 2.8.2.

> [Direct link to see highlighted section of the full template file](https://github.com/WebDevStudios/wp-search-with-algolia/blob/2.8.2/templates/autocomplete.php#L108-L117)

> [Documentation on `autocomplete.php` template customization.](https://github.com/WebDevStudios/wp-search-with-algolia/wiki/Customize-the-Autocomplete-dropdown)

You will want to add the debounce property inside the `algolia.autocomplete.sources.forEach()` foreach loop and individual `sources.push()` method call. This will set the debounce time to each of the configured Autocomplete indexes that you have in your WP Admin UI and the Autocomplete settings page.

```js
source: algoliaHitsSource( client.initIndex( config[ 'index_name' ] ), {
	hitsPerPage: config[ 'max_suggestions' ],
	attributesToSnippet: [
		'content:10'
	],
	highlightPreTag: '__ais-highlight__',
	highlightPostTag: '__/ais-highlight__'
} ),
debounce: 1000 // debounce time in milliseconds. 1000 = 1 second. 3000 = 3 seconds, etc.
templates: { ... }
```

> Algolia recommends keeping the debounce as low as tolerable, to help with providing as instant and real time results as possible.

[More on the general concept of debouncing](https://www.algolia.com/doc/ui-libraries/autocomplete/guides/debouncing-sources/)

[Selecting a debounce delay for your audience](https://www.algolia.com/doc/ui-libraries/autocomplete/guides/debouncing-sources/#select-a-debounce-delay)
