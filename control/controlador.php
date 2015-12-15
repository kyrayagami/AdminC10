<?php 
	require("../modelo/consulta.php");
	$objConsulta = new consulta();
	
	if(isset($_POST["registrar"])){
		$registro = $objConsulta->registrarUsuario($_POST["nombres"],$_POST["apellidos"],$_POST["telefono"],$_POST["ciudad"]); 
		if($registro){
		?>
			<script>
				alert('Registro Exitoso');
				location.href="../vista/index.php";
            </script>
		<?php
		}else{
		?>
			<script>
				alert('Registro Exitoso');
				location.href="../vista/index.php";
            </script>
		<?php
		}
	}
?>