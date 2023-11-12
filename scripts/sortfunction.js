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
