document.addEventListener('DOMContentLoaded', function () {
    // Find the search button by its ID
    var searchButton = document.getElementById('searchButton');

    // Find the container for the sneakers
    var sneakersContainer = document.querySelector('.row.justify-content-center');

    // Find the "no-products-found-error" div by its class
    var noProductsFoundError = document.querySelector('.no-products-found-error');

    // Add an event listener for the search button
    searchButton.addEventListener('click', function () {
        // Capture the user's search input
        var searchTerm = document.getElementById('searchbar').value.toLowerCase();

        // Iterate through the sneakers and filter based on the search term
        var sneakers = document.querySelectorAll('.card.card-product-grid');
        var foundSneakers = false;

        sneakers.forEach(function (sneaker) {
            var sneakerName = sneaker.querySelector('.card-title').textContent.toLowerCase();

            if (sneakerName.includes(searchTerm)) {
                // Show sneakers that match the search term
                sneaker.style.display = 'block';
                foundSneakers = true;
            } else {
                // Hide sneakers that don't match
                sneaker.style.display = 'none';
            }
        });

        // Display or hide the "no-products-found-error" div based on whether sneakers are found
        if (foundSneakers) {
            noProductsFoundError.style.display = 'none'; // Hide the div
            title1.style.display = 'block'; // Show the element
            title2.style.display = 'block'; // Show the element
        } else {
            noProductsFoundError.innerHTML = 'No products found that matched your search'; // Show the div
            noProductsFoundError.style.display = 'block'; // Show the div
            title1.style.display = 'none'; // Hide the element
            title2.style.display = 'none'; // Hide the element
        } 
    });
});
