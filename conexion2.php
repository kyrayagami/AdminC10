<?php
$statusConexion=true;
function consultaConductores($conexion){
	$resultado='';
	$consult=mysql_query("SELECT * FROM conductores");
		if (mysql_num_rows($consult)>0)
		{
			while ($dato=mysql_fetch_array($consult))
	 		{	 			 			
	 			$salida.='<tr>	 					
	 					<td> '.$dato["id_conductor"].'</td>
	 					<td> '.$dato["conductor"].'</td>	 							 
	 					<td> '.$dato["correo"].'</td>
	 					<td> '.$dato["descripcion_conductor"].'</td>	 					
	 					<td> '.$dato["imagen_url"].'</td>
	 					<td class="'.returnStatus($dato["estatus"]).'">'.$dato["estatus"].'</td>
	 					<td> <a class="btn btn-info">Editar</a>
	 					<a class="btn btn-danger">Eliminar</a></td>
	 			</tr>';
			}		
		}
		else
		{
			$salida='<tr id="sinDatos">
			<td colspan="7">No hay Registros de horarios en este dia</td>
			</tr>';
		}
	//$salida = array($M,$T,$N);	
	return $salida;
}
function consultaProductores($conexion){
	$resultado='';
	$consult=mysql_query("SELECT * FROM productores");
		if (mysql_num_rows($consult)>0)
		{
			while ($dato=mysql_fetch_array($consult))
	 		{	 			 			
	 			$salida.='<tr>	 					
	 					<td> '.$dato["id_productor"].'</td>
	 					<td> '.$dato["productor"].'</td>	 							 
	 					<td> '.$dato["correo"].'</td>
	 					<td> '.$dato["descripcion_productor"].'</td>	 					
	 					<td> '.$dato["imagen_url"].'</td>
	 					<td class="'.returnStatus($dato["estatus"]).'">'.$dato["estatus"].'</td>
	 					<td> <a class="btn btn-info">Editar</a>
	 					<a class="btn btn-danger">Eliminar</a></td>
	 			</tr>';
			}		
		}
		else
		{
			$salida='<tr id="sinDatos">
			<td colspan="7">No hay Registros de horarios en este dia</td>
			</tr>';
		}
	//$salida = array($M,$T,$N);	
	return $salida;
}
function consult_horario_por_dia($conexion,$dia){
$salida='';
$consulta=mysql_query("SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '".$dia."'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 			 			
	 		$salida.='<tr>	 					
	 					<td> '.$dato["id"].'</td>
	 					<td> '.$dato["hora_inicio"].'</td>
	 					<td> '.$dato["hora_termino"].'</td>	 					 	
	 					<td> '.$dato["nombre"].'</td>
	 					<td> '.$dato["descripcion_h"].'</td>
	 					<td> '.$dato["tipo"].'</td>
	 					<td> <a class="btn btn-danger">Eliminar</a></td>
	 		</tr>';
		}		
	}
	else
	{
		$salida='<tr id="sinDatos">
		<td colspan="7">No hay Registros de horarios en este dia</td>
		</tr>';
	}
	//$salida = array($M,$T,$N);	
	return $salida;
}
function validacionhorahorarios($conexion,$dia,$hora_inicio,$hora_termino){
	$hay_registro='';
// valida que NO SE PUEDAN meter un nuevo horaro entre el rango horarios ya creado
	$consulta=mysql_query("SELECT *  FROM horarios WHERE dia =".$dia."
		AND hora_inicio < '".$hora_inicio."' AND hora_termino > '".$hora_termino."'");
		if (mysql_num_rows($consulta)>0){					
			$hay_registro='si';
			return $hay_registro;
		}
		else{
			$hay_registro='no';
		}

// valida que no se registre un horarios con hora inicio antes y la hora de termino 
//este dentro del rango de otro horarios ya registrado
	$consulta2=mysql_query("SELECT *  FROM horarios WHERE dia =".$dia."
		AND hora_inicio BETWEEN '".$hora_inicio."' AND '".$hora_termino."'");
	// obtenemos la fila y se tiene que comparar la hora de termino del nuevo horarios con la fecha de inicio de la fila obtenida
		if (mysql_num_rows($consulta2)>0){
			while ($dato=mysql_fetch_array($consulta2)){
				if($hora_termino ==  $dato["hora_inicio"]){
					$hay_registro='no';
				}else{
					$hay_registro='si';
					return $hay_registro;
				}				
			}		
		}
		else{
			$hay_registro='no';
		}

// valida que no se registren horarioss con hora inicio con menos hora y la hora de termino despues de algun horarios registrado en la tabla de horarios
	$consulta3=mysql_query("SELECT *  FROM horarios WHERE dia =".$dia."
		AND hora_termino BETWEEN '".$hora_inicio."' AND '".$hora_termino."'");
		// obtenemos la fila y se tiene que comparar la hora de inicio del nuevo horarios con la fecha de termino de la fila obtenida
		if (mysql_num_rows($consulta3)>0){
			while ($dato=mysql_fetch_array($consulta3)){
				if($hora_inicio ==  $dato["hora_termino"]){
					$hay_registro='no';
				}else{
					$hay_registro='si';
					return $hay_registro;
				}				
			}		
		}
		else{
			$hay_registro='no';
		}
		return $hay_registro;
// valida que no se incruste un horarios con hora Inicio un poco mas tarde y que su hora Termino termine un poco mas tarde que algun horarios que exista en la tabla horarios
	/*$consulta=mysql_query("SELECT * FROM horarios WHERE dia =1
		AND hora_inicio <  '12:15:00'
		AND hora_termino between   '12:15:00'
		AND '13:45:00'	");*/
	// obtenemos la fila y se tiene que comparar la hora de inicio del nuevo horarios con la hora_termino de la fila obtenida
	
}
function programacion_3sig($hora_actual,$dia,$conexion){
$consulta=mysql_query("SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =>  DAY(NOW()) as dia
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.hora_inicio ASC
		limit 0,3");
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{

	 	}
	}	
}
function consulthorarios2($conexion){	
/*$acu=0;
$salida='';
$M='';
$T='';
$N='';*/

$dia=1;
$i=0;
$j=0;
$mayor=0;
$pos=0;
$cont=0;
$array1='';
$consulta=mysql_query("SELECT * 
FROM horarios, programas
WHERE programas.estatus =  'ACTIVO'
AND programas.id_programa = horarios.id_programa
ORDER BY horarios.dia, horarios.hora_inicio ASC ");
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
	 			'<br>'.$dato["hora_termino"].
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
		</tr>';
		return $salida;
	}
	$aux=10;
	$array2='';
	for ($i=0; $i < $mayor; $i++) { 
		$array2[$i]='<tr>';
		for ($j=0; $j < 7; $j++) {			
			if(empty($array1[$i][$j]))
			{
				$array2[$i].='<td></td>';
			}
			else{
				$array2[$i].=$array1[$i][$j];
			}
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
			$resul.='<option value="'.$dato["id_dia"].'"> '.$dato["dia"].'</option>';
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
function obtenerCategoria($conexion){
	$result='';
	$sql=mysql_query("select * from categoria");
	if(mysql_num_rows($sql)>0){
		while ($dato=mysql_fetch_array($sql)){
			$result.='<option value="'.$dato["id_categoria"].'">'.$dato["categoria"].'</option>';
		}		
	}
	return $result;
}

/*function consultahorarioss($conexion){
	$acu=0;
	$salida='';
	$M='';
	$T='';
	$N='';
	$consulta=mysql_query("SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
	$consulta = mysql_query("select * from programas LEFT join 
		categoria on programas.id_categoria=categoria.id_categoria");
	//$conductores = mysql_query($sql, $conexion) or die(mysql_error());  
	 //Validamos si hay o no registros
	 if(mysql_num_rows($consulta)>0){
		 while($dato=mysql_fetch_array($consulta)){
			 $salida.='	
			 	<tr>			 	
					<td>'.$dato["id_programa"].'</td>
					<td>'.$dato["nombre"].'</td>					
					<td><p style="width:200px; height:50px; overflow:hidden">'.$dato["descripcion"].'</p></td>
					<td>'.$dato["correo"].'</td>
					<td>'.$dato["categoria"].'</td>
					<td style="display:none;">'.$dato["logo"].'</td>
					<td style="display:none;">'.$dato["img_slider"].'</td>
					<td style="display:none;">'.$dato["descripcion_slider"].' </td>
					<td style="display:none;">'.$dato["imgtop_programa"].'</td>
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
			$status="btn-success";
			//$status="label label-success";
		break;
		case "INACTIVO":
			$status="btn-warning";
			//$status="label label-warning";
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
//error_reporting(0);

//
//prueba de envio  informacion
//

function consulta_horario_prueba($conexion,$dia){
	// se modifico para obtener el dia con la fecha de mysql
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta = mysql_query("SELECT * FROM  `horarios` LEFT JOIN 
	programas on horarios.id_programa = programas.id_programa
	WHERE horarios.dia = ( SELECT (id_dia) FROM  dias WHERE  dia_ingles = DAYNAME( NOW( ) ) ) 
	
	ORDER BY horarios.hora_inicio");
/*
consulta anterior
$consulta=mysql_query("SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  ".$dia."
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
");
*/
	if (mysql_num_rows($consulta)>0)
	{
		while ($dato=mysql_fetch_array($consulta))
	 	{	 		
			// mañana			
			$acu=$acu+1;
	 		$la="layer".$acu."";
	 		$muestra="show('layer".$acu."')";
			$hora=str_replace(":", "",$dato["hora_inicio"]);


			$imagen='';	
			if($dato["img_slider"]== ''){
				//$imagen= 'dist/img/tu_canal_10.jpg';
				$imagen= 'dist/img/tu_canal_10.jpg';				
			}else{
				$imagen = $dato["img_slider"];
			}
	 				
	 		if($hora<=115959){	 			 		
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display: none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>                    
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
		</tr>';
	}
	$salida = array($M,$T,$N);	
	return $salida;
}


function consulta_lunes($conexion){
$acu=0;
$salida='';
$M='';
$T='';
$N='';
$consulta=mysql_query("SELECT * 
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '1'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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

			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer">
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '2'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '3'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '4'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer">
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '5'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                              
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '6'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
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
		FROM horarios, programas
		WHERE programas.estatus =  'ACTIVO'
		AND horarios.dia =  '7'
		AND programas.id_programa = horarios.id_programa
		ORDER BY horarios.dia, horarios.hora_inicio ASC
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
			$imagen='';	
			if($dato["img_slider"]== ''){
				$imagen= 'dist/img/tu_canal_10.jpg';
			}else{
				$imagen = $dato["img_slider"];
			}

	 		if($hora<=115959){
	 			$M.='
	 			<li class="estilo_lista" onclick="'.$muestra.'"> 
                <b>'.$dato["hora_inicio"].'</b> &nbsp;&nbsp;&nbsp; '.$dato["nombre"].'  
                <div id="'.$la.'" style="display:none;" class="layer"> 
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                             
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                            
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
                <img src="'.$imagen.'" hspace="0" vspace="0" width="200" height="133" border="0">
                <img src="dist/img/flecha-left.png" hspace="0" vspace="0" width="10" height="133" border="0">                                                                            
                  <div class="sub-layer"> 
                    <p> 
                    <span class="c_tit">'.$dato["nombre"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["tipo"].'</span>
                    <br> 
                    <span class="c_tit2">'.$dato["descripcion_h"].'</span>
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
		<td colspan="7">No hay Registros en la Base de Datos,  </td>
		</tr>';
	}
	$salida = array($M,$T,$N);	
	return $salida;
}
?>