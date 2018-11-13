$(function(){ // Siempre que se trabaja con jquery todo el script tiene
				// que ir dentro de aqui vvv
	var variable = 1; // Variable global que permanece
	let viarible = 0; // variable solo visible y existente en el scope
	
	// PHP en lado del servidor
	// Javascript en el lado del cliente
	// console.log({variable}); // Mostrar variable dentro del inspector del browser
	
	// PHP - Jquery (AJAX)
	let conf = { // Esto es un objeto json
		type: 'post', // Esto representa que tipo de metodo se va a usar get|post
		dataType: 'json', // Esto es lo que estamos esperando como respuesta
		url: 'prueba_ajax.php',
		success: function(json){ // El objeto como respuesta si la peticion es exitosa
			// Esto e suna funcion anonima
			console.log({json});
		},
		error: function(err){
			console.log({err});
		}
	};
	
	// Jquery
	// selector + accion + resultado = jquery andando
	let nombre = new Array();
	
	nombre.push('Miguel');
	nombre.push('Manuel');
	nombre.push('Mauricio');
	nombre.push('Monica');
	
	$(nombre).each(function(indx, data){ // Estructura de control de jquery
		alert(data) // Se puede ejecutar codigo sin ;
	});
	
	$('body').on('click','[rel="header"]', function(evento){
		alert('Diste click en cabeza');
		// Solicitu asincrona para el servidor
		$.ajax(conf);
	});
});