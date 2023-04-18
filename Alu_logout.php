<html>
    <body>
        <?php echo '<script>alert("You have been logged out"); </script>'; ?>
    </body>
</html>

<?php
    session_start();
    session_destroy();
    header('location: alumni.php?status=loggedout');
?>