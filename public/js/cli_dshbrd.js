document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#available-books-body');
    const searchInput = document.querySelector('#searchInput');

    // Fetch books from API
    async function fetchBooks() {
        const res = await fetch('/record_management_system/api/client/books');
        const data = await res.json();
        console.log(data.books);
        return data.books;

    }

    // Render books into the table
    function renderBooks(books) {
        tableBody.innerHTML = '';
        books.forEach(book => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${book.id}</td>
                <td>${book.title}</td>
                <td>${book.author}</td>
              <td>
                <form method="POST" action="/client/rent/${book.id}" style="display: inline;">
                    <button type="submit" class="btn btn-rent">
                        <i class="fas fa-book-reader icon"></i>Rent
                    </button>
                </form>
            </td>

            `;
            tableBody.appendChild(row);
        });
    }

    // Main
    fetchBooks().then(books => {
        renderBooks(books);

        // Add live search
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();

            const filtered = books.filter(book =>
                book.id.toString().includes(query) ||
                book.title.toLowerCase().includes(query) ||
                book.author.toLowerCase().includes(query)
            );

            renderBooks(filtered);

            const noResultsMessage = document.getElementById('no-results');
            if (filtered.length === 0 && query.trim() !== '') {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        });

    });
});
