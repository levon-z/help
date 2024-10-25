<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshGen - Contact</title>
        <link rel="website Icon" href="./media/FreshGen.jpeg">

    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
    (function(){
      emailjs.init("4D9LXNzC0kiaX1SFH");
    })();
    </script>
    <script src="./js/contact.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
   body {
    font-family: 'Signika Negative', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 font-cooper min-h-screen flex flex-col">
    <header class="fixed top-0 w-full py-5 bg-green-700 text-white z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-3xl font-bold">FreshGen</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="text-white hover:text-gray-300">Home</a></li>
                    <li><a href="recepten.php" class="text-white hover:text-gray-300">Recepten</a></li>
                    <li><a href="contact.php" class="text-white hover:text-gray-300">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contact Page Content -->
    <section class="py-20 flex-grow flex justify-center items-center">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="bg-white shadow-lg rounded-lg p-8 flex flex-col lg:flex-row items-center lg:items-start">
                
                <!-- Form Section -->
                <div class="lg:w-1/2 lg:mr-8">
                    <h2 class="text-4xl font-bold text-center lg:text-left mb-8 text-gray-800">Neem contact met ons op</h2>
                    <form id="contactForm">
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">Naam</label>
                            <input class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600" id="name" name="name" type="text" placeholder="Je naam" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">E-mail</label>
                            <input class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600" id="email" name="email" type="email" placeholder="Je e-mail" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-semibold mb-2" for="message">Bericht</label>
                            <textarea class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-600" id="message" name="message" rows="4" placeholder="Je bericht" required></textarea>
                        </div>
                        <div class="flex justify-center">
                            <button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-transform duration-300" type="submit">
                                Verstuur
                            </button>
                        </div>
                    </form>
                    <p id="responseMessage" class="text-center mt-4 text-lg font-semibold text-gray-700"></p>
                </div>

                <!-- Image Section -->
                <div class="lg:w-1/2 mt-8 lg:mt-12 flex justify-center lg:justify-end">
                    <img src="https://verstegen.nl/wp-content/uploads/sites/4/2023/11/Omeletrol-met-cherrytomaat-en-spinazie-800x600-Tiny.jpg" alt="Contact Image" class="rounded-lg shadow-lg w-full lg:w-auto lg:max-w-lg">
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-green-700 text-white py-5 text-center mt-auto">
        <p>&copy; 2024 FreshGen. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
