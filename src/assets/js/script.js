// Ce fichier contient le code JavaScript pour ajouter des fonctionnalités interactives aux pages, comme le tri et le filtrage des livres.

document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const booksList = document.querySelector('.books-list');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterType = this.dataset.filter;
            filterBooks(filterType);
        });
    });

    function filterBooks(type) {
        const books = booksList.querySelectorAll('.book-item');
        books.forEach(book => {
            if (type === 'all' || book.classList.contains(type)) {
                book.style.display = 'block';
            } else {
                book.style.display = 'none';
            }
        });
    }

    const sortSelect = document.querySelector('#sort-select');
    sortSelect.addEventListener('change', function() {
        sortBooks(this.value);
    });

    function sortBooks(criteria) {
        const books = Array.from(booksList.querySelectorAll('.book-item'));
        books.sort((a, b) => {
            const aValue = a.dataset[criteria];
            const bValue = b.dataset[criteria];

            if (criteria === 'date') {
                return new Date(aValue) - new Date(bValue);
            } else if (criteria === 'title') {
                return aValue.localeCompare(bValue);
            } else if (criteria === 'most-read') {
                return bValue - aValue; // Assuming this is a number
            }
        });

        books.forEach(book => booksList.appendChild(book));
    }
});