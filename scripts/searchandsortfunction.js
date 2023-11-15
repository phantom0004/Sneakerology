//SEARCH FUNCTION
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

//SORT FUNCTION
document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to the sort options
    var sortByHighestPrice = document.getElementById('sortByHighestPrice');
    var sortByLowestPrice = document.getElementById('sortByLowestPrice');
    var sortByDefault = document.getElementById('sortByDefault');

    // Find both containers for the sneakers
    var sneakersContainers = document.querySelectorAll('.d-flex.justify-content-center.flex-wrap');
    var originalSneakersHTML = [];

    // Clone the original containers for each set of products
    sneakersContainers.forEach(function (sneakersContainer) {
        originalSneakersHTML.push(sneakersContainer.innerHTML);
    });

    // Define a function to sort the products based on the selected option
    function sortProducts(sortBy) {
        sneakersContainers.forEach(function (sneakersContainer, index) {
            var sneakers = sneakersContainer.querySelectorAll('.card.card-product-grid');

            // Convert the NodeList to an array for sorting
            var sneakersArray = Array.from(sneakers);

            // Hide elements with IDs "title1" and "title2" for each set of products
            var title1 = document.getElementById('title1');
            var title2 = document.getElementById('title2');
            title1.style.display = 'none';
            title2.style.display = 'none';

            if (sortBy === 'highestPrice') {
                sneakersArray.sort(function (a, b) {
                    var priceA = parseFloat(a.querySelector('.text-primary').textContent.replace('$', ''));
                    var priceB = parseFloat(b.querySelector('.text-primary').textContent.replace('$', ''));
                    return priceB - priceA;
                });
            } else if (sortBy === 'lowestPrice') {
                sneakersArray.sort(function (a, b) {
                    var priceA = parseFloat(a.querySelector('.text-primary').textContent.replace('$', ''));
                    var priceB = parseFloat(b.querySelector('.text-primary').textContent.replace('$', ''));
                    return priceA - priceB;
            });
            } else if (sortBy === 'default') {
                // Restore the original HTML content for each set of products
                sneakersContainer.innerHTML = originalSneakersHTML[index];
                title1.style.display = 'block';
                title2.style.display = 'block';
                return;
            }

            // Clear the current display and re-render sorted sneakers
            sneakersContainer.innerHTML = '';
            sneakersArray.forEach(function (sneaker) {
                sneakersContainer.appendChild(sneaker);
            });
        });
    }

    // Add event listeners to handle sorting
    sortByHighestPrice.addEventListener('click', function () {
        sortProducts('highestPrice');
    });

    sortByLowestPrice.addEventListener('click', function () {
        sortProducts('lowestPrice');
    });

    sortByDefault.addEventListener('click', function () {
        sortProducts('default');
    });
});

