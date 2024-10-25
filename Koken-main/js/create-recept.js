const recipeForm = document.getElementById('recipe-form');
const confirmationMessage = document.getElementById('confirmation-message');

// Function to handle form submission
async function handleFormSubmit(event) {
    event.preventDefault();  // Prevent page reload

    // Collect form data
    const recipeName = document.getElementById('recipe-name').value.trim();
    const category = document.getElementById('category').value.trim();
    const instructions = document.getElementById('instructions').value.trim();
    const imageUrl = document.getElementById('image-url').value.trim();

    // Simple validation
    if (recipeName && category && instructions && imageUrl) {
        try {
            // API POST request to save the recipe (replace with your actual API endpoint)
            const response = await fetch('http://localhost:3000/api/recipes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: recipeName,
                    category: category,
                    instructions: instructions,
                    imageUrl: imageUrl
                })
            });

            if (response.ok) {
                const newRecipe = await response.json();
                console.log('New recipe added:', newRecipe);

                // Show confirmation message
                confirmationMessage.innerText = 'Recept is succesvol toegevoegd!';
                confirmationMessage.classList.remove('hidden');  // Show message

                // Optionally reset form
                recipeForm.reset();

                // Redirect to home page after 2 seconds
                setTimeout(() => {
                    window.location.href = '../index.php';
                }, 2000);  // 2 seconds delay before redirect
            } else {
                alert('Er is een fout opgetreden bij het toevoegen van het recept.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Er is een fout opgetreden. Probeer het opnieuw.');
        }
    } else {
        alert('Vul alstublieft alle velden in.');
    }
}

// Attach form submit event listener
recipeForm.addEventListener('submit', handleFormSubmit);
