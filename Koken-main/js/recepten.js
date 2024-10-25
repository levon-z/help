// DOM Elements
const searchInput = document.getElementById('searchInput');
const recipeList = document.getElementById('recipeList');
const modal = document.getElementById('recipeModal');
const modalImage = document.getElementById('modalImage');
const modalTitle = document.getElementById('modalTitle');
const modalIngredients = document.getElementById('modalIngredients');
const modalInstructions = document.getElementById('modalInstructions');
const modalVideo = document.getElementById('modalVideo');
const suggestionsList = document.getElementById('suggestionsList');
const closeModalButton = document.getElementById('closeModal');
const searchButton = document.getElementById('searchButton');

const addedRecipeIds = new Set();
let loadedRecipesCount = 0;
const maxRecipes = 20;
let isFetching = false;

// Debounce function for search input
function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

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
            suggestionsList.innerHTML = '';
            if (data.meals) {
                data.meals.forEach(meal => {
                    const li = document.createElement('li');
                    li.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer', 'flex', 'items-center');
                    li.innerHTML = `
                        <img src="${meal.strMealThumb}" alt="${meal.strMeal}" class="inline-block w-10 h-10 rounded-full mr-2">
                        ${meal.strMeal}
                    `;
                    li.addEventListener('click', () => {
                        openRecipeModal(meal.idMeal);
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

// Trigger search suggestions on input change with debounce
searchInput.addEventListener('input', debounce(() => {
    const query = searchInput.value.trim();
    fetchRecipeSuggestions(query);
}, 300));

// Hide suggestion box when clicking outside
document.addEventListener('click', (event) => {
    if (!searchInput.contains(event.target) && !suggestionsList.contains(event.target)) {
        suggestionsList.classList.add('hidden');
    }
});

// Trigger search on search button click
searchButton.addEventListener('click', () => {
    const query = searchInput.value.trim();
    if (query) {
        fetchAndDisplayRecipes(query);
    }
});

// Show loading indicator
function showLoading() {
    recipeList.innerHTML = '<p class="text-center">Loading...</p>';
}

// Hide loading indicator
function hideLoading() {
    recipeList.innerHTML = ''; // Clear loading message
}

// Fetch and display recipes by search term
function fetchAndDisplayRecipes(query) {
    showLoading();
    const url = `https://www.themealdb.com/api/json/v1/1/search.php?s=${query}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            hideLoading();
            recipeList.innerHTML = '';
            if (data.meals) {
                displayRecipes(data.meals);
            } else {
                recipeList.innerHTML = '<p class="text-center text-red-500">Geen recepten gevonden voor deze zoekopdracht.</p>';
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error fetching search results:', error);
        });
}

// Fetch Multiple Random Recipes
function fetchMultipleRandomRecipes(count = 5) {
    if (isFetching || loadedRecipesCount >= maxRecipes) return;
    isFetching = true;
    const fetchPromises = Array(count).fill(null).map(() =>
        fetch(`https://www.themealdb.com/api/json/v1/1/random.php`)
            .then(response => response.json())
    );
    Promise.all(fetchPromises)
        .then(results => {
            results.forEach(data => {
                const recipe = data.meals[0];
                if (!addedRecipeIds.has(recipe.idMeal)) {
                    addedRecipeIds.add(recipe.idMeal);
                    displayRecipes([recipe]);
                    loadedRecipesCount++;
                }
            });
        })
        .catch(error => console.error('Error fetching random recipes:', error))
        .finally(() => isFetching = false);
}

// Display Recipes in the List
function displayRecipes(recipes) {
    recipes.forEach(recipe => {
        const recipeItem = createRecipeItem(recipe);
        recipeList.appendChild(recipeItem);
    });
}

// Create HTML for Each Recipe Item
function createRecipeItem(recipe) {
    const itemDiv = document.createElement('div');
    itemDiv.classList.add(
        'bg-white', 'border-2', 'rounded-xl', 'shadow-md', 'p-4', 'transition-transform',
        'duration-300', 'hover:shadow-lg', 'hover:scale-105', 'flex', 'flex-col', 'items-center'
    );

    const img = document.createElement('img');
    img.src = recipe.strMealThumb;
    img.alt = recipe.strMeal;
    img.classList.add('rounded-lg', 'w-full', 'h-40', 'object-cover', 'md:h-48');
    itemDiv.appendChild(img);

    const title = document.createElement('h3');
    title.textContent = `${recipe.strMeal} (${recipe.strArea})`;
    title.classList.add('text-[#5F6F52]', 'px-3', 'py-2', 'font-bold', 'text-center');
    itemDiv.appendChild(title);

    const link = document.createElement('button');
    link.textContent = 'Bekijk Recept';
    link.classList.add(
        'bg-[#B99470]', 'text-white', 'py-2', 'px-6', 'rounded', 'mt-4', 'hover:bg-[#8D7B5A]',
        'transition-colors', 'duration-300', 'text-center'
    );
    link.addEventListener('click', () => openRecipeModal(recipe.idMeal));
    itemDiv.appendChild(link);

    return itemDiv;
}

// Open Recipe Modal
function openRecipeModal(recipeId) {
    const url = `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${recipeId}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const recipe = data.meals[0];
            modalImage.src = recipe.strMealThumb;
            modalTitle.textContent = `${recipe.strMeal} (${recipe.strArea})`;
            modalIngredients.innerHTML = '';
            for (let i = 1; i <= 20; i++) {
                const ingredient = recipe[`strIngredient${i}`];
                const measure = recipe[`strMeasure${i}`];
                if (ingredient) {
                    const li = document.createElement('li');
                    li.textContent = `${ingredient} - ${measure}`;
                    modalIngredients.appendChild(li);
                }
            }
            modalInstructions.textContent = recipe.strInstructions;
            modalVideo.src = recipe.strYoutube ? recipe.strYoutube.replace('watch?v=', 'embed/') : '';
            modal.classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching recipe:', error));
}

// Close Modal
closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');
    modalVideo.src = '';
});

// Fetch Initial Recipes
fetchMultipleRandomRecipes();

// Infinite Scroll for Loading More Recipes
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
        fetchMultipleRandomRecipes();
    }
});

// Get the search query from the URL
const urlParams = new URLSearchParams(window.location.search);
const searchQuery = urlParams.get('search');

// If a search query is present, fetch the relevant recipes
if (searchQuery) {
    fetchAndDisplayRecipes(searchQuery);
}
