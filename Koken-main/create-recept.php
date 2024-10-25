<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshGen - Voeg je eigen recept toe</title>
    <link rel="website Icon" href="./media/FreshGen.jpeg">

    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts for Cooper Black -->
    <link href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
   body {
    font-family: 'Signika Negative', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 font-cooper">

    <!-- Sticky Header -->
    <header class="fixed top-0 w-full py-5 bg-green-700 text-white shadow-lg z-50">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-3xl font-bold">FreshGen</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="text-white hover:text-gray-300">Home</a></li>
                    <li><a href="recepten.php" class="text-white hover:text-gray-300">Recepten</a></li>
                    <li><a href="create-recept.php" class="text-white hover:text-gray-300">Recept Toevoegen</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Create Recept Section -->
    <section class="py-20 bg-white min-h-screen flex items-center justify-center">
        <div class="container mx-auto max-w-lg bg-gray-100 p-10 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-green-900 mb-8 text-center">Voeg Je Eigen Recept Toe</h2>
            
            <!-- Recipe Form -->
            <form id="recipe-form" class="space-y-4">
                <div>
                    <label for="recipe-name" class="block text-lg text-gray-700 mb-1">Naam van het Recept</label>
                    <input type="text" id="recipe-name" class="w-full p-3 rounded-lg border border-gray-300" placeholder="Bijv. Gezonde Smoothie" required>
                </div>
                <div>
                    <label for="category" class="block text-lg text-gray-700 mb-1">Categorie</label>
                    <input type="text" id="category" class="w-full p-3 rounded-lg border border-gray-300" placeholder="Bijv. Ontbijt" required>
                </div>
                <div>
                    <label for="instructions" class="block text-lg text-gray-700 mb-1">Instructies</label>
                    <textarea id="instructions" class="w-full p-3 rounded-lg border border-gray-300" rows="4" placeholder="Bijv. Mix alle ingrediënten..." required></textarea>
                </div>
                <div>
                    <label for="image-url" class="block text-lg text-gray-700 mb-1">Afbeeldings URL</label>
                    <input type="url" id="image-url" class="w-full p-3 rounded-lg border border-gray-300" placeholder="Bijv. https://example.com/image.jpg" required>
                </div>
                <button type="submit" class="bg-green-600 text-white py-3 px-6 rounded-lg shadow-lg w-full">Recept Toevoegen</button>
            </form>

            <!-- Confirmation Message -->
            <div id="confirmation-message" class="hidden mt-4 bg-green-500 text-white py-3 px-6 rounded-lg text-center font-bold">
                Recept is succesvol toegevoegd!
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-5 text-center">
        <p>&copy; 2024 FreshGen. Alle rechten voorbehouden.</p>
    </footer>

    <!-- JavaScript for handling form submission -->
    <script src="./js/create-recept.js"></script>
</body>
</html>
