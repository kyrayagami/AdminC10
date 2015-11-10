<?php
$statusConexion=true;
function consultaHorarios($conexion){
	$acu=0;
	$salida='';
	$M='';
	$T='';
	$N='';
	$consulta=mysql_query("SELECT * 
		FROM horario_prueba, programas_prueba
		WHERE programas_prueba.estatus =  'ACTIVO'
		AND programas_prueba.id_programa = horario_prueba.id_programa
		ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC
		");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
	 		/*
	 		$hora=str_replace(":","",$horaBD); //MySQL devuelve la hora en formato H:i:s, debemos quitarle los dos puntos; 
			if (intval($hora)<intval(date("His")) $turno="T1";  
	 		*/


			//algo para separar por dia
			// mañana			
			$acu=$acu+1;
	 		$la="layer".$acu."";
	 		$muestra="show('layer".$acu."')";
			$hora=str_replace(":", "",$dato["hora_inicio"]);
	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer">
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["id_programa"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion"].'</span>
                    <br>
                    </p>
                    <p></p>
                  </div> 
                  </div>
              </li> 
	 			';
	 		}
	 		else{
	 			// tarde 
	 			if ($hora<=185959) {
	 				$T.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["id_programa"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion"].'</span>
                    <br>
                    </p>
                    <p></p>
                  </div> 
                  </div>
              </li> 
	 			';
	 			} else{
	 				//noche
	 				$N.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["id_programa"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion"].'</span>
                    <br>
                    </p>
                    <p></p>
                  </div> 
                  </div>
              </li> 
	 			';
	 				}
	 		}	 		
	 		// <li class="estilo_lista" onclick="show('.$la.')">
	 		//$salida = array("hola soy","");	
		}		
	}
	else
	{
		$salida='<tr id="sinDatos">
		<td colspan="7">No hay Registros en la Base de Datos, Tu codigo!!</td>
		</tr>';
	}
	$salida = array($M,$T,$N);	
	return $salida;
}
function consultaProgramas($conexion){
	$salida='';
	//Realizamos la Consulta que nos traera todos los registros de la BD
	//$consulta=mysql_query('select id,nombre,edad,telefono,ciudad,status from user');
	//$consulta = mysql_query('SELECT conductores.*, conductores_imagenes.*, imagenes.* FROM conductores, conductores_imagenes, imagenes WHERE conductores.id_conductor = conductores_imagenes.id_conductor and imagenes.id_imagen = conductores_imagenes.id_imagen ORDER BY conductor');
	//$consulta = "SELECT programas.*, categoria.*, productores.* FROM programas, categoria, productores WHERE programas.id_categoria = categoria.id_categoria and productores.id_productor = programas.id_productor order by programas.nombre";
	$consulta = mysql_query("select * from programas_prueba");
	//$conductores = mysql_query($sql, $conexion) or die(mysql_error());  
	 //Validamos si hay o no registros
	 if(mysql_num_rows($consulta)>0){
		 while($dato=mysql_fetch_array($consulta)){
			 $salida.='	
			 	<tr>			 	
					<td>'.$dato["id_programa"].'</td>
					<td>'.$dato["nombre"].'</td>					
					<td>'.$dato["descripcion"].'</td>
					<td>'.$dato["correo"].'</td>
					<td class="'.returnStatus($dato["estatus"]).'">'.$dato["estatus"].'</td>
					<td><a class="btn btn-info">Editar</a>
					<a class="btn btn-danger">Eliminar</a></td>
				</tr>
			 ';
		 }
	 }
	 else
	 {
		 $salida='
		 	<tr id="sinDatos">
				<td colspan="7">No hay Registros en la Base de Datos, Tu codigo!!</td>
			</tr>
		 ';
	 }
	 return $salida;
}
function returnStatus($palabra){
	switch($palabra){
		case "ACTIVO":
			$status="btn-success";
		break;
		case "INACTIVO":
			$status="btn-warning";
		break;
		/*
		case "Cancelado":
			$status="btn-danger";
		break; */
	 }	
return $status;
}
if(!$conex=mysql_connect('localhost','root','123456')){
	$statusConexion=false;
}
if(!mysql_select_db('promovis_ion',$conex)){
	$statusConexion=false;
}
else{
	mysql_query("set names 'utf-8'",$conex);
}

?>