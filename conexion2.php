<?php
$statusConexion=true;
function consultHorarios2($conexion){

}
function obtenerProgramas($conexion){

}
function obtenerDias($conexion){
	$sql=mysql_query("select * from programas where estatus='ACTIVO'");
}
/*function consultaHorarios($conexion){
	$acu=0;
	$salida='';
	$M='';
	$T='';
	$N='';
	$consulta=mysql_query("SELECT * 
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND programas.id_programa = horario.id_programa
		ORDER BY horario.dia, horario.hora_inicio ASC
		");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
			// mañana			
			$acu=$acu+1;
	 		$la="layer".$acu."";
	 		$muestra="show('layer".$acu."')";
			$hora=str_replace(":", "",$dato["hora_inicio"]);
	 		if($hora<=115959 ){
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
              </li> ';
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
}*/

function consultaProgramas($conexion){
	$salida='';
	//Realizamos la Consulta que nos traera todos los registros de la BD
	//$consulta=mysql_query('select id,nombre,edad,telefono,ciudad,status from user');
	//$consulta = mysql_query('SELECT conductores.*, conductores_imagenes.*, imagenes.* FROM conductores, conductores_imagenes, imagenes WHERE conductores.id_conductor = conductores_imagenes.id_conductor and imagenes.id_imagen = conductores_imagenes.id_imagen ORDER BY conductor');
	//$consulta = "SELECT programas.*, categoria.*, productores.* FROM programas, categoria, productores WHERE programas.id_categoria = categoria.id_categoria and productores.id_productor = programas.id_productor order by programas.nombre";
	$consulta = mysql_query("select * from programas");
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
					<td> <span class="'.returnStatus($dato["estatus"]).'">'.$dato["estatus"].'
					</span></td>
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
				<td colspan="7">No hay Registros en la Base de Datos</td>
			</tr>
		 ';
	 }
	 return $salida;
}
function consultaCategoria($conexion){
	$salida='';
	$consulta= mysql_query("select * from categoria");
	if(mysql_num_rows($consulta)>0){
		while($dato=mysql_fetch_array($consulta)){
			$salida.='
				<tr>			 	
					<td>'.$dato["id_categoria"].'</td>
					<td>'.$dato["categoria"].'</td>					
					<td><a class="btn btn-info">Editar</a>
					<a class="btn btn-danger">Eliminar</a></td>
				</tr>
			';
		}
	}else{
		$salida='
		<tr id="sinDatos">
				<td colspan="7">No hay Registros en la Base de Datos</td>
			</tr>
		';
	}
	return $salida;
}

function returnStatus($palabra){
	switch($palabra){
		case "ACTIVO":
			//$status="btn-success";
			$status="label label-success";
		break;
		case "INACTIVO":
			//$status="btn-warning";
			$status="label label-warning";
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
if(!mysql_select_db('promo_vision2',$conex)){
	$statusConexion=false;
}
else{
	mysql_query("set names 'utf-8'",$conex);
}
error_reporting(0);

//
//prueba de envio  informacion
//

function consulta_lunes($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '1'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_martes($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '2'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_miercoles($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '3'
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_jueves($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '4'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_viernes($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '5'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_sabado($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '6'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

function consulta_domingo($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
FROM horario_prueba, programas_prueba
WHERE programas_prueba.estatus =  'ACTIVO'
AND horario_prueba.dia =  '7'
AND programas_prueba.id_programa = horario_prueba.id_programa
ORDER BY horario_prueba.dia, horario_prueba.hora_inicio ASC 
");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		

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
	 			// tarde 
	 		if ($hora>=120000 && $hora<=185959) {
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
	 		} 
	 		if($hora>=190000 && $hora<=235959){
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

?>