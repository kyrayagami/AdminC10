<?php
$server="localhost"; //servidor donde esta la base de datos
//$database="root";
$dbpass="123456";
$database="promovis_ion"; //base de datos que se usa
//$dbpass="qT!k59fP#8b="; 
//$dbuser="promovis_canal10";
$dbuser="root";
if(!($conexion=mysql_connect($server,$dbuser,$dbpass)))
	{
	exit();
	echo "Error";
	}
else{
}
if(!mysql_select_db($database,$conexion))
	{
	exit();
	echo "Error";
	}
else{
} 
return $conexion;
?>