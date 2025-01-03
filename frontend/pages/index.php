<?php
session_start();
$title = 'Sign Up Form';
ob_start();
?>
<div class="bg-white flex flex-col p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-extrabold text-gray-800 text-center mb-8">Create Your Account</h2>
    <form id="signupForm" method="POST" action="/signup_process">
        <!-- Name Field -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
            <input type="text" id="name" name="name" placeholder="John" value="<?php echo isset($_SESSION['old_input']['name']) ? htmlspecialchars($_SESSION['old_input']['name']) : ''; ?>" class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <p id="nameError" class="text-red-500 text-sm"></p>
        </div>

        <!-- Surname Field -->
        <div class="mb-6">
            <label for="surname" class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
            <input type="text" id="surname" name="surname" placeholder="Doe" value="<?php echo isset($_SESSION['old_input']['surname']) ? htmlspecialchars($_SESSION['old_input']['surname']) : ''; ?>" class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <p id="surnameError" class="text-red-500 text-sm"></p>
        </div>

        <!-- Email Field -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" value="<?php echo isset($_SESSION['old_input']['email']) ? htmlspecialchars($_SESSION['old_input']['email']) : ''; ?>" class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <p id="emailError" class="text-red-500 text-sm"></p>
        </div>

        <!-- Password Field -->
        <div class="mb-8">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <p id="passwordError" class="text-red-500 text-sm"></p>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg text-lg font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">Sign Up</button>
    </form>

    <!-- Show Source Code Button -->
    <a href="https://github.com/alichehrevar/php-form" target="_blank" type="button" class="mt-6 text-center flex items-center justify-center gap-2 bg-gray-800 text-white py-2 rounded-lg text-lg font-medium hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
            <path d="M12 0C5.371 0 0 5.371 0 12c0 5.301 3.438 9.799 8.205 11.387.6.111.82-.261.82-.58 0-.287-.01-1.051-.015-2.063-3.338.724-4.042-1.608-4.042-1.608-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.085 1.839 1.237 1.839 1.237 1.07 1.834 2.809 1.304 3.494.997.108-.775.419-1.304.763-1.604-2.665-.304-5.466-1.332-5.466-5.93 0-1.31.469-2.381 1.235-3.221-.123-.303-.535-1.523.117-3.176 0 0 1.007-.322 3.301 1.23.957-.267 1.983-.4 3.003-.404 1.02.004 2.047.137 3.005.404 2.29-1.552 3.295-1.23 3.295-1.23.654 1.653.242 2.873.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.805 5.623-5.475 5.921.43.37.815 1.102.815 2.222 0 1.604-.014 2.898-.014 3.293 0 .322.217.694.825.577C20.565 21.796 24 17.298 24 12c0-6.629-5.371-12-12-12z"/>
        </svg>
        Show Source Code
    </a>
</div>

<!-- Script file -->
<script src="/assets/js/js-validation.js"></script>

<?php
$content = ob_get_clean();
$customScripts = [
    '<script src="/assets/js/js-validation.js"></script>'
];
require __DIR__ . '/layouts/master.php';
?>
