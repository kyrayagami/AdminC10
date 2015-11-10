<?php
session_start();
include("loginLibrary.php");
include("conexion.php");
$_SESSION['SYSuser'] = $_POST['username']; 		//Nombre de Usuario del sistema
$_SESSION['SYSpassword']  = $_POST['password']; 	//Password del usuario
$login 	= new login($_SESSION['SYSuser'],$_SESSION['SYSpassword'], $conexion);
$login->security();

if($login->validate()==1){
	
	$_SESSION['login'] = "true";				// Login correcto = true
	//$_SESSION['User']  = $SYSuser;				//Username: ex: fulanito00
	$_SESSION['Type']  = $tipoUsuario;			//Tipo de usuario: Tecnico, becario, admin, general
	//$_SESSION['ID']    = $userID;				//ID de usuario
	
	
		echo "<meta http-equiv='refresh' content='0; URL=admin.php'>";
	}
	else {
		$_SESSION['login'] = "False";		
		echo "<h1><center>";
		echo "Username y/o Password INCORRECTO";
		echo "<meta http-equiv='refresh' content='5; URL=index.html'>";
		echo "</h1></center>";
	}

?>
