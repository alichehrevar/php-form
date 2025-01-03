document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        let isValid = true;

        document.getElementById('nameError').textContent = '';
        document.getElementById('surnameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';

        const name = document.getElementById('name');
        const surname = document.getElementById('surname');
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        // Reset error messages
        document.querySelectorAll('.error-message').forEach(error => error.textContent = '');

        // Validate Name
        if (name.value.trim() === '') {
            document.getElementById('nameError').textContent = 'Name is required.';
            isValid = false;
        }

        // Validate Surname
        if (surname.value.trim() === '') {
            document.getElementById('surnameError').textContent = 'Surname is required.';
            isValid = false;
        }

        // Validate Email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            document.getElementById('emailError').textContent = 'Invalid email format.';
            isValid = false;
        }

        // Validate Password
        if (password.value.trim().length < 6) {
            document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long.';
            isValid = false;
        }

        if (isValid) {
            // Submit the form
            form.submit();
        }
    });
});