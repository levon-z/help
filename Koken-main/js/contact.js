// Initialize EmailJS with your public key
emailjs.init("4D9LXNzC0kiaX1SFH"); // Your Public Key

// Add event listener to handle form submission
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent page reload

    // Get form values
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    // Template parameters to match EmailJS template variables
    const templateParams = {
        to_name: name,      // Using the name from the form as the greeting name
        from_name: name,    // Sender's name from the form
        message: message,   // Message from the form
        replyto: email,     // Reply-to email from the form
        to: "100199@glr.nl", // Recipient email address
        name: name,         // Sender's name
        email: email        // Sender's email
    };

    // Send email using EmailJS with the correct Service ID and Template ID
    emailjs.send('service_jbqoq48', 'template_4e624zl', templateParams)
        .then(function(response) {
            console.log('SUCCESS!', response.status, response.text);
            document.getElementById('responseMessage').textContent = "Bedankt voor je bericht! We nemen snel contact met je op.";
            document.getElementById('responseMessage').classList.add('text-green-500');
        }, function(error) {
            console.log('FAILED...', error);
            document.getElementById('responseMessage').textContent = "Sorry, er ging iets mis. Probeer het later opnieuw.";
            document.getElementById('responseMessage').classList.add('text-red-500');
        });

    // Reset the form
    document.getElementById('contactForm').reset();
});
