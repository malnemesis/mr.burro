<?php 

	$db = new mysqli("localhost", "root", "", "mfors");	
	if($db->connect_errno) {
		echo "¡¡¡POR FAVOR TENGA EN CUENTA QUE NOSOTROS ESTAMOS TRABAJANDO ACTUALMENTE EN NUESTRO SITIO !!!! POR FAVOR REGRESA MÁS TARDE";
	}
	
?>