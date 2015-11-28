<?php
session_start();
if (! isset($_SESSION['usuario_n'])) {
	header("Location: \AdminC10\index.php");
	exit();
}
?>