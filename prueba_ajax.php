<?php

	// Concepto de APIs

	$respuesta = new stdClass; // Creando un objeto en blanco
	$respuesta->valor = 9001;
	$respuesta->error = '';
	$respuesta->usuario = 'Usuario nuevo'; // Asignacion a atributo
	
	die(json_encode($respuesta));