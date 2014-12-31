/**
 * Main backend JavaScript for Scsb
 *
 * @author René Schulze
 * @package Scsb
 **/

if( typeof jQuery != 'undefined' ) {

	// Helper methods for Scsb
	var scsbHelper = {

		// Add search box
		addSearchBox: function( m ) {
			// Get category lists
			var catLists = jQuery('.categorychecklist');

			// Loop through lists
			catLists.each(function(){
				var curEl = jQuery(this);
				var placeHolderLabel = ( scsbLanguage && scsbLanguage.filterCategories )
					? scsbLanguage.filterCategories
					: 'Filter categories';

				// Build search box
				var searchBox = jQuery(
					'<div class="scsb">'
						+ '<input type="search" name="scsb" class="scsb-term" placeholder="' + placeHolderLabel + '" />'
						+ '<button class="scsb-clear" tabindex="0">⨯</button>'
					+ '</div>'
				);

				// Events for term
				searchBox.find('.scsb-term').bind('keyup change', function(){
					var term = jQuery(this).val();
					var categories = curEl.find('li');

					// Filter categories
			        if( term != '' ) {
			            categories.hide();
			            categories.filter(function() {
			                return jQuery(this).text().toLowerCase().indexOf(term) > -1;
			            }).show();
			        } else {
			            categories.show();
			        }

				});

				// Events for clear button
				searchBox.find('.scsb-clear').click(function(e){
					e.preventDefault();

					jQuery(this).prev('.scsb-term')
						.val('')	// Clear search term field
						.change();	// Fire change event

					// Focus term input field
					searchBox.find('.scsb-term').focus();
				});

				// Prepend search box to category list
				if( curEl.children().size() > 0 ) {
					curEl.before(searchBox);
				}

			});
		},
	};

	// Fire methods, when DOM is ready
	jQuery(document).ready(function(){
		scsbHelper.addSearchBox(); // Add search box
	});

}