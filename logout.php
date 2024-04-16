<!-- logout.php -->
<?php
session_destroy();
header("Location: index.html");
?>