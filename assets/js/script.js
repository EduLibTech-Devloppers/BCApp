// Toggle hamburger menu
const hamburgerMenu = document.querySelector('.hamburger-menu');
const navMenu = document.querySelector('nav ul');

hamburgerMenu.addEventListener('click', () => {
    navMenu.classList.toggle('show');
});

// Fetch and display new releases
fetch('new_releases.php')
    .then(response => response.json())
    .then(data => {
        const bookCarousel = document.querySelector('.book-carousel');
        data.forEach(book => {
            const bookElement = document.createElement('div');
            bookElement.classList.add('book-item');
            bookElement.innerHTML = `
                <img src="${book.cover_image}" alt="${book.title}">
                <h3>${book.title}</h3>
                <p>${book.author}</p>
            `;
            bookCarousel.appendChild(bookElement);
        });
    })
    .catch(error => console.error('Error fetching new releases:', error));

// Fetch and display genres
fetch('genres.php')
    .then(response => response.json())
    .then(data => {
        const genreGrid = document.querySelector('.genre-grid');
        data.forEach(genre => {
            const genreElement = document.createElement('div');
            genreElement.classList.add('genre-item');
            genreElement.innerHTML = `
                <h3>${genre.name}</h3>
                <a href="books.php?genre=${genre.id}">View Books</a>
            `;
            genreGrid.appendChild(genreElement);
        });
    })
    .catch(error => console.error('Error fetching genres:', error));