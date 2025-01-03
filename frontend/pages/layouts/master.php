<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require_once __DIR__ . '/partials/head.php'; ?>
    <!-- End:Head -->
    <!-- Body -->
    <body class="bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center min-h-screen">
        <!-- Main Content -->
        <?php
            echo isset($content) ? $content : '';
        ?>
        <!-- End:Main Content -->
        <!-- Load Routes -->
        <?php require_once __DIR__ . '/../../../routes/web.php'; ?>
        <!-- End:Load Routes -->
        <!-- Scripts -->
        <?php require_once __DIR__ . '/partials/scripts.php'; ?>
        <!-- End:Scripts -->
    </body>
    <!-- End:Body -->
</html>

<?php
// Clear session data after rendering the form
unset($_SESSION['old_input']);
?>