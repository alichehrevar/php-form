<!-- Global scripts -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- End:Global scripts -->
<!-- Toastify -->
<script>
    // Display Toast Messages
    <?php if (isset($_SESSION['error'])): ?>
    Toastify({
        text: "<?php echo $_SESSION['error']; ?>",
        duration: 3000,
        gravity: "top",
        position: "center",
        backgroundColor: "red",
        close: true,
    }).showToast();
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
    Toastify({
        text: "<?php echo $_SESSION['success']; ?>",
        duration: 3000,
        gravity: "top",
        position: "center",
        backgroundColor: "green",
        close: true,
    }).showToast();
    <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</script>
<!-- End:Toastify -->

<!-- Inner pages scripts -->

<?php if (!empty($customScripts)) {
    foreach ($customScripts as $script) {
        echo $script . "\n";
    }
} ?>
<!-- End:Inner pages scripts -->
