<?php
session_start();
include("conexion3.php");

if(isset($_POST['usuario_n']) && !empty($_POST['usuario_n'])&&
	isset($_POST['contra'])&& !empty($_POST['contra']))
{
	
	$con=mysql_connect($host,$user,$pw) or die("Problemas al conectar");
	mysql_select_db($db,$con) or die("Problemas con la DB");

	//$user=$_POST['usuario_n'];   ".$user."
	$sel=mysql_query("SELECT usuario_n,contra FROM usuarios WHERE usuario_n='$_POST[usuario_n]'",$con);
	$sesion=mysql_fetch_array($sel);

	if($_POST['contra']==$sesion['contra']){
		$_SESSION['usuario_n']=$_POST['contra'];

		session_start();
		$_SESSION['usuario_n']=$_POST['usuario_n'];

		header("Location: \AdminC10\inicio2.php");

		exit(0);
	}else{
		header("Location: \AdminC10\index.php?mensajeo=6");
	}


	//$con = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
   // mysql_select_db($db,$con) or die("Problemas con DB");
	if(isset($_POST['usuario_n']) && !empty($_POST['usuario_n'])&&
	isset($_POST['contra'])&& !empty($_POST['contra']))
	{
    $sel3=mysql_query("SELECT usuario_n FROM usuarios WHERE usuario_n='$_POST[usuario_n]'",$con);
    $sesion3=mysql_fetch_array($sel3);
    $sel4=mysql_query("SELECT correo FROM usuarios WHERE usuario_n='$_POST[usuario_n'",$con);
    $sesion4=mysql_fetch_array($sel4);
    $_SESSION['nom']=sel3;
    $_SESSION['correo']=sel4;

    echo $_SESSION['nom'];

	}

}

?>