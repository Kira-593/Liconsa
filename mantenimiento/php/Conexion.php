<?php

	$host="localhost";
	$usu="root";
	$pas="";
	$bd="liconsa";
	
	$link=mysqli_connect($host, $usu, $pas) or die ("Parametros de conexión incorrectos");
	mysqli_select_db($link, $bd);
	$link -> set_charset("utf8");
	if (!$link){
		die("No se puede cnectar a MYSQL:".mysqli_error($link));
	}
	/*echo "<div style='position: absolute; top: 10px; left: 10px; color: blue; font-size: 18px;'>Conexión Establecida</div>";*/
?>