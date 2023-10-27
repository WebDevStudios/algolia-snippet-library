The code in this file is meant to be part of the instantsearch.php or autocomplete.php template files, most specifically in the javascript sections, to be used with template rendering.

```js
// Change to your currency and formatting, as applicable
const dollars = new Intl.NumberFormat(`en-US`, {
	currency: `USD`,
	style   : 'currency',
} );

// hit.price value is an integer of say 5
price = dollars.format( hit.price ); // console.log( price ) will show $5.00
```

More information: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl
