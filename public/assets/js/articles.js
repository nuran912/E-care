document.addEventListener("DOMContentLoaded", () => {
   const cardsContainer = document.getElementById("article-cards");
   const paginationContainer = document.getElementById("pagination");
   const searchBar = document.getElementById("search-bar");
   const searchButton = document.getElementById("btn-search");
   const cards = Array.from(cardsContainer.children);
   const cardsPerPage = 8;
   let currentPage = 1;

   function filterCards() {
      const searchQuery = searchBar.value.toLowerCase();

      return cards.filter(card => {
         const title = card.dataset.title.toLowerCase();
         const category = card.dataset.category.toLowerCase();

         return title.includes(searchQuery) || category.includes(searchQuery);
      });
   }

   function renderPagination(filteredCards) {
      paginationContainer.innerHTML = "";
      const totalPages = Math.ceil(filteredCards.length / cardsPerPage);

      const createButton = (text, page) => {
         const button = document.createElement("button");
         button.textContent = text;
         button.classList.toggle("active", page === currentPage);
         button.addEventListener("click", () => {
            currentPage = page;
            renderCards(filteredCards);
            renderPagination(filteredCards);
         });
         return button;
      };

      if (currentPage > 1) {
         paginationContainer.appendChild(createButton("Prev", currentPage - 1));
      }

      for (let i = 1; i <= totalPages; i++) {
         paginationContainer.appendChild(createButton(i, i));
      }

      if (currentPage < totalPages) {
         paginationContainer.appendChild(createButton("Next", currentPage + 1));
      }
   }

   function renderCards(filteredCards) {
      cardsContainer.innerHTML = "";
      const start = (currentPage - 1) * cardsPerPage;
      const end = start + cardsPerPage;
      const visibleCards = filteredCards.slice(start, end);
      visibleCards.forEach(card => cardsContainer.appendChild(card));
   }

   function applyFilters() {
      currentPage = 1;
      const filteredCards = filterCards();
      renderCards(filteredCards);
      renderPagination(filteredCards);
   }

   searchButton.addEventListener("click", applyFilters);

   renderCards(cards);
   renderPagination(cards);
});

