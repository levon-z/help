// Function to create the HTML for each recipe item
function createRecipeItem(recipe) {
    const itemDiv = document.createElement('div');
    itemDiv.classList.add(
        'item', 
        'bg-white', 
        'border-2', 
        'border-[#B99470]', 
        'rounded-2xl', 
        'shadow-md', 
        'p-4', 
        'w-full',   
        'sm:w-[calc(50%-20px)]', 
        'md:w-[calc(33%-20px)]', 
        'lg:w-[calc(30%-20px)]', 
        'm-2', 
        'flex', 
        'flex-col', 
        'justify-between', 
        'items-center',
        'transition-transform', 
        'duration-300', 
        'hover:shadow-lg', 
        'hover:scale-105'
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

    const link = document.createElement('button'); // Change from 'a' to 'button'
    link.textContent = 'Bekijk Recept';
    link.classList.add(
        'bg-[#B99470]', 
        'text-white', 
        'py-2', 
        'px-6', 
        'rounded', 
        'mt-4', 
        'hover:bg-[#8D7B5A]', 
        'hover:text-white',
        'transition-colors', 
        'duration-300',
        'text-center'
    );
    link.addEventListener('click', () => openRecipeModal(recipe.idMeal)); // Attach event to open modal
    itemDiv.appendChild(link);

    return itemDiv;
}

// Function to open the modal with recipe details
function openRecipeModal(recipeId) {
    const modal = document.getElementById('recipeModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalIngredients = document.getElementById('modalIngredients');
    const modalInstructions = document.getElementById('modalInstructions');
    const modalVideo = document.getElementById('modalVideo');

    // Fetch detailed recipe data
    const url = `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${recipeId}`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const recipe = data.meals[0];
            
            // Populate modal with recipe data
            modalImage.src = recipe.strMealThumb;
            modalTitle.textContent = recipe.strMeal;
            modalIngredients.textContent = `Ingrediënten: ${getIngredients(recipe)}`;
            modalInstructions.textContent = `Bereiding: ${recipe.strInstructions}`;
            modalVideo.src = recipe.strYoutube ? recipe.strYoutube.replace("watch?v=", "embed/") : '';

            // Show modal
            modal.classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching recipe details:', error));
}

// Helper function to extract ingredients and measurements
function getIngredients(recipe) {
    let ingredients = '';
    for (let i = 1; i <= 20; i++) {
        const ingredient = recipe[`strIngredient${i}`];
        const measure = recipe[`strMeasure${i}`];
        if (ingredient) {
            ingredients += `${ingredient} - ${measure}, `;
        }
    }
    return ingredients.slice(0, -2); // Remove the trailing comma
}

// Close modal when close button is clicked
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('recipeModal').classList.add('hidden');
});
