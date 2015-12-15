
<?php 

	require "../conexion/conexion.php";
	class consulta{
		var $conn;
		var $conexion;
		function consulta(){		
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
		}	
		function reportePdfUsuarios(){			
			$html="";
			$sql="SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia = '1'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC";
			$rs=mysqli_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="center">
			Reporte de Horarios registrados en la Base de Datos.
			<br /><br />			
			<table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#FF0000"><td><font color="#FFFFFF">Hora de Inicio</font></td><td><font color="#FFFFFF">Nombre</font></td><td><font color="#FFFFFF">Descripcion</font></td></tr>';
			while ($row = mysqli_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["hora_inicio"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

