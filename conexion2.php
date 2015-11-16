<?php
$statusConexion=true;
function consultHorarios2($conexion){	
/*
$acu=0;
$salida='';
$M='';
$T='';
$N='';
*/
$lu='';
$ma='';
$mi='';
$ju='';
$vi='';
$sa='';
$do='';
$dia=1;
$i=0;
$j=0;
$mayor=0;
$pos=0;
$cont=0;
$array1='';
$consulta=mysql_query("SELECT * 
FROM horario, programas
WHERE programas.estatus =  'ACTIVO'
AND programas.id_programa = horario.id_programa
ORDER BY horario.dia, horario.hora_inicio ASC ");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{
	 		
	 		if($dato["dia"]!=$dia){
	 			$dia=$dato["dia"];
	 			$i=0;
	 			$j++;
	 		}
	 		$array1[$i][$j]='<td>'
	 			.$dato["dia"].'&nbsp'.$dato["nombre"].
	 			'<br>'.$dato["hora_inicio"].
	 			'<br>'.$dato["duracion"].	 			
	 			'</td>';
	 		$i++;
	 		if($i>$mayor)
				$mayor=$i;
	 		///////////////////////
	 		/*
	 		if($dato["dia"]==$dia){
	 			$num=$dia-1;
	 			$array1[$num][$cont]='<td>'
				.$dato["dia"].'&nbsp'
	 			.$dato["nombre"].
	 			'<br>'.$dato["hora_inicio"].
	 			'<br>'.$dato["duracion"].	 			
	 			'</td>';
	 			$cont++;
	 		}else{
	 			$cont=0;
	 			$dia++;
	 			$num=$dia-1;
	 			$array1[$num][$cont]='<td>'.$dato["nombre"].
	 			'<br>'.$dato["duracion"].'</td>';
	 		}	*/ 		
	 		////////////////////////
			/*
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
	 		}*/	 		
		}		
	}
	else
	{
		$salida='<tr id="sinDatos">
		<td colspan="7">No hay Registros en la Base de Datos, Tu codigo!!</td>
		</tr>';
		return $salida;
	}
	$aux=10;
	$array2='';
	for ($i=0; $i < $mayor; $i++) { 
		$array2[$i]='<tr>';
		for ($j=0; $j < 7; $j++) {			
			if(is_null($array1[$i][$j]))
				$array2[$i].='<td></td>';
			else
				$array2[$i].=$array1[$i][$j];
			/*if(count($array1[$i])>$aux)
				$mayor=$array1[$i][$j];
			*/
		}
		$array2[$i].='</tr>';		
	}
	return $array2;
	//return $mayor;
	//$salida = array($M,$T,$N);
	/*
	$array2;//='<td>';
	$contador=0;
	$pos=0;
	while ($contador<23) {
		$array2[$contador]='<tr>';
		for ($i=0; $i < 7; $i++) { 
		//for ($j=0; $j < count($array1[i]); $j++) { 
			//if($array1[$i][$contador]!="" || !is_null($array1[$i][$contador])){
				$array2[$contador].='<td>'.$array1[$i][$contador].' </td>';
			/*}
			else{
				$array2[$contador].='<td> </td>';
			}*/
		//}				
			/*
		}
		$array2[$contador].='</tr>';
		$contador++;
	}	
	return $array2;
	*/
}
function obtenerDias($conexion){
	$resul='';
	$sql=mysql_query("select * from dias");
	if(mysql_num_rows($sql)>0){
		while ($dato=mysql_fetch_array($sql))
		{
			$resul.='
			<option value="'.$dato["id_dia"].'"> '.$dato["dia"].' </option>
			';
		}
	}
	return $resul;
}
function obtenerProgramas($conexion){
	$resultado='';
	$sql=mysql_query("select * from programas where estatus='ACTIVO'");
	if(mysql_num_rows($sql)>0){
		while ($dato=mysql_fetch_array($sql)){
			$resultado.='<option value="'.$dato["id_programa"].'">'.$dato["nombre"].'</option>';
		}		
	}
	return $resultado;
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '1'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '2'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '3'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '4'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '5'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '6'
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
		FROM horario, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horario.dia =  '7'
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