// DOM Elements for the Search Suggestions
const searchInput = document.getElementById('searchInput');
const suggestionsList = document.getElementById('suggestionsList');
const searchButton = document.getElementById('searchButton');



// Fetch Recipes by Search Term for Suggestions
function fetchRecipeSuggestions(query) {
    if (query.length < 2) {
        suggestionsList.classList.add('hidden');
        return;
    }

    const url = `https://www.themealdb.com/api/json/v1/1/search.php?s=${query}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            suggestionsList.innerHTML = ''; // Clear previous suggestions
            if (data.meals) {
                data.meals.forEach(meal => {
                    const li = document.createElement('li');
                    li.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer', 'flex', 'items-center');
                    li.innerHTML = `
                        <img src="${meal.strMealThumb}" alt="${meal.strMeal}" class="inline-block w-10 h-10 rounded-full mr-2">
                        ${meal.strMeal}
                    `;
                    li.addEventListener('click', () => {
                        // CHANGED: Redirect to recepten.php with the search query
                        window.location.href = `../recepten.php`;
                        suggestionsList.classList.add('hidden');
                    });
                    suggestionsList.appendChild(li);
                });
                suggestionsList.classList.remove('hidden');
            } else {
                suggestionsList.classList.add('hidden');
            }
        })
        .catch(error => console.error('Error fetching suggestions:', error));
}

// Trigger search suggestions on input change
searchInput.addEventListener('input', () => {
    const query = searchInput.value.trim();
    fetchRecipeSuggestions(query);
});

// Hide suggestion box when clicking outside
document.addEventListener('click', (event) => {
    if (!searchInput.contains(event.target) && !suggestionsList.contains(event.target)) {
        suggestionsList.classList.add('hidden');
    }
});

// Handle search button click
searchButton.addEventListener('click', () => {
    const query = searchInput.value.trim();
    if (query) {
        // CHANGED: Redirect to recepten.php with the search query
        window.location.href = `../recepten.php`;
    }
});

// Header transparency effect on scroll
const header = document.querySelector('header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 10) {
        header.classList.add('bg-green', 'shadow-md');
        header.classList.remove('bg-transparent');
    } else {
        header.classList.remove('bg-green', 'shadow-md');
        header.classList.add('bg-transparent');
    }
});
