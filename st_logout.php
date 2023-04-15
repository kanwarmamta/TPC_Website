<html>
    <body>
        <?php echo "Logged out successfully."; ?>
    </body>
</html>

<?php
    session_start();
    session_destroy();
    header('location: student.php?status=loggedout');
?>