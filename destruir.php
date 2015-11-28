<?php  
session_start();
session_destroy();

header("Location: \AdminC10\index.php");
?>